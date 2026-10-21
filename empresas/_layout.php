<?php
declare(strict_types=1);

/**
 * Cabecera común del módulo de empresas.
 *
 * Se usa tanto en las páginas independientes del CRUD (`/empresas`,
 * `/empresas/create`, ...) como dentro de la pestaña "Empresas" del
 * panel de usuario (`views/empresas.php`), por eso solo genera HTML
 * parcial (nunca <html> ni <head>).
 *
 * Variables opcionales:
 *   $empresasTitulo    string  Título del bloque
 *   $empresasSubtitulo string  Texto auxiliar
 *   $empresasAcciones  string  HTML con los botones de la derecha
 */

$empresasTitulo    = $empresasTitulo    ?? 'Empresas';
$empresasSubtitulo = $empresasSubtitulo ?? 'Gestiona las empresas registradas en UTP-Market.';
$empresasAcciones  = $empresasAcciones  ?? '';
$empresasFlash     = empresas_flash_take();
$empresasDbError   = null;

if (!Supabase::isAvailable()) {
    $empresasDbError = Supabase::lastError();
}
?>
<div class="empresas-module">

    <?php if (!defined('EMPRESAS_EMBEDDED')): ?>
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-3 border-bottom">
            <div>
                <h4 class="heading mb-1" style="font-size: 2rem; color: #3b2a1f; font-weight: 700;"><?= htmlspecialchars((string) $empresasTitulo, ENT_QUOTES, 'UTF-8') ?></h4>
                <p class="paragraph mb-0" style="color: #64748b;"><?= htmlspecialchars((string) $empresasSubtitulo, ENT_QUOTES, 'UTF-8') ?></p>
            </div>

            <div class="d-flex flex-wrap align-items-center gap-2">
                <?= $empresasAcciones ?>
                <a href="<?= empresas_url('empresas') ?>" class="shop-btn cancel-btn" style="margin: 0; padding: 10px 18px; font-size: 1.35rem; line-height: 1; border-radius: 6px;">Ver todas</a>
                <a href="<?= empresas_url('create') ?>" class="shop-btn" style="margin: 0; padding: 10px 18px; font-size: 1.35rem; line-height: 1; border-radius: 6px;">+ Nueva empresa</a>
            </div>
        </div>
    <?php else: ?>
        <?php if (!empty($empresasSubtitulo) && $empresasSubtitulo !== 'Gestiona las empresas registradas en UTP-Market.'): ?>
            <div class="mb-3">
                <span style="display: inline-flex; align-items: center; background: #faf8f7; color: #64748b; font-size: 1.3rem; padding: 6px 14px; border-radius: 6px; border: 1px solid #ede8e3;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <?= htmlspecialchars((string) $empresasSubtitulo, ENT_QUOTES, 'UTF-8') ?>
                </span>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($empresasDbError !== null): ?>
        <div class="alert alert-danger" role="alert">
            <strong>No se pudo conectar con Supabase.</strong><br>
            <small>
                Revisa <code>SUPABASE_URL</code> y <code>SUPABASE_SERVICE_ROLE_KEY</code> en el archivo
                <code>.env</code>, y que la tabla <code>public.empresa</code> exista en el proyecto.
                <br>Detalle: <?= htmlspecialchars((string) $empresasDbError, ENT_QUOTES, 'UTF-8') ?>
            </small>
        </div>
    <?php endif; ?>

    <?php foreach ($empresasFlash as $empresasFlashItem): ?>
        <?php
        $empresasFlashTipo = $empresasFlashItem['tipo'] ?? 'success';
        $empresasFlashClase = match ($empresasFlashTipo) {
            'error'   => 'alert-danger',
            'warning' => 'alert-warning',
            'info'    => 'alert-info',
            default   => 'alert-success',
        };
        ?>
        <div class="alert <?= $empresasFlashClase ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars((string) ($empresasFlashItem['mensaje'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endforeach; ?>
</div>
