<?php
declare(strict_types=1);

/**
 * CRUD de empresas · Listado
 *
 * Esta vista se usa en dos contextos:
 *   1. Página independiente: /empresas  (envuelta por views/layouts/main.php)
 *   2. Pestaña "Empresas" del panel de usuario (views/empresas.php)
 *
 * En ambos casos solo genera HTML parcial.
 */

require_once __DIR__ . '/_bootstrap.php';

if (!defined('UTP_FRONT_CONTROLLER') && !defined('EMPRESAS_EMBEDDED')) {
    // Acceso directo al archivo (p. ej. /empresas/index.php):
    // se renderiza con el layout del sitio.
    define('UTP_FRONT_CONTROLLER', true);
    ViewController::renderFile(__FILE__, [], 'main');
    return;
}

$empresasBusqueda = trim((string) ($_GET['q'] ?? ''));
$empresasLista    = [];
$empresasError    = null;

if (Supabase::isAvailable()) {
    try {
        $empresasLista = EmpresaModel::all($empresasBusqueda !== '' ? $empresasBusqueda : null);
    } catch (Throwable $e) {
        $empresasError = $e->getMessage();
    }
}

$empresasTitulo    = 'Empresas';
$empresasSubtitulo = $empresasBusqueda !== ''
    ? 'Resultados de la búsqueda: "' . $empresasBusqueda . '"'
    : 'Gestiona las empresas registradas en UTP-Market.';

// Destino tras eliminar (la propia página actual, con la búsqueda activa)
$empresaRedirect = $empresaRedirect ?? (string) ($_SERVER['REQUEST_URI'] ?? empresas_url('empresas'));

require __DIR__ . '/_layout.php';
?>

<?php if ($empresasError !== null): ?>
    <div class="alert alert-danger" role="alert">
        <strong>Error al consultar las empresas.</strong>
        <small><?= htmlspecialchars((string) $empresasError, ENT_QUOTES, 'UTF-8') ?></small>
    </div>
<?php endif; ?>

<form action="<?= empresas_url('empresas') ?>" method="GET" class="row g-2 align-items-end mb-4">
    <div class="col-sm-8 col-lg-6">
        <label for="empresas_busqueda" class="form-label">Buscar empresa</label>
        <input type="search" id="empresas_busqueda" name="q" class="form-control"
            value="<?= htmlspecialchars($empresasBusqueda, ENT_QUOTES, 'UTF-8') ?>"
            placeholder="Nombre o descripción...">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
    <?php if ($empresasBusqueda !== ''): ?>
        <div class="col-auto">
            <a href="<?= empresas_url('empresas') ?>" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    <?php endif; ?>
</form>

<?php if (!$empresasLista): ?>
    <div class="text-center py-5">
        <h5 class="heading"><?= $empresasBusqueda !== '' ? 'Sin resultados' : 'Todavía no hay empresas' ?></h5>
        <p class="paragraph">
            <?= $empresasBusqueda !== ''
                ? 'Prueba con otro término de búsqueda.'
                : 'Crea la primera empresa para que aparezca en el listado.' ?>
        </p>
        <a href="<?= empresas_url('create') ?>" class="btn btn-primary mt-2">+ Nueva empresa</a>
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Eslogan</th>
                    <th scope="col">Descripción</th>
                    <th scope="col" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empresasLista as $empresaItem): ?>
                    <tr>
                        <th scope="row"><?= (int) $empresaItem['id_empresa'] ?></th>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="<?= !empty($empresaItem['url_imagen'])
                                        ? htmlspecialchars((string) $empresaItem['url_imagen'], ENT_QUOTES, 'UTF-8')
                                        : asset('assets/images/homepage-one/sallers-cover.png') ?>"
                                    alt="<?= htmlspecialchars((string) $empresaItem['nombre'], ENT_QUOTES, 'UTF-8') ?>"
                                    width="48" height="48" class="rounded"
                                    style="object-fit: cover;"
                                    onerror="this.src='<?= asset('assets/images/homepage-one/sallers-cover.png') ?>'">
                                <a href="<?= empresas_url('show', ['id' => (int) $empresaItem['id_empresa']]) ?>"
                                    class="text-decoration-none">
                                    <?= htmlspecialchars((string) $empresaItem['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                </a>
                            </div>
                        </td>
                        <td>
                            <small class="text-muted">
                                <?= htmlspecialchars(mb_strimwidth((string) ($empresaItem['eslogan'] ?? '—'), 0, 60, '…'), ENT_QUOTES, 'UTF-8') ?>
                            </small>
                        </td>
                        <td>
                            <small class="text-muted">
                                <?= htmlspecialchars(mb_strimwidth((string) ($empresaItem['descripcion'] ?? '—'), 0, 90, '…'), ENT_QUOTES, 'UTF-8') ?>
                            </small>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="<?= empresas_url('show', ['id' => (int) $empresaItem['id_empresa']]) ?>"
                                    class="btn btn-sm btn-outline-secondary">Ver</a>
                                <a href="<?= empresas_url('edit', ['id' => (int) $empresaItem['id_empresa']]) ?>"
                                    class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="<?= empresas_url('delete') ?>" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Eliminar la empresa «<?= htmlspecialchars((string) $empresaItem['nombre'], ENT_QUOTES, 'UTF-8') ?>»? Esta acción no se puede deshacer.');">
                                    <?= empresas_csrf_field() ?>
                                    <input type="hidden" name="redirect" value="<?= htmlspecialchars((string) $empresaRedirect, ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="hidden" name="id" value="<?= (int) $empresaItem['id_empresa'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
