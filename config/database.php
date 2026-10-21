<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/**
 * Conexión a la base de datos "utp_markt" alojada en Supabase (PostgreSQL).
 *
 * La conexión es perezosa (lazy): se abre en el primer uso y se reutiliza
 * durante toda la petición. Si Supabase no está accesible, `Database::isAvailable()`
 * devuelve false en lugar de romper la página, permitiendo mostrar un mensaje
 * de "servicio no disponible" en las vistas.
 */
final class Database
{
    /** Nombre lógico de la base de datos del proyecto */
    public const NAME = 'utp_markt';

    /** Esquema de PostgreSQL donde viven las tablas */
    public const SCHEMA = 'utp_markt';

    private static ?PDO $pdo = null;

    private static ?string $lastError = null;

    /**
     * Devuelve la instancia PDO conectada a "utp_markt"
     *
     * @throws PDOException si la conexión falla
     */
    public static function connection(): PDO
    {
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        $host   = (string) env('DB_HOST', 'localhost');
        $port   = (int)    env('DB_PORT', 5432);
        $dbname = (string) env('DB_NAME', 'postgres');
        $user   = (string) env('DB_USER', 'postgres');
        $pass   = (string) env('DB_PASSWORD', '');
        $schema = self::schema();

        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s', $host, $port, $dbname);

        self::$pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_STRINGIFY_FETCHES  => false,
        ]);

        // Las tablas se resuelven dentro del esquema "utp_markt"
        self::$pdo->exec(sprintf('SET search_path TO "%s", public', $schema));

        self::$lastError = null;

        return self::$pdo;
    }

    /**
     * Esquema de trabajo (validado para evitar inyección en el SET search_path)
     */
    public static function schema(): string
    {
        $schema = (string) env('DB_SCHEMA', self::SCHEMA);

        return preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $schema) === 1
            ? $schema
            : self::SCHEMA;
    }

    /**
     * ¿La base de datos está disponible?
     */
    public static function isAvailable(): bool
    {
        try {
            self::connection();
            return true;
        } catch (Throwable $e) {
            self::$lastError = $e->getMessage();
            return false;
        }
    }

    /**
     * Último error de conexión registrado
     */
    public static function lastError(): ?string
    {
        return self::$lastError;
    }

    /**
     * Ejecuta una consulta y devuelve el statement
     */
    public static function run(string $sql, array $params = []): PDOStatement
    {
        $stmt = self::connection()->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    /**
     * Devuelve todas las filas de una consulta
     */
    public static function all(string $sql, array $params = []): array
    {
        return self::run($sql, $params)->fetchAll();
    }

    /**
     * Devuelve la primera fila de una consulta o null
     */
    public static function first(string $sql, array $params = []): ?array
    {
        $row = self::run($sql, $params)->fetch();

        return $row === false ? null : $row;
    }

    /**
     * Ejecuta una consulta de escritura y devuelve las filas afectadas
     */
    public static function execute(string $sql, array $params = []): int
    {
        return self::run($sql, $params)->rowCount();
    }

    /**
     * Cierra la conexión (útil en scripts y tests)
     */
    public static function disconnect(): void
    {
        self::$pdo = null;
    }
}

if (!function_exists('db')) {
    /**
     * Helper global: db()->prepare(...)
     */
    function db(): PDO
    {
        return Database::connection();
    }
}
