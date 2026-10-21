<?php
declare(strict_types=1);

/**
 * Modelo de empresas - UTP-Market
 *
 * Base de datos: Supabase
 * Tabla: public.empresa
 *
 * Columnas:
 * id, nombre, slug, eslogan, descripcion,
 * logo_url, imagen_url, correo, telefono,
 * whatsapp, direccion, facebook, instagram,
 * estado, created_at, updated_at
 *
 * slug y estado no se modifican desde este modelo.
 */

final class EmpresaModel
{
    private const TABLA = Supabase::EMPRESAS_TABLE;

    private const SELECT = '*';

    /**
     * Obtener todas las empresas.
     */
    public static function all(?string $busqueda = null): array
    {
        $query = [
            'select' => self::SELECT,
            'order'  => 'id.desc',
        ];

        if ($busqueda !== null && trim($busqueda) !== '') {
            $texto = trim((string) preg_replace(
                '/[\s,()*]+/',
                ' ',
                $busqueda
            ));

            if ($texto !== '') {
                $query['or'] =
                    '(nombre.ilike.*' . $texto .
                    '*,descripcion.ilike.*' . $texto . '*)';
            }
        }

        return array_map(
            [self::class, 'normalizar'],
            Supabase::select(self::TABLA, $query)
        );
    }

    /**
     * Obtener una empresa por ID.
     */
    public static function find(int $id): ?array
    {
        if ($id <= 0) {
            return null;
        }

        $filas = Supabase::select(self::TABLA, [
            'select' => self::SELECT,
            'id'     => 'eq.' . $id,
            'limit'  => 1,
        ]);

        return $filas
            ? self::normalizar($filas[0])
            : null;
    }

    /**
     * Compatibilidad con el CRUD existente.
     */
    public static function categorias(): array
    {
        return [];
    }

    /**
     * Validar los datos de una empresa.
     */
    public static function validar(
        array $datos,
        array $categorias = []
    ): array {
        $errores = [];

        // Nombre obligatorio.
        $nombre = trim((string) ($datos['nombre'] ?? ''));

        if ($nombre === '') {
            $errores['nombre'] =
                'El nombre de la empresa es obligatorio.';
        } elseif (mb_strlen($nombre) > 150) {
            $errores['nombre'] =
                'El nombre no puede superar los 150 caracteres.';
        }

        // Longitudes máximas de Supabase.
        $limites = [
            'eslogan'        => 255,
            'descripcion'    => 5000,
            'logo'           => 255,
            'logo_url'       => 255,
            'imagen_portada' => 255,
            'imagen_url'     => 255,
            'url_imagen'     => 255,
            'correo'         => 150,
            'telefono'       => 25,
            'whatsapp'       => 25,
            'direccion'      => 255,
            'facebook'       => 255,
            'instagram'      => 255,
        ];

        foreach ($limites as $campo => $limite) {
            if (!array_key_exists($campo, $datos)) {
                continue;
            }

            $valor = trim((string) ($datos[$campo] ?? ''));

            if (mb_strlen($valor) > $limite) {
                $errores[$campo] =
                    "El campo {$campo} no puede superar "
                    . "{$limite} caracteres.";
            }
        }

        // Validar correo electrónico.
        $correo = trim((string) ($datos['correo'] ?? ''));

        if (
            $correo !== '' &&
            !filter_var($correo, FILTER_VALIDATE_EMAIL)
        ) {
            $errores['correo'] =
                'Ingresa un correo electrónico válido.';
        }

        // Validar las URLs de imágenes y redes sociales.
        $camposUrl = [
            'logo',
            'logo_url',
            'imagen_portada',
            'imagen_url',
            'url_imagen',
            'facebook',
            'instagram',
        ];

        foreach ($camposUrl as $campo) {
            if (!array_key_exists($campo, $datos)) {
                continue;
            }

            $valor = trim((string) ($datos[$campo] ?? ''));

            if ($valor === '') {
                continue;
            }

            if (!filter_var($valor, FILTER_VALIDATE_URL)) {
                $errores[$campo] =
                    "Ingresa una URL válida para {$campo}.";
                continue;
            }

            $esquema = strtolower(
                (string) parse_url($valor, PHP_URL_SCHEME)
            );

            if (!in_array($esquema, ['http', 'https'], true)) {
                $errores[$campo] =
                    "La URL de {$campo} debe utilizar HTTP o HTTPS.";
            }
        }

        return $errores;
    }

