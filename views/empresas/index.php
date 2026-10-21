<?php
/**
 * Pestaña "Empresas" del panel de usuario (views/user-profile.php).
 *
 * Cada vista del CRUD tiene su propia pestaña:
 *
 *   ?vista=empresas  -> empresas/index.php   (tabla de empresas)
 *   ?vista=create    -> empresas/create.php  (alta)
 *   ?vista=edit&id=N -> empresas/edit.php    (edición)
 *   ?vista=show&id=N -> empresas/show.php    (detalle)
 *   ?vista=delete    -> empresas/delete.php  (borrado, solo POST)
 *
 * Solo genera HTML parcial: se incrusta dentro del layout administrativo,
 * por eso nunca imprime <html> ni <head>.
 */

if (!defined('EMPRESAS_EMBEDDED')) {
    define('EMPRESAS_EMBEDDED', true);
}

require_once __DIR__ . '/../../empresas/_bootstrap.php';

$empresasVista      = (string) ($_GET['vista'] ?? 'empresas');
$empresasPermitidas = ['empresas', 'create', 'edit', 'show', 'delete'];

if (!in_array($empresasVista, $empresasPermitidas, true)) {
    $empresasVista = 'empresas';
}

$empresasId = (int) ($_GET['id'] ?? 0);

// Destinos dentro del panel (los usan los formularios al guardar / cancelar)
$empresaRedirect      = empresas_url('empresas');
$empresaErrorRedirect = empresas_url(
    $empresasVista,
    $empresasId > 0 ? ['id' => $empresasId] : []
);

// El borrado se procesa antes de imprimir nada (termina con un redirect)
if ($empresasVista === 'delete') {
    require __DIR__ . '/../../empresas/delete.php';
    return;
}

$empresasArchivo = $empresasVista === 'empresas' ? 'index' : $empresasVista;

$empresasTabs = [
    [
        'vista'      => 'empresas',
        'titulo'     => 'Listado',
        'necesitaId' => false,
        'icono'      => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>'
    ],
    [
        'vista'      => 'create',
        'titulo'     => 'Nueva empresa',
        'necesitaId' => false,
        'icono'      => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>'
    ],
    [
        'vista'      => 'edit',
        'titulo'     => 'Editar',
        'necesitaId' => true,
        'icono'      => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>'
    ],
    [
        'vista'      => 'show',
        'titulo'     => 'Detalle',
        'necesitaId' => true,
        'icono'      => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>'
    ],
];

$isTabActive = isset($_GET['vista']) || (isset($_GET['tab']) && $_GET['tab'] === 'empresas');
?>
<div class="tab-pane fade <?= $isTabActive ? 'show active' : '' ?>" id="v-pills-empresas" role="tabpanel"
    aria-labelledby="v-pills-empresas-tab" tabindex="0">

    <!-- Sub-pestañas del módulo de empresas estilo Shopus Dashboard -->
    <div class="emp-toolbar mb-4">
        <nav class="emp-pill-group" aria-label="Secciones del módulo de empresas">
            <?php foreach ($empresasTabs as $empresasTab): ?>
                <?php
                $empresasTabVista     = $empresasTab['vista'];
                $empresasTabActiva    = $empresasVista === $empresasTabVista;
                $empresasTabBloqueada = $empresasTab['necesitaId'] && $empresasId <= 0;
                $empresasTabUrl       = empresas_url(
                    $empresasTabVista,
                    $empresasTab['necesitaId'] ? ['id' => $empresasId] : []
                );
                ?>
                <?php if ($empresasTabBloqueada): ?>
                    <span class="emp-pill emp-pill-disabled" title="Selecciona una empresa del listado para habilitar">
                        <span class="emp-pill-icon"><?= $empresasTab['icono'] ?></span>
                        <span class="emp-pill-text"><?= htmlspecialchars($empresasTab['titulo'], ENT_QUOTES, 'UTF-8') ?></span>
                    </span>
                <?php else: ?>
                    <a href="<?= htmlspecialchars($empresasTabUrl, ENT_QUOTES, 'UTF-8') ?>"
                       class="emp-pill <?= $empresasTabActiva ? 'emp-pill-active' : '' ?>"
                       <?= $empresasTabActiva ? 'aria-current="page"' : '' ?>>
                        <span class="emp-pill-icon"><?= $empresasTab['icono'] ?></span>
                        <span class="emp-pill-text"><?= htmlspecialchars($empresasTab['titulo'], ENT_QUOTES, 'UTF-8') ?></span>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </nav>
    </div>

    <!-- Contenido de la vista activa -->
    <div class="empresas-subtab-content">
        <?php require __DIR__ . '/../../empresas/' . $empresasArchivo . '.php'; ?>
    </div>

</div>

