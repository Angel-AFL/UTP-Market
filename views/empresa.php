
<?php
/**
 * UTP-Market — Vista dinámica de empresas
 * Ejemplo: /empresa?id=3
 *
 * Archivo: views/empresa.php
 *
 * Requisitos:
 * - Archivo .env en la raíz del proyecto.
 * - Extensión cURL habilitada en PHP.
 * - Tabla public.empresa en Supabase.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* =========================================================
   1. LEER VARIABLES DEL ARCHIVO .ENV
   ========================================================= */

$envPath = dirname(__DIR__) . '/.env';

if (!is_readable($envPath)) {
    error_log('UTP-Market: no se encuentra el archivo .env.');
    http_response_code(500);
    exit('No se encontró el archivo de configuración.');
}

$env = [];
$lineasEnv = file(
    $envPath,
    FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
);

if ($lineasEnv === false) {
    http_response_code(500);
    exit('No se pudo leer la configuración.');
}

foreach ($lineasEnv as $numero => $linea) {
    $linea = trim($linea);

    if ($linea === '' || str_starts_with($linea, '#')) {
        continue;
    }

    if (!preg_match(
        '/^([A-Za-z_][A-Za-z0-9_]*)\s*=\s*(.*)$/',
        $linea,
        $coincidencias
    )) {
        continue;
    }

    $clave = $coincidencias[1];
    $valor = trim($coincidencias[2]);

    if (
        strlen($valor) >= 2 &&
        (
            ($valor[0] === '"' && substr($valor, -1) === '"') ||
            ($valor[0] === "'" && substr($valor, -1) === "'")
        )
    ) {
        $valor = substr($valor, 1, -1);
    }

    $env[$clave] = $valor;
}

/* =========================================================
   2. CONFIGURACIÓN DE SUPABASE
   ========================================================= */

$supabaseUrl = rtrim(
    trim((string) (
        $env['SUPABASE_URL']
        ?? $env['PUBLIC_SUPABASE_URL']
        ?? ''
    )),
    '/'
);

/*
 * La clave secreta se lee desde .env y nunca se imprime
 * en el HTML. Para una página pública, se recomienda usar
 * una clave publicable con políticas RLS de solo lectura.
 */
$supabaseKey = trim((string) (
    $env['SUPABASE_SERVICE_ROLE_KEY']
    ?? $env['PUBLIC_SUPABASE_PUBLISHABLE_KEY']
    ?? $env['SUPABASE_PUBLISHABLE_KEY']
    ?? ''
));

if (
    !filter_var($supabaseUrl, FILTER_VALIDATE_URL) ||
    strtolower((string) parse_url(
        $supabaseUrl,
        PHP_URL_SCHEME
    )) !== 'https' ||
    $supabaseKey === ''
) {
    error_log('UTP-Market: configuración de Supabase inválida.');
    http_response_code(500);
    exit('Revisa la URL y la clave de Supabase en el archivo .env.');
}

if (!function_exists('curl_init')) {
    http_response_code(500);
    exit('La extensión cURL de PHP no está habilitada.');
}

/* =========================================================
   3. VALIDAR EL ID DE LA EMPRESA
   ========================================================= */

$idTexto = $_GET['id'] ?? null;

if (
    !is_string($idTexto) ||
    !ctype_digit($idTexto) ||
    (int) $idTexto < 1
) {
    http_response_code(400);
    exit('ID inválido. Utiliza /empresa?id=3.');
}

$idEmpresa = (int) $idTexto;

/* =========================================================
   4. FUNCIÓN PARA CONSULTAR SUPABASE
   ========================================================= */

$consultarSupabase = static function (
    string $tabla,
    array $filtros = [],
    string $select = '*'
) use ($supabaseUrl, $supabaseKey): array {

    if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $tabla)) {
        throw new InvalidArgumentException('Nombre de tabla inválido.');
    }

    $parametros = [
        'select' => $select
    ];

    foreach ($filtros as $columna => $valor) {
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $columna)) {
            throw new InvalidArgumentException('Columna inválida.');
        }

        $parametros[$columna] = $valor;
    }

    $url = $supabaseUrl
        . '/rest/v1/'
        . rawurlencode($tabla)
        . '?'
        . http_build_query($parametros);

    $curl = curl_init($url);

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 20,

        // No desactivar la validación del certificado SSL.
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,

        CURLOPT_HTTPHEADER => [
            'apikey: ' . $supabaseKey,
            'Authorization: Bearer ' . $supabaseKey,
            'Accept: application/json'
        ]
    ]);

    $respuesta = curl_exec($curl);
    $codigoHttp = (int) curl_getinfo(
        $curl,
        CURLINFO_HTTP_CODE
    );

    $errorCurl = curl_error($curl);

    curl_close($curl);

    if ($respuesta === false) {
        error_log('UTP-Market cURL: ' . $errorCurl);

        throw new RuntimeException(
            'No se pudo conectar con Supabase.'
        );
    }

    if ($codigoHttp < 200 || $codigoHttp >= 300) {
        error_log(
            'UTP-Market Supabase HTTP ' .
            $codigoHttp . ': ' .
            substr((string) $respuesta, 0, 1000)
        );

        throw new RuntimeException(
            'Supabase respondió con HTTP ' . $codigoHttp . '.'
        );
    }

    $datos = json_decode($respuesta, true);

    if (
        !is_array($datos) ||
        json_last_error() !== JSON_ERROR_NONE
    ) {
        throw new RuntimeException(
            'Supabase devolvió una respuesta JSON inválida.'
        );
    }

    return $datos;
};