    /**
     * Crear una empresa.
     */
    public static function crear(array $datos): int
    {
        $errores = self::validar($datos);

        if ($errores) {
            throw new InvalidArgumentException(
                implode(' ', array_values($errores))
            );
        }

        $filas = Supabase::insert(
            self::TABLA,
            self::filaParaGuardar($datos)
        );

        return (int) ($filas[0]['id'] ?? 0);
    }

    /**
     * Actualizar una empresa.
     */
    public static function actualizar(
        int $id,
        array $datos
    ): bool {
        if ($id <= 0) {
            return false;
        }

        $errores = self::validar($datos);

        if ($errores) {
            throw new InvalidArgumentException(
                implode(' ', array_values($errores))
            );
        }

        $fila = self::filaParaGuardar($datos);

        if (empty($fila)) {
            return false;
        }

        $fila['updated_at'] = gmdate('c');

        $filas = Supabase::update(
            self::TABLA,
            ['id' => 'eq.' . $id],
            $fila
        );

        return $filas !== [];
    }

    /**
     * Eliminar una empresa.
     */
    public static function eliminar(int $id): bool
    {
        if ($id <= 0) {
            return false;
        }

        $filas = Supabase::delete(
            self::TABLA,
            ['id' => 'eq.' . $id]
        );

        return $filas !== [];
    }

    /**
     * Preparar los datos para Supabase.
     *
     * Solo se envían los campos presentes en
     * el formulario para evitar borrar datos.
     *
     * Se traducen:
     * logo           -> logo_url
     * imagen_portada -> imagen_url
     * url_imagen     -> logo_url (compatibilidad)
     */
    private static function filaParaGuardar(array $datos): array
    {
        $camposPermitidos = [
            'nombre',
            'eslogan',
            'descripcion',
            'correo',
            'telefono',
            'whatsapp',
            'direccion',
            'facebook',
            'instagram',
        ];

        $fila = [];

        foreach ($camposPermitidos as $campo) {
            if (!array_key_exists($campo, $datos)) {
                continue;
            }

            $valor = trim((string) ($datos[$campo] ?? ''));

            $fila[$campo] = $valor !== ''
                ? $valor
                : null;
        }

        // Logo: acepta nombres nuevos y antiguos.
        if (array_key_exists('logo', $datos)) {
            $logo = trim((string) ($datos['logo'] ?? ''));

            $fila['logo_url'] = $logo !== ''
                ? $logo
                : null;

        } elseif (array_key_exists('logo_url', $datos)) {
            $logo = trim((string) ($datos['logo_url'] ?? ''));

            $fila['logo_url'] = $logo !== ''
                ? $logo
                : null;

        } elseif (array_key_exists('url_imagen', $datos)) {
            $logo = trim((string) ($datos['url_imagen'] ?? ''));

            $fila['logo_url'] = $logo !== ''
                ? $logo
                : null;
        }

        // Imagen de portada.
        if (array_key_exists('imagen_portada', $datos)) {
            $portada = trim(
                (string) ($datos['imagen_portada'] ?? '')
            );

            $fila['imagen_url'] = $portada !== ''
                ? $portada
                : null;

        } elseif (array_key_exists('imagen_url', $datos)) {
            $portada = trim(
                (string) ($datos['imagen_url'] ?? '')
            );

            $fila['imagen_url'] = $portada !== ''
                ? $portada
                : null;
        }

        return $fila;
    }

    /**
     * Normalizar los datos recibidos de Supabase.
     *
     * Permite utilizar nombres de campos nuevos
     * y antiguos en las vistas del proyecto.
     */
    private static function normalizar(array $fila): array
    {
        $logo = trim(
            (string) ($fila['logo_url'] ?? '')
        );

        $portada = trim(
            (string) ($fila['imagen_url'] ?? '')
        );

        $imagenPrincipal = $logo !== ''
            ? $logo
            : $portada;

        return array_merge($fila, [
            'id_empresa' => (int) ($fila['id'] ?? 0),

            'logo' => $logo,

            'imagen_portada' => $portada,

            'url_imagen' => $imagenPrincipal,

            'tipo_categoria' => null,
        ]);
    }
}
