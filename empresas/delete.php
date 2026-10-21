<?php
declare(strict_types=1);

/**
 * CRUD de empresas · Borrado
 *
 * POST (id + _csrf) -> elimina la empresa y redirige al listado
 */

require_once __DIR__ . '/_bootstrap.php';

if (!defined('UTP_FRONT_CONTROLLER') && !defined('EMPRESAS_EMBEDDED')) {
    // Acceso directo al archivo: se renderiza con el layout del sitio
    define('UTP_FRONT_CONTROLLER', true);
    ViewController::renderFile(__FILE__, [], 'main');
    return;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    empresas_flash('La eliminación requiere una petición POST.', 'error');
    empresas_redirect(empresas_destino_redirect(empresas_url('empresas')));
}

if (!empresas_csrf_check()) {
    empresas_flash('La sesión expiró. Vuelve a intentarlo.', 'error');
    empresas_redirect(empresas_destino_redirect(empresas_url('empresas')));
}

$empresaId = (int) empresas_post('id');

if ($empresaId <= 0) {
    empresas_flash('La empresa indicada no es válida.', 'error');
    empresas_redirect(empresas_destino_redirect(empresas_url('empresas')));
}

try {
    if (EmpresaModel::eliminar($empresaId)) {
        empresas_flash('La empresa se eliminó correctamente.');
    } else {
        empresas_flash('No se encontró la empresa a eliminar.', 'warning');
    }
} catch (Throwable $e) {
    empresas_flash('No se pudo eliminar la empresa: ' . $e->getMessage(), 'error');
}

empresas_redirect(empresas_destino_redirect(empresas_url('empresas')));
