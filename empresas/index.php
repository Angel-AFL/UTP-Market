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

<form action="<?= empresas_url('empresas') ?>" method="GET" class="emp-search-bar mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-sm-8 col-md-6 col-lg-5">
            <label for="empresas_busqueda" class="form-label mb-1" style="font-weight: 600; color: #3b2a1f; font-size: 1.35rem;">Buscar empresa</label>
            <input type="search" id="empresas_busqueda" name="q" class="form-control"
                value="<?= htmlspecialchars($empresasBusqueda, ENT_QUOTES, 'UTF-8') ?>"
                placeholder="Nombre o descripción..." style="height: 4.4rem; font-size: 1.4rem; border-radius: 6px;">
        </div>
        <div class="col-auto">
            <button type="submit" class="emp-search-btn">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                Buscar
            </button>
        </div>
        <?php if ($empresasBusqueda !== ''): ?>
            <div class="col-auto">
                <a href="<?= empresas_url('empresas') ?>" class="emp-search-clear">Limpiar filtro</a>
            </div>
        <?php endif; ?>
    </div>
</form>

<?php if (!$empresasLista): ?>
    <div class="text-center py-5">
        <h5 class="heading"><?= $empresasBusqueda !== '' ? 'Sin resultados' : 'Todavía no hay empresas' ?></h5>
        <p class="paragraph">
            <?= $empresasBusqueda !== ''
                ? 'Prueba con otro término de búsqueda.'
                : 'Crea la primera empresa para que aparezca en el listado.' ?>
        </p>
        <a href="<?= empresas_url('create') ?>" class="shop-btn mt-3" style="display: inline-block; margin: 0; border-radius: 6px; padding: 10px 20px;">+ Nueva empresa</a>
    </div>
