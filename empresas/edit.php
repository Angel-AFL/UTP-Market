<?php
declare(strict_types=1);

/**
 * CRUD de empresas · Edición
 *
 * GET  ?id=N -> muestra el formulario con los datos de la empresa
 * POST        -> valida, actualiza y redirige al detalle
 */

require_once __DIR__ . '/_bootstrap.php';

if (!defined('UTP_FRONT_CONTROLLER') && !defined('EMPRESAS_EMBEDDED')) {
    // Acceso directo al archivo: se renderiza con el layout del sitio
    define('UTP_FRONT_CONTROLLER', true);
    ViewController::renderFile(__FILE__, [], 'main');
    return;
}

$empresaId = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);

// ---------------------------------------------------------------- POST
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $empresaErrorRedirect = empresas_destino_redirect(empresas_url('edit', ['id' => $empresaId]), 'error_redirect');

    if (!empresas_csrf_check()) {
        empresas_flash('La sesión del formulario expiró. Vuelve a intentarlo.', 'error');
        empresas_redirect($empresaErrorRedirect);
    }

    if ($empresaId <= 0) {
        empresas_flash('La empresa indicada no es válida.', 'error');
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
        EmpresaModel::actualizar($empresaId, $datos);
        empresas_flash('La empresa se actualizó correctamente.');
        empresas_redirect(empresas_destino_redirect(empresas_url('show', ['id' => $empresaId])));
    } catch (Throwable $e) {
        empresas_errores(['general' => 'No se pudo actualizar la empresa: ' . $e->getMessage()]);
        empresas_guardar_old($datos);
        empresas_redirect($empresaErrorRedirect);
    }
}

// ---------------------------------------------------------------- GET
$empresa = null;

if (Supabase::isAvailable() && $empresaId > 0) {
    try {
        $empresa = EmpresaModel::find($empresaId);
    } catch (Throwable $e) {
        $empresa = null;
    }
}

if ($empresaId <= 0 || !$empresa) {
    empresas_flash('No encontramos la empresa que buscas.', 'error');
    empresas_redirect(empresas_url('empresas'));
}

// Los datos errados del POST tienen prioridad sobre los guardados
$old = empresas_old();
if ($old) {
    $empresa = array_merge($empresa, $old);
}

$errores    = empresas_errores_take();

$empresaAccion       = empresas_url('edit', ['id' => $empresaId]);
$empresaMetodo       = 'POST';
$empresaEnviar       = 'Guardar cambios';
$empresaRedirect     = $empresaRedirect     ?? empresas_url('empresas');
$empresaErrorRedirect = $empresaErrorRedirect ?? empresas_url('edit', ['id' => $empresaId]);

$empresasTitulo    = 'Editar empresa';
$empresasSubtitulo = 'Actualiza los datos de "' . $empresa['nombre'] . '".';
$empresasAcciones  = '<a href="' . empresas_url('show', ['id' => $empresaId]) . '" class="btn btn-outline-secondary btn-sm">Ver detalle</a>';

require __DIR__ . '/_layout.php';
?>

<div class="row">
    <div class="col-12">
        <?php require __DIR__ . '/_form.php'; ?>
    </div>
</div>