/* =========================================================
   5. OBTENER LOS DATOS DE LA EMPRESA
   ========================================================= */

try {
    $resultados = $consultarSupabase(
        'empresa',
        [
            'id' => 'eq.' . $idEmpresa,
            'limit' => '1'
        ]
    );

    $empresa = $resultados[0] ?? null;

    if (!is_array($empresa)) {
        http_response_code(404);
        exit('No se encontró la empresa solicitada.');
    }

} catch (Throwable $e) {
    error_log(
        'UTP-Market empresa: ' . $e->getMessage()
    );

    http_response_code(500);

    exit(
        'No se pudo cargar la empresa. ' .
        'Revisa la conexión con Supabase y los permisos de la API.'
    );
}

/* =========================================================
   6. FUNCIONES AUXILIARES
   ========================================================= */

$escapar = static function ($valor): string {
    if (!is_scalar($valor) || $valor === null) {
        $valor = '';
    }

    return htmlspecialchars(
        (string) $valor,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
};

$obtener = static function (
    string $columna,
    string $predeterminado = ''
) use (&$empresa): string {

    $valor = $empresa[$columna] ?? $predeterminado;

    if (!is_scalar($valor)) {
        return $predeterminado;
    }

    return trim((string) $valor);
};

$urlWebValida = static function (string $url): bool {
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }

    $esquema = strtolower(
        (string) parse_url($url, PHP_URL_SCHEME)
    );

    return in_array($esquema, ['http', 'https'], true);
};

$urlImagen = static function (string $url) use ($urlWebValida): string {
    $url = trim($url);

    if ($url === '') {
        return '';
    }

    if ($urlWebValida($url)) {
        return $url;
    }

    // Permitir rutas locales de imágenes.
    if (str_starts_with($url, '/') && !str_starts_with($url, '//')) {
        return $url;
    }

    if (function_exists('asset')) {
        return asset(ltrim($url, '/'));
    }

    return '/' . ltrim($url, '/');
};

/* =========================================================
   7. DATOS DE LA EMPRESA
   Columnas confirmadas en tus capturas
   ========================================================= */

$id = $obtener('id', (string) $idEmpresa);
$nombre = $obtener('nombre', 'Empresa');
$eslogan = $obtener('eslogan');
$descripcion = $obtener('descripcion');

$logo = $obtener('logo_url');
$imagenPortada = $obtener('imagen_url');

$correo = $obtener('correo');
$telefono = $obtener('telefono');
$whatsapp = $obtener('whatsapp');
$direccion = $obtener('direccion');
$facebook = $obtener('facebook');
$instagram = $obtener('instagram');

if ($whatsapp === '') {
    $whatsapp = $telefono;
}

$numeroWhatsapp = preg_replace(
    '/\D+/',
    '',
    $whatsapp
);

$enlaceWhatsapp = $numeroWhatsapp !== ''
    ? 'https://wa.me/' . $numeroWhatsapp
    : '';

$enlaceFacebook = $urlWebValida($facebook)
    ? $facebook
    : '';

$enlaceInstagram = $urlWebValida($instagram)
    ? $instagram
    : '';

$logoUrl = $urlImagen($logo);
$portadaUrl = $urlImagen($imagenPortada);

?>

<style>
.empresa-page {
    --empresa-color: #7d2e35;
    --empresa-fondo: #f7f4f1;
    --empresa-texto: #30271f;
    color: var(--empresa-texto);
    background: #fff;
    font-family: inherit;
}

.empresa-page *,
.empresa-page *::before,
.empresa-page *::after {
    box-sizing: border-box;
}

.empresa-page img {
    max-width: 100%;
}