<style>
    /* -------------------------------------------------------------
     *  Sub-pestañas de navegación de Empresas (Aisladas del layout)
     * ------------------------------------------------------------- */
    #v-pills-empresas .emp-toolbar {
        background: #faf8f7;
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid rgba(122, 46, 52, 0.12);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    }

    #v-pills-empresas .emp-pill-group {
        display: flex;
        flex-direction: row;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin: 0;
        padding: 0;
        border: none;
    }

    #v-pills-empresas .emp-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        border: 1px solid #e7e2de;
        border-radius: 6px;
        color: #3b2a1f !important;
        background: #ffffff;
        font-size: 1.35rem;
        font-weight: 500;
        line-height: 1.2;
        text-decoration: none;
        cursor: pointer;
        width: auto !important;
        margin: 0 !important;
        transition: all 0.2s ease;
    }

    #v-pills-empresas .emp-pill .emp-pill-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    #v-pills-empresas .emp-pill .emp-pill-icon svg {
        stroke: currentColor;
    }

    #v-pills-empresas .emp-pill:hover:not(.emp-pill-active):not(.emp-pill-disabled) {
        background: #ffffff;
        border-color: rgba(122, 46, 52, 0.35);
        color: #7a2e34 !important;
        box-shadow: 0 2px 5px rgba(122, 46, 52, 0.08);
        transform: translateY(-1px);
    }

    #v-pills-empresas .emp-pill.emp-pill-active {
        background: #7a2e34 !important;
        border-color: #7a2e34 !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 3px 8px rgba(122, 46, 52, 0.25);
        cursor: default;
    }

    #v-pills-empresas .emp-pill.emp-pill-active .emp-pill-icon svg {
        stroke: #ffffff !important;
    }

    #v-pills-empresas .emp-pill.emp-pill-disabled {
        background: #f8fafc !important;
        color: #94a3b8 !important;
        border: 1px dashed #cbd5e1 !important;
        cursor: not-allowed;
        opacity: 0.65;
        box-shadow: none;
    }

    #v-pills-empresas .emp-pill.emp-pill-disabled .emp-pill-icon svg {
        stroke: #94a3b8 !important;
    }

    /* -------------------------------------------------------------
     *  Contenedor del contenido
     * ------------------------------------------------------------- */
    .empresas-subtab-content {
        animation: empresasFadeIn 0.2s ease-in-out;
    }

    @keyframes empresasFadeIn {
        from { opacity: 0; transform: translateY(3px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* -------------------------------------------------------------
     *  Buscador del CRUD
     * ------------------------------------------------------------- */
    #v-pills-empresas .emp-search-btn {
        margin: 0 !important;
        height: 4.4rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 22px;
        border-radius: 6px;
        font-size: 1.4rem;
        font-weight: 600;
        border: none;
        background: #7a2e34;
        color: #ffffff;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    #v-pills-empresas .emp-search-btn:hover {
        background: #92373e;
        color: #ffffff;
        box-shadow: 0 2px 6px rgba(122, 46, 52, 0.25);
    }

    #v-pills-empresas .emp-search-clear {
        margin: 0 !important;
        height: 4.4rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 18px;
        border-radius: 6px;
        font-size: 1.35rem;
        font-weight: 500;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    #v-pills-empresas .emp-search-clear:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    /* -------------------------------------------------------------
     *  Iconos de acciones en la tabla
     * ------------------------------------------------------------- */
    .action-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        transition: all 0.2s ease;
        padding: 0;
        cursor: pointer;
    }

    .action-icon-btn:hover {
        background: #f1f5f9;
        color: #7a2e34;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    .action-icon-btn.action-delete-btn:hover {
        background: #fef2f2;
        border-color: #fecaca;
    }

    .action-icon-btn.action-delete-btn:hover svg path {
        fill: #dc2626;
    }

    /* -------------------------------------------------------------
     *  Alineación de inputs y formularios en el tema Shopus
     * ------------------------------------------------------------- */
    #v-pills-empresas .form-control:focus,
    #v-pills-empresas .form-select:focus {
        border-color: #7a2e34;
        box-shadow: 0 0 0 3px rgba(122, 46, 52, 0.12);
        outline: none;
    }

    #v-pills-empresas .cart-section table {
        width: 100%;
        border-collapse: collapse;
    }

    #v-pills-empresas .table-row.table-top-row td {
        background: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
        padding: 14px 16px;
    }

    #v-pills-empresas .table-row.ticket-row td {
        padding: 14px 16px;
        border-bottom: 1px solid #edf2f7;
        vertical-align: middle;
    }

    #v-pills-empresas .table-row.ticket-row:hover {
        background-color: #fdfbfb;
    }
</style>

<script>
    // Al entrar con ?vista=... o ?tab=empresas se activa la pestaña "Empresas" del panel
    (function () {
        document.addEventListener('DOMContentLoaded', function () {
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('vista') || urlParams.get('tab') === 'empresas') {
                var tab = document.getElementById('v-pills-empresas-tab');
                if (tab && window.bootstrap && window.bootstrap.Tab) {
                    window.bootstrap.Tab.getOrCreateInstance(tab).show();
                }
            }
        });
    })();
</script>
