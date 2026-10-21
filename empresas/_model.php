<?php
declare(strict_types=1);

/**
 * Modelo de datos de "empresas".
 *
 * La carpeta `empresas/` trabaja directamente contra Supabase mediante
 * su API REST (PostgREST), usando `SUPABASE_URL` y
 * `SUPABASE_SERVICE_ROLE_KEY` del archivo `.env`.
 *
 * Tabla remota: `public.empresa`
 *   id, nombre, eslogan, descripcion, logo_url, imagen_url, correo,
 *   telefono, whatsapp, direccion, facebook, instagram, created_at, updated_at
 *
 * No se usa ninguna base de datos local.
 */
final class EmpresaModel
{
    /** Nombre de la tabla en Supabase */
    private const TABLA = Supabase::EMPRESAS_TABLE;

    /** Columnas que se piden a la API */
    private const SELECT = '*';

    /**
     * Listado de empresas (más recientes primero).
     *
     * @param string|null $busqueda Texto a buscar en nombre o descripción
     */
    public static function all(?string $busqueda = null): array
    {
        $query = [
            'select' => self::SELECT,
            'order'  => 'id.desc',
        ];

        if ($busqueda !== null && trim($busqueda) !== '') {
            // PostgREST usa comas y paréntesis para separar filtros:
            // se limpian para no romper la consulta.
            $texto = trim((string) preg_replace('/[\s,()*]+/', ' ', $busqueda));

            if ($texto !== '') {
                $query['or'] = '(nombre.ilike.*' . $texto . '*,descripcion.ilike.*' . $texto . '*)';
            }
        }

        return array_map(
            [self::class, 'normalizar'],
            Supabase::select(self::TABLA, $query)
        );
    }

    /**
     * Obtiene una empresa por su id (null si no existe)
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

        return $filas ? self::normalizar($filas[0]) : null;
    }

    /**
     * Catálogo de categorías.
     *
     * La tabla `empresa` de Supabase no maneja categorías, así que se
     * devuelve un catálogo vacío para mantener la compatibilidad.
     */
    public static function categorias(): array
    {
        return [];
    }

    /**
     * Valida los datos de una empresa.
     *
     * @param array $datos Datos crudos (nombre, descripcion, url_imagen)
     * @return array Lista de errores (vacía si todo está correcto)
     */
    public static function validar(array $datos, array $categorias = []): array
    {
        $errores = [];

        $nombre = trim((string) ($datos['nombre'] ?? ''));
        if ($nombre === '') {
            $errores['nombre'] = 'El nombre de la empresa es obligatorio.';
        } elseif (mb_strlen($nombre) > 180) {
            $errores['nombre'] = 'El nombre no puede superar los 180 caracteres.';
        }

        $descripcion = (string) ($datos['descripcion'] ?? '');
        if (mb_strlen($descripcion) > 5000) {
            $errores['descripcion'] = 'La descripción no puede superar los 5000 caracteres.';
        }

        $url = (string) ($datos['url_imagen'] ?? '');
        if ($url !== '' && !empresas_url_imagen_valida($url)) {
            $errores['url_imagen'] = 'La URL de la imagen debe empezar con http:// o https://';
        }

        return $errores;
    }

    /**
     * Crea una empresa y devuelve su id
     */
    public static function crear(array $datos): int
    {
        $filas = Supabase::insert(self::TABLA, self::filaParaGuardar($datos));

        return (int) ($filas[0]['id'] ?? 0);
    }

    /**
     * Actualiza una empresa
     */
    public static function actualizar(int $id, array $datos): bool
    {
        if ($id <= 0) {
            return false;
        }

        $fila = self::filaParaGuardar($datos);
        $fila['updated_at'] = gmdate('c');

        $filas = Supabase::update(self::TABLA, ['id' => 'eq.' . $id], $fila);

        return $filas !== [];
    }

    /**
     * Elimina una empresa
     */
    public static function eliminar(int $id): bool
    {
        if ($id <= 0) {
            return false;
        }

        $filas = Supabase::delete(self::TABLA, ['id' => 'eq.' . $id]);

        return $filas !== [];
    }

    /**
     * Columnas que se escriben en Supabase
     */
    private static function filaParaGuardar(array $datos): array
    {
        $descripcion = trim((string) ($datos['descripcion'] ?? ''));
        $imagen      = trim((string) ($datos['url_imagen'] ?? ''));

        return [
            'nombre'      => (string) ($datos['nombre'] ?? ''),
            'descripcion' => $descripcion !== '' ? $descripcion : null,
            'logo_url'    => $imagen !== '' ? $imagen : null,
        ];
    }

    /**
     * Normaliza una fila de Supabase a la forma que usan las vistas
     * (id_empresa, url_imagen, ...).
     */
    private static function normalizar(array $fila): array
    {
        $logo   = trim((string) ($fila['logo_url'] ?? ''));
        $imagen = trim((string) ($fila['imagen_url'] ?? ''));

        return array_merge($fila, [
            'id_empresa'     => (int) ($fila['id'] ?? 0),
            'url_imagen'     => $logo !== '' ? $logo : $imagen,
            'tipo_categoria' => null,
        ]);
    }
}