.empresa-page a {
    text-decoration: none;
}

.empresa-container {
    width: min(1160px, 92%);
    margin: 0 auto;
}

.empresa-hero {
    position: relative;
    display: flex;
    align-items: center;
    min-height: 430px;
    overflow: hidden;
    background: #332c29;
}

.empresa-hero-fondo {
    position: absolute;
    inset: 0;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.empresa-hero-fondo::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(24, 19, 18, .88),
        rgba(24, 19, 18, .52),
        rgba(24, 19, 18, .12)
    );
}

.empresa-hero-contenido {
    position: relative;
    z-index: 1;
    max-width: 760px;
    padding: 65px 0;
    color: #fff;
}

.empresa-logo {
    display: block;
    width: 115px;
    height: 115px;
    margin-bottom: 22px;
    padding: 8px;
    object-fit: contain;
    background: #fff;
    border-radius: 15px;
}

.empresa-etiqueta {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 30px;
    background: #e6c7a8;
    color: #33251d;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.empresa-hero h1 {
    margin: 20px 0 12px;
    font-size: clamp(36px, 5vw, 62px);
    line-height: 1.1;
    overflow-wrap: anywhere;
}

.empresa-hero p {
    font-size: 18px;
    line-height: 1.8;
    overflow-wrap: anywhere;
}

.empresa-botones {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 26px;
}

.empresa-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 13px 20px;
    border: 1px solid var(--empresa-color);
    border-radius: 7px;
    background: var(--empresa-color);
    color: #fff !important;
    font-size: 14px;
    font-weight: 700;
    transition: opacity .2s ease;
}

.empresa-btn:hover {
    opacity: .85;
}

.empresa-btn-secundario {
    border-color: #fff;
    background: transparent;
}

.empresa-seccion {
    padding: 65px 0;
}

.empresa-seccion-fondo {
    background: var(--empresa-fondo);
}

.empresa-titulo {
    margin: 0 0 12px;
    text-align: center;
    font-size: clamp(27px, 3vw, 38px);
}

.empresa-subtitulo {
    max-width: 720px;
    margin: 0 auto 35px;
    color: #77716b;
    line-height: 1.8;
    text-align: center;
}

.empresa-descripcion {
    max-width: 900px;
    margin: auto;
    font-size: 17px;
    line-height: 1.9;
    overflow-wrap: anywhere;
}

