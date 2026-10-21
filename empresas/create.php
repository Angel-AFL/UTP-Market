<?php
declare(strict_types=1);

/**
 * CRUD de empresas · Alta
 *
 * GET  -> muestra el formulario
 * POST -> valida, guarda y redirige al listado
 */

require_once __DIR__ . '/_bootstrap.php';

if (!defined('UTP_FRONT_CONTROLLER') && !defined('EMPRESAS_EMBEDDED')) {
    // Acceso directo al archivo: se renderiza con el layout del sitio
    define('UTP_FRONT_CONTROLLER', true);
    ViewController::renderFile(__FILE__, [], 'main');
    return;
}

$camposEditables = [
    'nombre', 'eslogan', 'descripcion', 'logo', 'imagen_portada',
    'correo', 'telefono', 'whatsapp', 'direccion', 'facebook', 'instagram',
];

// ---------------------------------------------------------------- POST
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $empresaErrorRedirect = empresas_destino_redirect(empresas_url('create'), 'error_redirect');

    if (!empresas_csrf_check()) {
        empresas_flash('La sesión del formulario expiró. Vuelve a intentarlo.', 'error');
        empresas_redirect($empresaErrorRedirect);
        return;
    }

    $datos = [];
    foreach ($camposEditables as $campo) {
        $datos[$campo] = empresas_post($campo);
    }

    $errores = EmpresaModel::validar($datos);

    if ($errores) {
        empresas_errores($errores);
        empresas_guardar_old($datos);
        empresas_redirect($empresaErrorRedirect);
        return;
    }

    try {
        $nuevaEmpresaId = EmpresaModel::crear($datos);
        empresas_flash('La empresa se creó correctamente.');
        
        // Si el modelo devuelve el ID de la nueva empresa, podemos redirigir al detalle, o al listado general
        $redirectUrl = $nuevaEmpresaId ? empresas_url('show', ['id' => $nuevaEmpresaId]) : empresas_url('empresas');
        empresas_redirect(empresas_destino_redirect($redirectUrl));
        return;
    } catch (Throwable $e) {
        error_log('Error al crear empresa: ' . $e->getMessage());
        empresas_errores(['general' => 'No se pudo guardar la empresa: ' . $e->getMessage()]);
        empresas_guardar_old($datos);
        empresas_redirect($empresaErrorRedirect);
        return;
    }
}

// ---------------------------------------------------------------- GET
$errores = empresas_errores_take();
$empresa = empresas_old();

// Asegurar valores por defecto vacíos si no hay datos previos
foreach ($camposEditables as $campo) {
    if (!isset($empresa[$campo])) {
        $empresa[$campo] = '';
    }
}

$empresaAccion        = empresas_url('create');
$empresaMetodo        = 'POST';
$empresaEnviar        = 'Guardar empresa';
$empresaRedirect      = $empresaRedirect      ?? empresas_url('empresas');
$empresaErrorRedirect = $empresaErrorRedirect ?? empresas_url('create');

$empresasTitulo    = 'Nueva empresa';
$empresasSubtitulo = 'Registra una nueva empresa en UTP-Market.';
$empresasAcciones  = '';

require __DIR__ . '/_layout.php';

$imgDefault = asset('assets/images/homepage-one/sallers-cover.png');
$e = static fn ($value): string => htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');