<?php else: ?>
    <div class="cart-section">
        <table>
            <tbody>
                <tr class="table-row table-top-row">
                    <td class="table-wrapper" style="width: 70px;">
                        <div class="table-wrapper-center">
                            <h5 class="table-heading">#</h5>
                        </div>
                    </td>
                    <td class="table-wrapper wrapper-product">
                        <h5 class="table-heading">EMPRESA</h5>
                    </td>
                    <td class="table-wrapper">
                        <h5 class="table-heading">ESLOGAN</h5>
                    </td>
                    <td class="table-wrapper">
                        <h5 class="table-heading">DESCRIPCIÓN</h5>
                    </td>
                    <td class="table-wrapper" style="width: 140px;">
                        <div class="table-wrapper-center">
                            <h5 class="table-heading">ACCIONES</h5>
                        </div>
                    </td>
                </tr>
                <?php foreach ($empresasLista as $empresaItem): ?>
                    <tr class="table-row ticket-row">
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <span class="ticker-number" style="font-size: 1.4rem; font-weight: 600;">#<?= (int) $empresaItem['id_empresa'] ?></span>
                            </div>
                        </td>
                        <td class="table-wrapper wrapper-product">
                            <div class="wrapper">
                                <div class="wrapper-img">
                                    <img src="<?= !empty($empresaItem['url_imagen'])
                                            ? htmlspecialchars((string) $empresaItem['url_imagen'], ENT_QUOTES, 'UTF-8')
                                            : asset('assets/images/homepage-one/sallers-cover.png') ?>"
                                        alt="<?= htmlspecialchars((string) $empresaItem['nombre'], ENT_QUOTES, 'UTF-8') ?>"
                                        onerror="this.src='<?= asset('assets/images/homepage-one/sallers-cover.png') ?>'">
                                </div>
                                <div class="wrapper-content">
                                    <h5 class="heading mb-0">
                                        <a href="<?= empresas_url('show', ['id' => (int) $empresaItem['id_empresa']]) ?>" style="color: inherit; text-decoration: none;">
                                            <?= htmlspecialchars((string) $empresaItem['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <p class="paragraph mb-0" style="font-size: 1.35rem; color: #64748b;">
                                <?= htmlspecialchars(mb_strimwidth((string) ($empresaItem['eslogan'] ?? '—'), 0, 60, '…'), ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        </td>
                        <td class="table-wrapper">
                            <p class="paragraph mb-0" style="font-size: 1.35rem; color: #64748b;">
                                <?= htmlspecialchars(mb_strimwidth((string) ($empresaItem['descripcion'] ?? '—'), 0, 90, '…'), ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center" style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                <a href="<?= empresas_url('show', ['id' => (int) $empresaItem['id_empresa']]) ?>"
                                    class="action-icon-btn" title="Ver detalle">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a href="<?= empresas_url('edit', ['id' => (int) $empresaItem['id_empresa']]) ?>"
                                    class="action-icon-btn" title="Editar">
                                    <svg width="15" height="15" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 2L16 7M2 16H7L16.5 6.5C17.3284 5.67157 17.3284 4.32843 16.5 3.5V3.5C15.6716 2.67157 14.3284 2.67157 13.5 3.5L4 13V16H2V14Z" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <form action="<?= empresas_url('delete') ?>" method="POST"
                                    class="d-inline mb-0"
                                    onsubmit="return confirm('¿Eliminar la empresa «<?= htmlspecialchars((string) $empresaItem['nombre'], ENT_QUOTES, 'UTF-8') ?>»? Esta acción no se puede deshacer.');">
                                    <?= empresas_csrf_field() ?>
                                    <input type="hidden" name="redirect" value="<?= htmlspecialchars((string) $empresaRedirect, ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="hidden" name="id" value="<?= (int) $empresaItem['id_empresa'] ?>">
                                    <button type="submit" class="action-icon-btn action-delete-btn" title="Eliminar">
                                        <svg width="15" height="18" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.7879 5.95508C14.7102 6.91333 14.6353 7.84896 14.5582 8.7853C14.3801 10.9315 14.2028 13.0776 14.0219 15.2238C13.9604 15.9503 13.9208 16.6802 13.8176 17.4018C13.7074 18.1756 13.0827 18.719 12.3039 18.7225C9.39528 18.7352 6.48733 18.7367 3.57867 18.7218C2.71582 18.7176 2.09748 18.0823 2.01904 17.158C1.79291 14.4959 1.58161 11.8332 1.36254 9.17114C1.28269 8.19735 1.19859 7.22426 1.11733 6.25117C1.10955 6.15931 1.10673 6.06744 1.10107 5.95578C5.66688 5.95508 10.2171 5.95508 14.7879 5.95508Z" fill="#EB5757"/>
                                            <path d="M4.21259 2.75226C4.22602 2.49644 4.22955 2.29646 4.24863 2.09788C4.32848 1.26118 4.94611 0.650617 5.78564 0.63931C7.22231 0.62023 8.66039 0.62023 10.0971 0.63931C10.9366 0.650617 11.5549 1.26048 11.6348 2.09718C11.6539 2.29575 11.6574 2.49574 11.6694 2.7353C11.7966 2.74095 11.9196 2.75085 12.0425 2.75155C12.9379 2.75297 13.8332 2.74873 14.7286 2.75367C15.4197 2.75721 15.8868 3.18969 15.8861 3.81439C15.8854 4.43838 15.419 4.87298 14.7272 4.87369C10.2038 4.87581 5.67964 4.87581 1.15623 4.87369C0.464398 4.87298 -0.0027105 4.43909 -0.00341717 3.8151C-0.00412384 3.1911 0.462987 2.75721 1.15411 2.75438C2.16536 2.74873 3.17661 2.75226 4.21259 2.75226ZM10.591 2.7353C10.591 2.59821 10.5917 2.49291 10.591 2.38832C10.5861 1.86821 10.4129 1.69508 9.88717 1.69437C8.56993 1.69296 7.2534 1.69155 5.93616 1.69508C5.49661 1.69649 5.31147 1.8774 5.2938 2.30706C5.28815 2.44415 5.29309 2.58195 5.29309 2.7353C7.06967 2.7353 8.80525 2.7353 10.591 2.7353Z" fill="#EB5757"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