.empresa-contacto {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.empresa-contacto-item {
    padding: 22px;
    border: 1px solid #eee7e1;
    border-radius: 10px;
    background: #fff;
    overflow-wrap: anywhere;
}

.empresa-contacto-item h3 {
    margin: 0 0 10px;
    font-size: 17px;
}

.empresa-contacto-item p {
    margin: 0;
    color: #6e6863;
    line-height: 1.8;
}

.empresa-contacto-item a {
    color: var(--empresa-color);
    overflow-wrap: anywhere;
}

.empresa-redes {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
    margin-top: 28px;
}

.empresa-red {
    display: inline-block;
    padding: 11px 18px;
    border: 1px solid #ddd3cb;
    border-radius: 30px;
    color: var(--empresa-color) !important;
    font-weight: 700;
}

.empresa-red:hover {
    background: #f0e4dc;
}

.empresa-vacio {
    grid-column: 1 / -1;
    padding: 25px;
    color: #77716b;
    text-align: center;
}

.empresa-pie {
    padding: 25px 0;
    background: #30271f;
    color: #fff;
    text-align: center;
}

.empresa-pie p {
    margin: 0;
}

@media (max-width: 650px) {
    .empresa-hero {
        min-height: 360px;
    }

    .empresa-hero-contenido {
        padding: 45px 0;
    }

    .empresa-seccion {
        padding: 45px 0;
    }

    .empresa-contacto {
        grid-template-columns: 1fr;
    }

    .empresa-logo {
        width: 90px;
        height: 90px;
    }
}
</style>

<main class="empresa-page">

    <!-- PORTADA -->
    <section class="empresa-hero">

        <div
            class="empresa-hero-fondo"
            <?php if ($portadaUrl !== ''): ?>
                style="background-image:url('<?= $escapar($portadaUrl) ?>')"
            <?php endif; ?>
        ></div>

        <div class="empresa-container">
            <div class="empresa-hero-contenido">

                <?php if ($logoUrl !== ''): ?>
                    <img
                        class="empresa-logo"
                        src="<?= $escapar($logoUrl) ?>"
                        alt="Logo de <?= $escapar($nombre) ?>"
                    >
                <?php endif; ?>

                <span class="empresa-etiqueta">
                    Empresa de UTP-Market
                </span>

                <h1><?= $escapar($nombre) ?></h1>

                <?php if ($eslogan !== ''): ?>
                    <p><?= $escapar($eslogan) ?></p>
                <?php endif; ?>

                <div class="empresa-botones">
                    <a class="empresa-btn" href="#empresa-informacion">
                        Conócenos
                    </a>

                    <?php if ($enlaceWhatsapp !== ''): ?>
                        <a
                            class="empresa-btn empresa-btn-secundario"
                            href="<?= $escapar($enlaceWhatsapp) ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Contactar por WhatsApp
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>

    </section>

    <!-- INFORMACIÓN -->
    <section
        class="empresa-seccion"
        id="empresa-informacion"
    >
        <div class="empresa-container">

            <h2 class="empresa-titulo">
                Conoce <?= $escapar($nombre) ?>
            </h2>

            <p class="empresa-subtitulo">
                Conoce más acerca de nuestra empresa.
            </p>

            <div class="empresa-descripcion">
                <?php if ($descripcion !== ''): ?>
                    <?= nl2br($escapar($descripcion)) ?>
                <?php else: ?>
                    Estamos preparando más información sobre nuestra empresa.
                <?php endif; ?>
            </div>

        </div>
    </section>

    <!-- CONTACTO -->
    <section
        class="empresa-seccion empresa-seccion-fondo"
        id="empresa-contacto"
    >
        <div class="empresa-container">

            <h2 class="empresa-titulo">
                Contacta con nosotros
            </h2>

            <p class="empresa-subtitulo">
                Comunícate con <?= $escapar($nombre) ?>.
            </p>

            <div class="empresa-contacto">

                <?php if ($telefono !== ''): ?>
                    <article class="empresa-contacto-item">
                        <h3>Teléfono</h3>
                        <p>
                            <a href="tel:<?= $escapar(
                                preg_replace('/[^\d+]/', '', $telefono)
                            ) ?>">
                                <?= $escapar($telefono) ?>
                            </a>
                        </p>
                    </article>
                <?php endif; ?>

                <?php if (
                    $correo !== '' &&
                    filter_var($correo, FILTER_VALIDATE_EMAIL)
                ): ?>
                    <article class="empresa-contacto-item">
                        <h3>Correo electrónico</h3>
                        <p>
                            <a href="mailto:<?= $escapar($correo) ?>">
                                <?= $escapar($correo) ?>
                            </a>
                        </p>
                    </article>
                <?php endif; ?>

                <?php if ($direccion !== ''): ?>
                    <article class="empresa-contacto-item">
                        <h3>Dirección</h3>
                        <p><?= nl2br($escapar($direccion)) ?></p>
                    </article>
                <?php endif; ?>

                <?php if ($whatsapp !== ''): ?>
                    <article class="empresa-contacto-item">
                        <h3>WhatsApp</h3>
                        <p>
                            <?php if ($enlaceWhatsapp !== ''): ?>
                                <a
                                    href="<?= $escapar($enlaceWhatsapp) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    Enviar mensaje
                                </a>
                            <?php else: ?>
                                <?= $escapar($whatsapp) ?>
                            <?php endif; ?>
                        </p>
                    </article>
                <?php endif; ?>

                <?php
                $hayContacto = (
                    $telefono !== '' ||
                    (
                        $correo !== '' &&
                        filter_var($correo, FILTER_VALIDATE_EMAIL)
                    ) ||
                    $direccion !== '' ||
                    $whatsapp !== ''
                );
                ?>

                <?php if (!$hayContacto): ?>
                    <div class="empresa-vacio">
                        Los datos de contacto aún no están disponibles.
                    </div>
                <?php endif; ?>

            </div>

            <!-- REDES SOCIALES -->
            <?php
            $redes = [];

            if ($enlaceFacebook !== '') {
                $redes[] = [
                    'nombre' => 'Facebook',
                    'url' => $enlaceFacebook
                ];
            }

            if ($enlaceInstagram !== '') {
                $redes[] = [
                    'nombre' => 'Instagram',
                    'url' => $enlaceInstagram
                ];
            }
            ?>

            <?php if ($redes !== []): ?>
                <div class="empresa-redes">
                    <?php foreach ($redes as $red): ?>
                        <a
                            class="empresa-red"
                            href="<?= $escapar($red['url']) ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <?= $escapar($red['nombre']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- PIE DE PÁGINA -->
    <footer class="empresa-pie">
        <div class="empresa-container">
            <p>
                <?= $escapar($nombre) ?> · UTP-Market
            </p>
        </div>
    </footer>

</main>
 