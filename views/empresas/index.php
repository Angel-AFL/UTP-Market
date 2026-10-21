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
    ['vista' => 'empresas', 'titulo' => 'Listado',        'necesitaId' => false],
    ['vista' => 'create',   'titulo' => 'Nueva empresa',  'necesitaId' => false],
    ['vista' => 'edit',     'titulo' => 'Editar',         'necesitaId' => true],
    ['vista' => 'show',     'titulo' => 'Detalle',        'necesitaId' => true],
];
?>
<div class="tab-pane fade" id="v-pills-empresas" role="tabpanel"
    aria-labelledby="v-pills-empresas-tab" tabindex="0">

    <ul class="nav nav-pills empresas-subtabs" role="tablist">
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
            <li class="nav-item" role="presentation">
                <?php if ($empresasTabBloqueada): ?>
                    <span class="nav-link disabled" aria-disabled="true">
                        <?= htmlspecialchars($empresasTab['titulo'], ENT_QUOTES, 'UTF-8') ?>
                    </span>
                <?php else: ?>
                    <a class="nav-link <?= $empresasTabActiva ? 'active' : '' ?>"
                        href="<?= htmlspecialchars($empresasTabUrl, ENT_QUOTES, 'UTF-8') ?>"
                        <?= $empresasTabActiva ? 'aria-current="page"' : '' ?>>
                        <?= htmlspecialchars($empresasTab['titulo'], ENT_QUOTES, 'UTF-8') ?>
                    </a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="empresas-subtab-content">
        <?php require __DIR__ . '/../../empresas/' . $empresasArchivo . '.php'; ?>
    </div>

</div>

<style>
    .empresas-subtabs {
        display: flex;
        flex-wrap: wrap;
        gap: .8rem;
        margin-bottom: 2.4rem;
        padding-bottom: 1.2rem;
        border-bottom: 1px solid rgba(122, 46, 52, .15);
    }

    .empresas-subtabs .nav-link {
        padding: .8rem 1.6rem;
        border: 1px solid rgba(122, 46, 52, .25);
        border-radius: .5rem;
        color: #3b2a1f;
        background: transparent;
        font-size: 1.4rem;
        font-weight: 600;
        line-height: 1.2;
        cursor: pointer;
    }

    .empresas-subtabs .nav-link:hover {
        background: rgba(122, 46, 52, .08);
    }

    .empresas-subtabs .nav-link.active {
        background: #7a2e34;
        border-color: #7a2e34;
        color: #fff;
    }

    .empresas-subtabs .nav-link.disabled {
        opacity: .45;
        cursor: not-allowed;
    }
</style>

<script>
    // Al entrar con ?vista=... se activa la pestaña "Empresas" del panel
    (function () {
        document.addEventListener('DOMContentLoaded', function () {
            var tab = document.getElementById('v-pills-empresas-tab');
            if (tab && window.bootstrap && window.bootstrap.Tab) {
                window.bootstrap.Tab.getOrCreateInstance(tab).show();
            }
        });
    })();
</script>
