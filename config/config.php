<?php
declare(strict_types=1);

/**
 * Configuración del proyecto UTP-Market.
 *
 * Lee el archivo `.env` de la raíz y expone sus variables mediante
 * el helper global `env()`. Las variables de entorno reales del sistema
 * tienen prioridad sobre el archivo `.env`.
 */

final class Config
{
    /** @var array<string, string> */
    private static array $vars = [];

    private static bool $loaded = false;

    /**
     * Carga (una sola vez) el archivo .env
     */
    public static function load(?string $envPath = null): void
    {
        if (self::$loaded) {
            return;
        }
        self::$loaded = true;

        $envPath ??= dirname(__DIR__) . '/.env';
        if (!is_file($envPath) || !is_readable($envPath)) {
            return;
        }

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];

        foreach ($lines as $line) {
            $line = trim($line);

            // Ignora comentarios y líneas vacías
            if ($line === '' || str_starts_with($line, '#') || str_starts_with($line, ';')) {
                continue;
            }

            // Ignora secciones [algo]
            if (str_starts_with($line, '[')) {
                continue;
            }

            $pos = strpos($line, '=');
            if ($pos === false) {
                continue;
            }

            $key = trim(substr($line, 0, $pos));
            $value = trim(substr($line, $pos + 1));

            // Quita comillas envolventes si las hay
            if (strlen($value) >= 2) {
                $first = $value[0];
                $last = $value[strlen($value) - 1];
                if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                    $value = substr($value, 1, -1);
                }
            }

            if ($key !== '') {
                self::$vars[$key] = $value;
            }
        }
    }

    /**
     * Obtiene una variable de configuración
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        self::load();

        $fromEnv = getenv($key);
        if ($fromEnv !== false && $fromEnv !== '') {
            return $fromEnv;
        }

        return self::$vars[$key] ?? $default;
    }

    /**
     * Indica si la variable existe y no está vacía
     */
    public static function has(string $key): bool
    {
        $value = self::get($key);
        return $value !== null && $value !== '';
    }
}

if (!function_exists('env')) {
    /**
     * Helper global: env('DB_HOST', 'localhost')
     */
    function env(string $key, mixed $default = null): mixed
    {
        return Config::get($key, $default);
    }
}

/**
 * Cliente mínimo de la API REST de Supabase (PostgREST).
 *
 * El módulo de empresas (carpeta `empresas/`) usa SOLO esta conexión:
 * toma los valores `SUPABASE_URL` y `SUPABASE_SERVICE_ROLE_KEY` del `.env`
 * y trabaja contra la tabla `empresa` del esquema `public`.
 *
 * No se usa ninguna base de datos local ni el puerto 5432: todas las
 * consultas viajan por HTTPS a https://<proyecto>.supabase.co/rest/v1/.
 */
final class Supabase
{
    /** Tabla del módulo de empresas */
    public const EMPRESAS_TABLE = 'empresa';

    private static ?string $lastError = null;

    private static ?bool $available = null;

    /**
     * URL del proyecto Supabase (sin la barra final)
     */
    public static function url(): string
    {
        return rtrim((string) env('SUPABASE_URL', ''), '/');
    }

    /**
     * Clave de la API (secret o anon)
     */
    public static function key(): string
    {
        return (string) (
            env('SUPABASE_SERVICE_ROLE_KEY')
            ?: env('SUPABASE_SECRET_KEY')
            ?: env('SUPABASE_ANON_KEY')
            ?: env('SUPABASE_KEY')
            ?: ''
        );
    }

    /**
     * ¿Están definidos la URL y la clave?
     */
    public static function isConfigured(): bool
    {
        return self::url() !== '' && self::key() !== '';
    }

    /**
     * ¿Responde la API para la tabla de empresas?
     */
    public static function isAvailable(): bool
    {
        if (self::$available !== null) {
            return self::$available;
        }

        if (!self::isConfigured()) {
            self::$lastError = 'Falta SUPABASE_URL o SUPABASE_SERVICE_ROLE_KEY en el archivo .env.';

            return self::$available = false;
        }

        try {
            self::select(self::EMPRESAS_TABLE, ['select' => 'id', 'limit' => 1]);
            self::$lastError = null;

            return self::$available = true;
        } catch (Throwable $e) {
            self::$lastError = $e->getMessage();

            return self::$available = false;
        }
    }

    /**
     * Último error registrado
     */
    public static function lastError(): ?string
    {
        return self::$lastError;
    }

    /**
     * SELECT sobre una tabla
     */
    public static function select(string $tabla, array $query = []): array
    {
        return self::request('GET', $tabla, $query);
    }

    /**
     * INSERT (devuelve las filas creadas)
     */
    public static function insert(string $tabla, array $fila): array
    {
        return self::request('POST', $tabla, [], $fila);
    }

    /**
     * UPDATE con filtros PostgREST (ej. ['id' => 'eq.5'])
     */
    public static function update(string $tabla, array $filtros, array $fila): array
    {
        return self::request('PATCH', $tabla, $filtros, $fila);
    }

    /**
     * DELETE con filtros PostgREST (devuelve las filas borradas)
     */
    public static function delete(string $tabla, array $filtros): array
    {
        return self::request('DELETE', $tabla, $filtros);
    }

    /**
     * Petición HTTP a /rest/v1/<tabla>
     *
     * @throws RuntimeException si Supabase responde con error
     */
    private static function request(string $metodo, string $tabla, array $query = [], ?array $body = null): array
    {
        if (!self::isConfigured()) {
            throw new RuntimeException('Supabase no está configurado (SUPABASE_URL / SUPABASE_SERVICE_ROLE_KEY).');
        }

        if (!function_exists('curl_init')) {
            throw new RuntimeException('La extensión cURL de PHP no está habilitada.');
        }

        $url = self::url() . '/rest/v1/' . rawurlencode(trim($tabla, '/'));

        if ($query !== []) {
            $url .= '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
        }

        $ch = curl_init($url);

        $opciones = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => $metodo,
            CURLOPT_HTTPHEADER     => [
                'apikey: ' . self::key(),
                'Authorization: Bearer ' . self::key(),
                'Accept: application/json',
                'Content-Type: application/json',
                'Prefer: return=representation',
            ],
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT        => (int) env('SUPABASE_TIMEOUT', 20),
        ];

        if ($body !== null) {
            $opciones[CURLOPT_POSTFIELDS] = json_encode(
                $body,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            );
        }

        curl_setopt_array($ch, $opciones);

        $respuesta = curl_exec($ch);
        $codigo    = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error     = curl_error($ch);

        curl_close($ch);

        if ($respuesta === false || $error !== '') {
            throw new RuntimeException('No se pudo conectar con Supabase: ' . $error);
        }

        $datos = $respuesta === '' ? null : json_decode((string) $respuesta, true);

        if ($codigo >= 400) {
            $mensaje = is_array($datos) ? (string) ($datos['message'] ?? '') : '';
            $detalle = is_array($datos) ? (string) ($datos['details'] ?? '') : '';

            throw new RuntimeException(
                'Supabase respondió HTTP ' . $codigo
                . ($mensaje !== '' ? ': ' . $mensaje : '')
                . ($detalle !== '' ? ' (' . $detalle . ')' : '')
            );
        }

        return is_array($datos) ? $datos : [];
    }
}

