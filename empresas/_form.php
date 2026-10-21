<?php
declare(strict_types=1);

/**
 * Formulario de empresa (compartido por create y edit).
 *
 * Variables esperadas:
 *   $empresa        array  Datos de la empresa (puede estar vacío al crear)
 *   $categorias     array  Catálogo de categorías de empresa
 *   $errores        array  Errores de validación por campo
 *   $empresaAccion  string  URL a la que se envía el formulario
 *   $empresaMetodo  string  Método HTTP (POST)
 *   $empresaEnviar  string  Texto del botón de guardar
 */

$empresa       = $empresa       ?? [];
$categorias    = $categorias    ?? [];
$errores       = $errores       ?? [];
$empresaAccion = $empresaAccion ?? empresas_url('create');
$empresaMetodo = $empresaMetodo ?? 'POST';
$empresaEnviar = $empresaEnviar ?? 'Guardar empresa';
$empresaRedirect = $empresaRedirect ?? empresas_url('empresas');
$empresaErrorRedirect = $empresaErrorRedirect ?? $empresaRedirect;

$empresaNombre     = (string) ($empresa['nombre'] ?? '');
$empresaDescripcion = (string) ($empresa['descripcion'] ?? '');
$empresaImagen     = (string) ($empresa['url_imagen'] ?? '');
?>
<form action="<?= htmlspecialchars((string) $empresaAccion, ENT_QUOTES, 'UTF-8') ?>"
    method="<?= htmlspecialchars((string) $empresaMetodo, ENT_QUOTES, 'UTF-8') ?>"
    class="empresas-form" novalidate>

    <?= empresas_csrf_field() ?>
    <input type="hidden" name="redirect" value="<?= htmlspecialchars((string) $empresaRedirect, ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="error_redirect" value="<?= htmlspecialchars((string) ($empresaErrorRedirect ?? $empresaRedirect), ENT_QUOTES, 'UTF-8') ?>">

    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger">
            <strong>Revisa los siguientes datos:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ($errores as $empresaError): ?>
                    <li><?= htmlspecialchars((string) $empresaError, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row g-4">

        <div class="col-lg-8">
            <div class="account-section">
                <div class="review-form">

                    <div class="review-form-name">
                        <label for="empresa_nombre" class="form-label">Nombre de la empresa *</label>
                        <input type="text" id="empresa_nombre" name="nombre" class="form-control"
                            value="<?= htmlspecialchars($empresaNombre, ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="Ej. Dope Prints" maxlength="180" required>
                        <?php if (!empty($errores['nombre'])): ?>
                            <div class="form-text text-danger"><?= htmlspecialchars((string) $errores['nombre'], ENT_QUOTES, 'UTF-8') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="review-form-name address-form">
                        <label for="empresa_descripcion" class="form-label">Descripción</label>
                        <textarea id="empresa_descripcion" name="descripcion" class="form-control" rows="6"
                            maxlength="5000"
                            placeholder="Describe qué servicios ofrece la empresa..."><?= htmlspecialchars($empresaDescripcion, ENT_QUOTES, 'UTF-8') ?></textarea>
                        <?php if (!empty($errores['descripcion'])): ?>
                            <div class="form-text text-danger"><?= htmlspecialchars((string) $errores['descripcion'], ENT_QUOTES, 'UTF-8') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="submit-btn d-flex flex-wrap gap-2">
                        <button type="submit" class="shop-btn"><?= htmlspecialchars((string) $empresaEnviar, ENT_QUOTES, 'UTF-8') ?></button>
                        <a href="<?= empresas_url('empresas') ?>" class="shop-btn cancel-btn">Cancelar</a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="img-upload-section">
                <div class="logo-wrapper">
                    <h5 class="comment-title">Imagen de la empresa</h5>
                    <p class="paragraph">Pega la URL de una imagen (http o https).</p>

                    <img src="<?= $empresaImagen !== '' ? htmlspecialchars($empresaImagen, ENT_QUOTES, 'UTF-8') : asset('assets/images/homepage-one/sallers-cover.png') ?>"
                        alt="Vista previa de la empresa" class="upload-img" id="empresa-preview"
                        onerror="this.src='<?= asset('assets/images/homepage-one/sallers-cover.png') ?>'">

                    <div class="review-form-name mt-3">
                        <label for="empresa_imagen" class="form-label">URL de la imagen</label>
                        <input type="url" id="empresa_imagen" name="url_imagen" class="form-control"
                            value="<?= htmlspecialchars($empresaImagen, ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="https://.../logo.png">
                        <?php if (!empty($errores['url_imagen'])): ?>
                            <div class="form-text text-danger"><?= htmlspecialchars((string) $errores['url_imagen'], ENT_QUOTES, 'UTF-8') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

<script>
    (function () {
        var input = document.getElementById('empresa_imagen');
        var preview = document.getElementById('empresa-preview');
        if (!input || !preview) { return; }
        input.addEventListener('input', function () {
            preview.src = input.value.trim() || '<?= asset('assets/images/homepage-one/sallers-cover.png') ?>';
        });
    })();
</script>