$secciones = [
    [
        'titulo' => 'Información general', 'subtitulo' => 'Los datos principales de tu negocio',
        'icono' => '01',
        'campos' => [
            ['nombre', 'Nombre de la empresa', 'text', 'Ej. Dope Prints', 150, true, 12],
            ['eslogan', 'Eslogan', 'text', 'Una frase que identifique tu negocio', 255, false, 12],
            ['descripcion', 'Descripción', 'textarea', 'Describe los productos o servicios que ofrece tu empresa...', 5000, false, 12],
        ],
    ],
    [
        'titulo' => 'Contacto y ubicación', 'subtitulo' => 'Cómo pueden comunicarse tus clientes',
        'icono' => '02',
        'campos' => [
            ['correo', 'Correo electrónico', 'email', 'contacto@empresa.com', 150, false, 6],
            ['telefono', 'Teléfono', 'tel', '9991234567', 25, false, 6],
            ['whatsapp', 'WhatsApp', 'tel', '9991234567', 25, false, 6],
            ['direccion', 'Dirección', 'text', 'Calle, número, colonia, ciudad...', 255, false, 12],
        ],
    ],
    [
        'titulo' => 'Redes sociales', 'subtitulo' => 'Comparte los perfiles oficiales',
        'icono' => '03',
        'campos' => [
            ['facebook', 'Facebook', 'url', 'https://facebook.com/tuempresa', 255, false, 6],
            ['instagram', 'Instagram', 'url', 'https://instagram.com/tuempresa', 255, false, 6],
        ],
    ],
];
?>
<style>
/* Diseño independiente de Bootstrap, idéntico al editor. */
.utp-empresa-editor { --utp-vino:#7c2d36;--utp-oscuro:#63242c;color:#39292d;font-family:inherit;width:100%;display:block; }
.utp-empresa-editor *, .utp-empresa-editor *::before,.utp-empresa-editor *::after {box-sizing:border-box;}
.utp-empresa-editor .utp-main-grid {display:grid;grid-template-columns:minmax(0,2fr) minmax(270px,1fr);gap:20px;align-items:start;}
.utp-empresa-editor .utp-left,.utp-empresa-editor .utp-right {min-width:0;}
.utp-empresa-editor .utp-fields-grid {display:grid;grid-template-columns:repeat(12,minmax(0,1fr));gap:16px;}
.utp-empresa-editor .utp-field-span-12 {grid-column:span 12;min-width:0;}
.utp-empresa-editor .utp-field-span-6 {grid-column:span 6;min-width:0;}
.utp-empresa-editor .utp-card {display:block;background:#fff;border:1px solid #ece3e3;border-radius:16px;padding:26px;margin:0 0 22px;box-shadow:0 6px 22px rgba(90,35,45,.06);}
.utp-empresa-editor .utp-heading {display:flex;align-items:center;gap:12px;margin:0 0 22px;padding:0 0 16px;border-bottom:1px solid #f0e9e9;}
.utp-empresa-editor .utp-icon {background:#f8ecee;color:var(--utp-vino);font-weight:700;border-radius:11px;display:flex;align-items:center;justify-content:center;width:43px;height:43px;flex:none;}
.utp-empresa-editor .utp-heading h3 {font-size:19px;line-height:1.3;font-weight:700;color:var(--utp-oscuro);margin:0;}
.utp-empresa-editor .utp-heading p {color:#8c8183;font-size:13px;line-height:1.5;margin:4px 0 0;}
.utp-empresa-editor label {display:block;font-weight:600;margin:0 0 8px;color:#47383b;font-size:14px;}
.utp-empresa-editor input.form-control,.utp-empresa-editor textarea.form-control {display:block;width:100%;min-width:0;min-height:47px;padding:11px 14px;color:#3c3033;background:#fff;border:1px solid #dfd5d7;border-radius:10px;font-family:inherit;font-size:14px;line-height:1.5;box-shadow:none;appearance:none;}
.utp-empresa-editor textarea.form-control {min-height:130px;resize:vertical;}
.utp-empresa-editor input.form-control:focus,.utp-empresa-editor textarea.form-control:focus {border-color:var(--utp-vino);outline:0;box-shadow:0 0 0 3px rgba(124,45,54,.11);}
.utp-empresa-editor .form-control::placeholder {color:#afa5a7;opacity:1;}
.utp-empresa-editor .utp-preview {display:block;width:100%;height:184px;object-fit:contain;background:#faf8f8;border:1px dashed #dacbcd;border-radius:11px;padding:12px;margin:0 0 15px;}
.utp-empresa-editor .utp-preview.portada {height:160px;object-fit:cover;}
.utp-empresa-editor .utp-help {font-size:12px;color:#92868a;display:block;margin-top:7px;line-height:1.5;}
.utp-empresa-editor .utp-error {font-size:12px;color:#b32940;margin-top:6px;}
.utp-empresa-editor .utp-actions {display:flex;gap:12px;justify-content:flex-end;flex-wrap:wrap;margin:4px 0 20px;}
.utp-empresa-editor .utp-btn {display:inline-flex;justify-content:center;align-items:center;text-decoration:none;padding:12px 26px;font-family:inherit;font-size:14px;line-height:1.4;border-radius:32px;font-weight:600;cursor:pointer;transition:background-color .2s,border-color .2s;}
.utp-empresa-editor .utp-btn.utp-primary {color:#fff;background:var(--utp-vino);border:1px solid var(--utp-vino);}
.utp-empresa-editor .utp-btn.utp-primary:hover {background:var(--utp-oscuro);color:#fff;}
.utp-empresa-editor .utp-btn.utp-secondary {color:var(--utp-vino);background:#fff;border:1px solid #d7c9cc;}
.utp-empresa-editor .utp-btn.utp-secondary:hover {background:#f9eef0;color:var(--utp-vino);}
@media(max-width:991px){.utp-empresa-editor .utp-main-grid{grid-template-columns:minmax(0,1fr);}}
@media(max-width:600px){.utp-empresa-editor .utp-card{padding:18px;}.utp-empresa-editor .utp-field-span-6{grid-column:span 12;}.utp-empresa-editor .utp-actions{flex-direction:column;}.utp-empresa-editor .utp-btn{width:100%;}}
</style>

<form action="<?= $e($empresaAccion) ?>" method="POST" class="utp-empresa-editor">
    <?= empresas_csrf_field() ?>
    <input type="hidden" name="redirect" value="<?= $e($empresaRedirect) ?>">
    <input type="hidden" name="error_redirect" value="<?= $e($empresaErrorRedirect) ?>">

    <?php if ($errores): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Revisa la información antes de guardar:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ($errores as $error): ?>
                    <li><?= $e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="utp-main-grid">
        <div class="utp-left">
            <?php foreach ($secciones as $seccion): ?>
                <section class="utp-card">
                    <div class="utp-heading">
                        <span class="utp-icon"><?= $e($seccion['icono']) ?></span>
                        <div>
                            <h3><?= $e($seccion['titulo']) ?></h3>
                            <p><?= $e($seccion['subtitulo']) ?></p>
                        </div>
                    </div>
                    <div class="utp-fields-grid">
                        <?php foreach ($seccion['campos'] as [$nombre, $etiqueta, $tipo, $placeholder, $max, $obligatorio, $columnas]): ?>
                            <div class="utp-field-span-<?= (int) $columnas ?>">
                                <label for="emp_<?= $e($nombre) ?>">
                                    <?= $e($etiqueta) ?><?= $obligatorio ? ' *' : '' ?>
                                </label>
                                <?php if ($tipo === 'textarea'): ?>
                                    <textarea name="<?= $e($nombre) ?>" id="emp_<?= $e($nombre) ?>" class="form-control" maxlength="<?= (int) $max ?>" placeholder="<?= $e($placeholder) ?>" rows="5"><?= $e($empresa[$nombre] ?? '') ?></textarea>
                                <?php else: ?>
                                    <input type="<?= $e($tipo) ?>" name="<?= $e($nombre) ?>" id="emp_<?= $e($nombre) ?>" class="form-control" maxlength="<?= (int) $max ?>" value="<?= $e($empresa[$nombre] ?? '') ?>" placeholder="<?= $e($placeholder) ?>" <?= $obligatorio ? 'required' : '' ?>>
                                <?php endif; ?>
                                <?php if (isset($errores[$nombre])): ?>
                                    <div class="utp-error"><?= $e($errores[$nombre]) ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>

        <div class="utp-right">
            <section class="utp-card">
                <div class="utp-heading">
                    <span class="utp-icon">04</span>
                    <div>
                        <h3>Imágenes de la empresa</h3>
                        <p>Logo y portada de tu negocio</p>
                    </div>
                </div>

                <label for="emp_logo">Logo de la empresa</label>
                <img id="preview-logo" class="utp-preview" src="<?= $e($empresa['logo'] ?: $imgDefault) ?>" alt="Vista previa del logo">
                <input type="url" name="logo" id="emp_logo" class="form-control" maxlength="255" value="<?= $e($empresa['logo']) ?>" placeholder="https://ejemplo.com/logo.png">
                <small class="utp-help">Introduce una URL pública que comience con https://</small>
                <?php if (isset($errores['logo'])): ?><div class="utp-error"><?= $e($errores['logo']) ?></div><?php endif; ?>

                <div style="margin-top:25px">
                    <label for="emp_imagen_portada">Imagen de portada</label>
                    <img id="preview-portada" class="utp-preview portada" src="<?= $e($empresa['imagen_portada'] ?: $imgDefault) ?>" alt="Vista previa de la portada">
                    <input type="url" name="imagen_portada" id="emp_imagen_portada" class="form-control" maxlength="255" value="<?= $e($empresa['imagen_portada']) ?>" placeholder="https://ejemplo.com/portada.jpg">
                    <small class="utp-help">Imagen horizontal para presentar el negocio</small>
                    <?php if (isset($errores['imagen_portada'])): ?><div class="utp-error"><?= $e($errores['imagen_portada']) ?></div><?php endif; ?>
                </div>
            </section>
        </div>
    </div>

    <div class="utp-actions">
        <a class="utp-btn utp-secondary" href="<?= $e(empresas_url('empresas')) ?>">Cancelar</a>
        <button class="utp-btn utp-primary" type="submit">Guardar empresa</button>
    </div>
</form>

<script>
(function () {
    const fallback = <?= json_encode($imgDefault, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
    [['emp_logo', 'preview-logo'], ['emp_imagen_portada', 'preview-portada']]
        .forEach(function (ids) {
            const input = document.getElementById(ids[0]);
            const preview = document.getElementById(ids[1]);
            if (!input || !preview) return;
            preview.addEventListener('error', function () {
                if (preview.src !== fallback) preview.src = fallback;
            });
            input.addEventListener('input', function () {
                const url = input.value.trim();
                preview.src = /^https?:\/\//i.test(url) ? url : fallback;
            });
        });
})();
</script>