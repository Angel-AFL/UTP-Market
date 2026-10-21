<?php
declare(strict_types=1);

/**
 * CRUD de empresas · Detalle
 *
 * GET ?id=N -> muestra la información de la empresa
 */

require_once __DIR__ . '/_bootstrap.php';

if (!defined('UTP_FRONT_CONTROLLER') && !defined('EMPRESAS_EMBEDDED')) {
    // Acceso directo al archivo: se renderiza con el layout del sitio
    define('UTP_FRONT_CONTROLLER', true);
    ViewController::renderFile(__FILE__, [], 'main');
    return;
}

$empresaId = (int) ($_GET['id'] ?? 0);
$empresa   = null;

if (Supabase::isAvailable() && $empresaId > 0) {
    try {
        $empresa = EmpresaModel::find($empresaId);
    } catch (Throwable $e) {
        $empresa = null;
    }
}

if (!$empresa) {
    empresas_flash('No encontramos la empresa que buscas.', 'error');
    empresas_redirect(empresas_url('empresas'));
}

$empresasTitulo    = $empresa['nombre'];
$empresasSubtitulo = 'Detalle de la empresa #' . (int) $empresa['id_empresa'];
$empresasAcciones  = '<a href="' . empresas_url('edit', ['id' => (int) $empresa['id_empresa']]) . '" class="shop-btn" style="padding: 10px 18px; font-size: 1.35rem; line-height: 1;">Editar</a>';

require __DIR__ . '/_layout.php';
?>

<section class="empresa-detail">
    <div class="row g-4 align-items-stretch">
        <div class="col-lg-8">
            <div class="empresa-detail__card h-100">
                <h2 class="empresa-detail__title">Información de la empresa</h2>

                <dl class="empresa-detail__list">
                    <div class="empresa-detail__item">
                        <dt>Eslogan</dt>
                        <dd><?= htmlspecialchars((string) ($empresa['eslogan'] ?? 'Sin eslogan.'), ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>

                    <div class="empresa-detail__item empresa-detail__item--wide">
                        <dt>Descripción</dt>
                        <dd class="empresa-detail__description"><?= htmlspecialchars((string) ($empresa['descripcion'] ?? 'Sin descripción.'), ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>

                    <div class="empresa-detail__item">
                        <dt>Redes sociales</dt>
                        <dd><?= htmlspecialchars((string) ($empresa['whatsapp'] ?? 'Sin WhatsApp.'), ENT_QUOTES, 'UTF-8') ?></dd>
                        <dd><?= htmlspecialchars((string) ($empresa['facebook'] ?? 'Sin Facebook.'), ENT_QUOTES, 'UTF-8') ?></dd>
                        <dd><?= htmlspecialchars((string) ($empresa['instagram'] ?? 'Sin Instagram.'), ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>

                    <div class="empresa-detail__item">
                        <dt>Correo</dt>
                        <dd><?= htmlspecialchars((string) ($empresa['correo'] ?? 'Sin correo.'), ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>

                    <div class="empresa-detail__item">
                        <dt>Direccion</dt>
                        <dd><?= htmlspecialchars((string) ($empresa['direccion'] ?? 'Dirección no proporcionada'), ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>

                    <div class="empresa-detail__item">
                        <dt>Teléfono</dt>
                        <dd><?= htmlspecialchars((string) ($empresa['telefono'] ?? 'Sin teléfono.'), ENT_QUOTES, 'UTF-8') ?></dd>
                    </div>

                    <div class="empresa-detail__item">
                        <dt>Imagen</dt>
                        <dd>
                            <?php if (!empty($empresa['url_imagen'])): ?>
                                <a href="<?= htmlspecialchars((string) $empresa['url_imagen'], ENT_QUOTES, 'UTF-8') ?>"
                                    target="_blank" rel="noopener noreferrer" class="empresa-detail__link">Ver imagen original</a>
                            <?php else: ?>
                                <span class="text-muted">Sin imagen</span>
                            <?php endif; ?>
                        </dd>
                    </div>

                    <div class="empresa-detail__item">
                        <dt>Fechas</dt>
                        <dd class="empresa-detail__dates">
                            <span><strong>Creada:</strong> <?= htmlspecialchars((string) ($empresa['created_at'] ?? '—'), ENT_QUOTES, 'UTF-8') ?></span>
                            <span><strong>Actualizada:</strong> <?= htmlspecialchars((string) ($empresa['updated_at'] ?? '—'), ENT_QUOTES, 'UTF-8') ?></span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="col-lg-4">
            <aside class="empresa-detail__card empresa-detail__image-card h-100">
                <h2 class="empresa-detail__title">Imagen de la empresa</h2>
                <img src="<?= !empty($empresa['url_imagen'])
                        ? htmlspecialchars((string) $empresa['url_imagen'], ENT_QUOTES, 'UTF-8')
                        : asset('assets/images/homepage-one/sallers-cover.png') ?>"
                    alt="<?= htmlspecialchars((string) $empresa['nombre'], ENT_QUOTES, 'UTF-8') ?>"
                    class="empresa-detail__image"
                    onerror="this.src='<?= asset('assets/images/homepage-one/sallers-cover.png') ?>'">

                <div class="d-flex flex-column gap-2 mt-3">
                    <a href="<?= empresas_url('edit', ['id' => (int) $empresa['id_empresa']]) ?>"
                        class="shop-btn" style="margin: 0; width: 100%; text-align: center; border-radius: 6px; padding: 10px; font-size: 1.35rem; text-decoration: none;">
                        Editar empresa
                    </a>
                    <form action="<?= empresas_url('delete') ?>" method="POST" class="m-0"
                        onsubmit="return confirm('¿Eliminar la empresa «<?= htmlspecialchars((string) $empresa['nombre'], ENT_QUOTES, 'UTF-8') ?>»? Esta acción no se puede deshacer.');">
                        <?= empresas_csrf_field() ?>
                        <input type="hidden" name="redirect" value="<?= htmlspecialchars(empresas_url('empresas'), ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" name="id" value="<?= (int) $empresa['id_empresa'] ?>">
                        <button type="submit" class="shop-btn cancel-btn" style="margin: 0; color: #dc2626; border-color: #fecaca; background: #fef2f2; width: 100%; text-align: center; border-radius: 6px; padding: 10px; font-size: 1.35rem; cursor: pointer;">Eliminar empresa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>