<?php
declare(strict_types=1);

/**
 * Bootstrap del módulo de empresas.
 *
 * Carga la conexión a "utp_markt" (Supabase) y deja disponibles los
 * helpers que usan las vistas del CRUD (sesión, CSRF, flash, redirección).
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../ViewController.php';
require_once __DIR__ . '/_model.php';

if (!function_exists('empresas_session')) {
    /**
     * Inicia la sesión una sola vez (necesaria para CSRF y mensajes flash)
     */
    function empresas_session(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}

if (!function_exists('empresas_csrf_token')) {
    /**
     * Token CSRF de la sesión
     */
    function empresas_csrf_token(): string
    {
        empresas_session();

        if (empty($_SESSION['empresas_csrf'])) {
            $_SESSION['empresas_csrf'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['empresas_csrf'];
    }
}

if (!function_exists('empresas_csrf_field')) {
    /**
     * Campo oculto con el token CSRF
     */
    function empresas_csrf_field(): string
    {
        return '<input type="hidden" name="_csrf" value="' . htmlspecialchars(empresas_csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
    }
}

if (!function_exists('empresas_csrf_check')) {
    /**
     * Valida el token CSRF recibido
     */
    function empresas_csrf_check(?string $token = null): bool
    {
        empresas_session();

        $token ??= (string) ($_POST['_csrf'] ?? '');
        $expected = (string) ($_SESSION['empresas_csrf'] ?? '');

        return $expected !== '' && hash_equals($expected, $token);
    }
}

if (!function_exists('empresas_flash')) {
    /**
     * Guarda un mensaje flash para la siguiente petición
     */
    function empresas_flash(string $mensaje, string $tipo = 'success'): void
    {
        empresas_session();
        $_SESSION['empresas_flash'][] = ['mensaje' => $mensaje, 'tipo' => $tipo];
    }
}

if (!function_exists('empresas_flash_take')) {
    /**
     * Recupera (y limpia) los mensajes flash
     */
    function empresas_flash_take(): array
    {
        empresas_session();

        $mensajes = $_SESSION['empresas_flash'] ?? [];
        unset($_SESSION['empresas_flash']);

        return is_array($mensajes) ? $mensajes : [];
    }
}

if (!function_exists('empresas_redirect')) {
    /**
     * Redirige a una ruta interna del proyecto.
     *
     * Acepta:
     *   - un nombre de ruta  → 'empresas'      (se convierte con url())
     *   - una ruta absoluta  → '/UTP-Market/user-profile?vista=create'
     *   - una URL completa   → 'https://...'
     */
    function empresas_redirect(string $ruta): never
    {
        if (preg_match('#^https?://#i', $ruta) === 1) {
            $destino = $ruta;
        } elseif (str_starts_with($ruta, '/')) {
            $destino = $ruta;
        } else {
            $destino = url($ruta);
        }

        header('Location: ' . $destino);
        exit;
    }
}

if (!function_exists('empresas_destino_redirect')) {
    /**
     * Destino tras guardar/borrar: usa el campo oculto indicado
     * ("redirect" o "error_redirect") si es una ruta interna válida
     * (evita open redirect).
     */
    function empresas_destino_redirect(string $porDefecto = 'empresas', string $campo = 'redirect'): string
    {
        $candidato = (string) ($_POST[$campo] ?? '');

        if ($candidato === '') {
            return $porDefecto;
        }

        // Solo se permiten rutas internas que empiecen por "/" (nunca "//")
        if (!str_starts_with($candidato, '/') || str_starts_with($candidato, '//')) {
            return $porDefecto;
        }

        return $candidato;
    }
}

if (!function_exists('empresas_url')) {
    /**
     * URL de una vista del CRUD según el contexto en el que se use:
     *
     *   - Página independiente: /empresas, /empresas/create?id=...
     *   - Panel de usuario:     /user-profile?vista=create&id=...
     *
     * @param string $vista  empresas|create|edit|show|delete
     * @param array  $params Parámetros extra (por ejemplo ['id' => 5])
     */
    function empresas_url(string $vista = 'empresas', array $params = []): string
    {
        if (defined('EMPRESAS_EMBEDDED')) {
            $query = ['vista' => $vista] + $params;

            return url('user-profile') . '?' . http_build_query($query);
        }

        $ruta = 'empresas';

        if ($vista !== 'empresas' && $vista !== 'index') {
            $ruta .= '/' . $vista;
        }

        return url($ruta) . ($params !== [] ? '?' . http_build_query($params) : '');
    }
}

if (!function_exists('empresas_post')) {
    /**
     * Devuelve un valor de $_POST saneado
     */
    function empresas_post(string $campo, string $default = ''): string
    {
        $valor = $_POST[$campo] ?? $default;

        return is_scalar($valor) ? trim((string) $valor) : $default;
    }
}

if (!function_exists('empresas_errores')) {
    /**
     * Guarda los errores de validación del formulario
     */
    function empresas_errores(array $errores): void
    {
        empresas_session();
        $_SESSION['empresas_errores'] = $errores;
    }
}

if (!function_exists('empresas_errores_take')) {
    /**
     * Recupera (y limpia) los errores de validación
     */
    function empresas_errores_take(): array
    {
        empresas_session();

        $errores = $_SESSION['empresas_errores'] ?? [];
        unset($_SESSION['empresas_errores']);

        return is_array($errores) ? $errores : [];
    }
}

if (!function_exists('empresas_old')) {
    /**
     * Recupera (y limpia) los datos del formulario enviados previamente
     */
    function empresas_old(): array
    {
        empresas_session();

        $old = $_SESSION['empresas_old'] ?? [];
        unset($_SESSION['empresas_old']);

        return is_array($old) ? $old : [];
    }
}

if (!function_exists('empresas_guardar_old')) {
    /**
     * Guarda los datos del formulario para repoblarlos tras un error
     */
    function empresas_guardar_old(array $datos): void
    {
        empresas_session();
        $_SESSION['empresas_old'] = $datos;
    }
}

if (!function_exists('empresas_url_imagen_valida')) {
    /**
     * Valida que la URL de la imagen sea http/https
     */
    function empresas_url_imagen_valida(string $url): bool
    {
        if ($url === '') {
            return true;
        }

        $partes = parse_url($url);

        if ($partes === false || empty($partes['scheme']) || empty($partes['host'])) {
            return false;
        }

        return in_array(strtolower($partes['scheme']), ['http', 'https'], true);
    }
}

if (!function_exists('empresas_router')) {
    /**
     * Enruta las peticiones del módulo de empresas.
     *
     * Rutas soportadas:
     *   /empresas            -> listado
     *   /empresas/create     -> alta
     *   /empresas/edit?id=N  -> edición
     *   /empresas/show?id=N  -> detalle
     *   /empresas/delete     -> borrado (POST)
     */
    function empresas_router(string $route): void
    {
        $accion = $route === 'empresas'
            ? 'index'
            : substr($route, strlen('empresas/'));

        $accion = strtolower(trim($accion, '/'));
        $accion = preg_replace('/[^a-z]/', '', $accion) ?? '';

        $permitidas = ['index', 'create', 'edit', 'show', 'delete'];

        if (!in_array($accion, $permitidas, true)) {
            http_response_code(404);
            ViewController::render('404', [], 'main');
            return;
        }

        ViewController::renderFile(__DIR__ . '/' . $accion . '.php', [], 'main');
    }
}
