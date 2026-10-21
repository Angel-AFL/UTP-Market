<?php
declare(strict_types=1);

/**
 * CRUD de empresas · Alta
 *
 * GET  -> muestra el formulario
 * POST -> valida, guarda y redirige al listado
 */

require_once __DIR__ . '/_bootstrap.php';

if (!defined('UTP_FRONT_CONTROLLER') && !defined('EMPRESAS_EMBEDDED')) {
    // Acceso directo al archivo: se renderiza con el layout del sitio
    define('UTP_FRONT_CONTROLLER', true);
    ViewController::renderFile(__FILE__, [], 'main');
    return;
}

// ---------------------------------------------------------------- POST
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $empresaErrorRedirect = empresas_destino_redirect(empresas_url('create'), 'error_redirect');

    if (!empresas_csrf_check()) {
        empresas_flash('La sesión del formulario expiró. Vuelve a intentarlo.', 'error');
        empresas_redirect($empresaErrorRedirect);
    }

    $datos = [
        'nombre'              => empresas_post('nombre'),
        'descripcion'         => empresas_post('descripcion'),
        'url_imagen'          => empresas_post('url_imagen'),
    ];

    $errores    = EmpresaModel::validar($datos);

    if ($errores) {
        empresas_errores($errores);
        empresas_guardar_old($datos);
        empresas_redirect($empresaErrorRedirect);
    }

    try {
        EmpresaModel::crear($datos);
        empresas_flash('La empresa se creó correctamente.');
        empresas_redirect(empresas_destino_redirect(empresas_url('empresas')));
    } catch (Throwable $e) {
        empresas_errores(['general' => 'No se pudo guardar la empresa: ' . $e->getMessage()]);
        empresas_guardar_old($datos);
        empresas_redirect($empresaErrorRedirect);
    }
}

// ---------------------------------------------------------------- GET
$errores    = empresas_errores_take();
$empresa    = empresas_old();

$empresaAccion       = empresas_url('create');
$empresaMetodo       = 'POST';
$empresaEnviar       = 'Guardar empresa';
$empresaRedirect     = $empresaRedirect     ?? empresas_url('empresas');
$empresaErrorRedirect = $empresaErrorRedirect ?? empresas_url('create');

$empresasTitulo    = 'Nueva empresa';
$empresasSubtitulo = 'Registra una nueva empresa en UTP-Market.';
$empresasAcciones  = '';

require __DIR__ . '/_layout.php';
?>

<div class="row">
    <div class="col-12">
        <?php require __DIR__ . '/_form.php'; ?>
    </div>
</div>
