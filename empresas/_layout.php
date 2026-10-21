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

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h5 class="heading mb-1"><?= htmlspecialchars((string) $empresasTitulo, ENT_QUOTES, 'UTF-8') ?></h5>
            <p class="paragraph mb-0"><?= htmlspecialchars((string) $empresasSubtitulo, ENT_QUOTES, 'UTF-8') ?></p>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <?= $empresasAcciones ?>
            <a href="<?= empresas_url('empresas') ?>" class="btn btn-outline-secondary btn-sm">Ver todas</a>
            <a href="<?= empresas_url('create') ?>" class="btn btn-primary btn-sm">+ Nueva empresa</a>
        </div>
    </div>

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
