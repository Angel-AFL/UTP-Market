
<?php
/**
 * VISTA DINÁMICA DE EMPRESAS - UTP MARKET
 * URL: /empresa?id=1
 *
 * La conexión se obtiene de config/database.php.
 * La consulta utiliza el ID de la URL.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* =========================================================
   1. CONEXIÓN Y CONSULTA DE LA EMPRESA
   ========================================================= */

try {
    // Esta ruta supone que config/database.php está en la raíz.
    $conexion = require __DIR__ . '/../config/database.php';

    if (!$conexion instanceof PDO) {
        throw new RuntimeException(
            'database.php debe devolver una instancia de PDO.'
        );
    }

    $idEmpresa = filter_input(
        INPUT_GET,
        'id',
        FILTER_VALIDATE_INT
    );

    if (!$idEmpresa || $idEmpresa < 1) {
        http_response_code(400);
        exit('El ID de la empresa no es válido.');
    }

    $consulta = $conexion->prepare(
        'SELECT * FROM empresa
         WHERE id = :id AND estado = 1
         LIMIT 1'
    );

    $consulta->execute(['id' => $idEmpresa]);
    $empresa = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$empresa) {
        http_response_code(404);
        exit('No se encontró la empresa solicitada.');
    }

} catch (Throwable $error) {
    error_log('Error al cargar empresa: ' . $error->getMessage());
    http_response_code(500);
    exit('No se pudo cargar la empresa. Verifica la conexión y la estructura de la base de datos.');
}

/* =========================================================
   2. FUNCIONES AUXILIARES
   ========================================================= */

$escapar = static function ($valor): string {
    return htmlspecialchars(
        (string) ($valor ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
};

$obtener = static function (
    string $columna,
    string $predeterminado = ''
) use (&$empresa): string {
    return trim((string) (
        $empresa[$columna] ?? $predeterminado
    ));
};

$nombre = $obtener('nombre', 'Empresa');
$eslogan = $obtener('eslogan', 'Bienvenido a nuestra empresa');
$descripcion = $obtener(
    'descripcion',
    'Conoce nuestros productos y servicios.'
);

$logo = $obtener('logo');
$portada = $obtener('portada');
$textoBoton = $obtener('texto_boton', 'Conoce nuestros servicios');

$telefono = $obtener('telefono');
$correo = $obtener('correo');
$direccion = $obtener('direccion');
$sitioWeb = $obtener('sitio_web');

$slug = $obtener('slug');

if ($slug === '') {
    $slug = strtolower(trim(
        preg_replace('/[^a-zA-Z0-9]+/', '-', $nombre),
        '-'
    ));
}

/*
 * Si posteriormente agregas columnas JSON llamadas servicios,
 * galeria, redes_sociales o preguntas_frecuentes, esta vista
 * podrá leerlas sin tener que escribir los datos manualmente.
 */
$leerJson = static function ($valor): array {
    if (is_array($valor)) {
        return $valor;
    }

    if (!is_string($valor) || trim($valor) === '') {
        return [];
    }

    $datos = json_decode($valor, true);

    return is_array($datos) ? $datos : [];
};

$servicios = $leerJson($empresa['servicios'] ?? []);
$galeria = $leerJson($empresa['galeria'] ?? []);
$redes = $leerJson($empresa['redes_sociales'] ?? []);
$preguntas = $leerJson(
    $empresa['preguntas_frecuentes'] ?? []
);

$caracteristicas = $leerJson(
    $empresa['caracteristicas'] ?? []
);

$whatsapp = preg_replace('/\D+/', '', $telefono);

$enlaceWhatsapp = $whatsapp !== ''
    ? 'https://wa.me/' . $whatsapp
    : '';

$esUrlSegura = static function (string $url): bool {
    return (bool) preg_match('~^https?://~i', $url);
};

$urlImagen = static function (string $ruta): string {
    $ruta = trim($ruta);

    if ($ruta === '') {
        return '';
    }

    if (preg_match('~^https?://~i', $ruta)) {
        return $ruta;
    }

    return function_exists('asset')
        ? asset(ltrim($ruta, '/'))
        : '/' . ltrim($ruta, '/');
};

/* =========================================================
   3. ESTILOS DE LA PÁGINA
   ========================================================= */
?>

<style>
    .empresa-page {
        --empresa-color: <?= $escapar($obtener('color_principal', '#7d3037')) ?>;
        --empresa-acento: <?= $escapar($obtener('color_secundario', '#ffb82e')) ?>;
        --empresa-texto: #30271f;
        --empresa-fondo: #fff;
        color: var(--empresa-texto);
        background: var(--empresa-fondo);
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
        width: min(1200px, 92%);
        margin-inline: auto;
    }

    .empresa-hero {
        position: relative;
        display: flex;
        align-items: center;
        min-height: 390px;
        overflow: hidden;
        background: #f6f1ed;
    }

    .empresa-hero-fondo {
        position: absolute;
        inset: 0;
        background-position: center;
        background-size: cover;
    }

    .empresa-hero-fondo::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            90deg,
            rgba(28, 20, 17, .83),
            rgba(28, 20, 17, .25)
        );
    }

    .empresa-hero-contenido {
        position: relative;
        z-index: 1;
        width: min(760px, 92%);
        padding: 65px 0;
        color: #fff;
    }

    .empresa-etiqueta {
        display: inline-block;
        padding: 8px 14px;
        border-radius: 30px;
        background: var(--empresa-acento);
        color: #211b14;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .empresa-hero h1 {
        margin: 20px 0 12px;
        font-size: clamp(34px, 5vw, 64px);
        line-height: 1.08;
        overflow-wrap: anywhere;
    }

    .empresa-hero p {
        font-size: 18px;
        line-height: 1.8;
    }

    .empresa-botones {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 25px;
    }

    .empresa-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 13px 21px;
        border: 2px solid var(--empresa-color);
        border-radius: 6px;
        background: var(--empresa-color);
        color: white !important;
        font-weight: 700;
        transition: .2s ease;
    }

    .empresa-btn:hover {
        opacity: .88;
        transform: translateY(-2px);
    }

    .empresa-btn-secundario {
        border-color: rgba(255,255,255,.8);
        background: transparent;
    }

    .empresa-logo-contenedor {
        margin-bottom: 20px;
    }

    .empresa-logo {
        width: 125px;
        height: 100px;
        object-fit: contain;
        padding: 10px;
        border-radius: 10px;
        background: #fff;
    }

    .empresa-seccion {
        padding: 65px 0;
    }

    .empresa-seccion:nth-of-type(even) {
        background: #faf8f6;
    }

    .empresa-titulo {
        margin: 0 0 12px;
        font-size: clamp(26px, 3vw, 38px);
        text-align: center;
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
        margin: 0 auto;
        font-size: 17px;
        line-height: 1.9;
        white-space: normal;
        overflow-wrap: anywhere;
    }

    .empresa-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
    }

    .empresa-tarjeta {
        overflow: hidden;
        border: 1px solid #eee7e1;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(0,0,0,.035);
    }

    .empresa-tarjeta-imagen {
        display: block;
        width: 100%;
        height: 220px;
        object-fit: cover;
        background: #f0ece8;
    }

    .empresa-tarjeta-contenido {
        padding: 22px;
    }

    .empresa-tarjeta h3 {
        margin: 0 0 10px;
        font-size: 20px;
    }

    .empresa-tarjeta p {
        color: #77716b;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .empresa-galeria {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 15px;
    }

    .empresa-galeria img {
        display: block;
        width: 100%;
        height: 240px;
        border-radius: 10px;
        object-fit: cover;
        background: #eee;
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
        line-height: 1.7;
    }

    .empresa-contacto-item a {
        color: var(--empresa-color);
        overflow-wrap: anywhere;
    }

    .empresa-pregunta {
        max-width: 850px;
        margin: 12px auto;
        padding: 20px;
        border: 1px solid #eee7e1;
        border-radius: 8px;
        background: white;
    }

    .empresa-pregunta h3 {
        margin: 0 0 10px;
        font-size: 17px;
    }

    .empresa-pregunta p {
        margin: 0;
        color: #6e6863;
        line-height: 1.7;
    }

    .empresa-redes {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-top: 25px;
    }

    .empresa-red {
        padding: 10px 17px;
        border: 1px solid #ddd;
        border-radius: 25px;
        color: var(--empresa-color) !important;
        font-weight: 700;
    }

    .empresa-vacio {
        grid-column: 1 / -1;
        padding: 25px;
        color: #777;
        text-align: center;
    }

    @media (max-width: 800px) {
        .empresa-grid,
        .empresa-galeria {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .empresa-hero {
            min-height: 330px;
        }
    }

    @media (max-width: 560px) {
        .empresa-grid,
        .empresa-galeria,
        .empresa-contacto {
            grid-template-columns: 1fr;
        }

        .empresa-hero {
            min-height: 300px;
        }

        .empresa-hero-contenido {
            padding: 45px 0;
        }

        .empresa-seccion {
            padding: 42px 0;
        }

        .empresa-galeria img {
            height: 230px;
        }
    }
</style>

<main class="empresa-page">

    <!-- =====================================================
         PORTADA DE LA EMPRESA
         ===================================================== -->

    <section class="empresa-hero">

        <?php if ($portada !== ''): ?>
            <div
                class="empresa-hero-fondo"
                style="background-image: url('<?= $escapar($urlImagen($portada)) ?>')"
            ></div>
        <?php else: ?>
            <div class="empresa-hero-fondo"></div>
        <?php endif; ?>

        <div class="empresa-container">
            <div class="empresa-hero-contenido">

                <?php if ($logo !== ''): ?>
                    <div class="empresa-logo-contenedor">
                        <img
                            class="empresa-logo"
                            src="<?= $escapar($urlImagen($logo)) ?>"
                            alt="Logo de <?= $escapar($nombre) ?>"
                        >
                    </div>
                <?php endif; ?>

                <span class="empresa-etiqueta">
                    Empresa de UTP-Market
                </span>

                <h1><?= $escapar($nombre) ?></h1>

                <?php if ($eslogan !== ''): ?>
                    <p><?= $escapar($eslogan) ?></p>
                <?php endif; ?>

                <div class="empresa-botones">

                    <a
                        class="empresa-btn"
                        href="#empresa-servicios"
                    >
                        <?= $escapar($textoBoton) ?>
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

    <!-- =====================================================
         INFORMACIÓN DE LA EMPRESA
         ===================================================== -->

    <section class="empresa-seccion" id="empresa-nosotros">
        <div class="empresa-container">

            <h2 class="empresa-titulo">
                Conoce <?= $escapar($nombre) ?>
            </h2>

            <p class="empresa-subtitulo">
                Descubre quiénes somos y qué ofrecemos.
            </p>

            <div class="empresa-descripcion">
                <?= nl2br($escapar($descripcion)) ?>
            </div>

            <?php if (!empty($caracteristicas)): ?>
                <div class="empresa-grid" style="margin-top:35px">

                    <?php foreach ($caracteristicas as $caracteristica): ?>
                        <?php
                        if (!is_array($caracteristica)) {
                            continue;
                        }

                        $tituloCaracteristica =
                            $caracteristica['titulo']
                            ?? $caracteristica['nombre']
                            ?? '';

                        $textoCaracteristica =
                            $caracteristica['descripcion']
                            ?? $caracteristica['texto']
                            ?? '';

                        if ($tituloCaracteristica === '') {
                            continue;
                        }
                        ?>

                        <article class="empresa-tarjeta">
                            <div class="empresa-tarjeta-contenido">
                                <h3>
                                    <?= $escapar($tituloCaracteristica) ?>
                                </h3>
                                <p>
                                    <?= $escapar($textoCaracteristica) ?>
                                </p>
                            </div>
                        </article>

                    <?php endforeach; ?>

                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- =====================================================
         SERVICIOS
         ===================================================== -->

    <section
        class="empresa-seccion"
        id="empresa-servicios"
    >
        <div class="empresa-container">

            <h2 class="empresa-titulo">
                Nuestros servicios
            </h2>

            <p class="empresa-subtitulo">
                Conoce los servicios disponibles de
                <?= $escapar($nombre) ?>.
            </p>

            <div class="empresa-grid">

                <?php if (empty($servicios)): ?>

                    <div class="empresa-vacio">
                        Próximamente encontrarás aquí los servicios
                        de esta empresa.
                    </div>

                <?php else: ?>

                    <?php foreach ($servicios as $servicio): ?>
                        <?php
                        if (!is_array($servicio)) {
                            continue;
                        }

                        $tituloServicio =
                            $servicio['nombre']
                            ?? $servicio['titulo']
                            ?? '';

                        $descripcionServicio =
                            $servicio['descripcion']
                            ?? '';

                        $imagenServicio =
                            $servicio['imagen']
                            ?? '';

                        $precioServicio =
                            $servicio['precio']
                            ?? '';

                        if ($tituloServicio === '') {
                            continue;
                        }
                        ?>

                        <article class="empresa-tarjeta">

                            <?php if ($imagenServicio !== ''): ?>
                                <img
                                    class="empresa-tarjeta-imagen"
                                    src="<?= $escapar($urlImagen($imagenServicio)) ?>"
                                    alt="<?= $escapar($tituloServicio) ?>"
                                    loading="lazy"
                                >
                            <?php endif; ?>

                            <div class="empresa-tarjeta-contenido">

                                <h3>
                                    <?= $escapar($tituloServicio) ?>
                                </h3>

                                <p>
                                    <?= $escapar($descripcionServicio) ?>
                                </p>

                                <?php if ($precioServicio !== ''): ?>
                                    <p>
                                        <strong>Precio:</strong>
                                        <?= $escapar($precioServicio) ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($enlaceWhatsapp !== ''): ?>
                                    <a
                                        class="empresa-btn"
                                        href="<?= $escapar($enlaceWhatsapp) ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        Solicitar información
                                    </a>
                                <?php endif; ?>

                            </div>
                        </article>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- =====================================================
         GALERÍA
         ===================================================== -->

    <section class="empresa-seccion" id="empresa-galeria">
        <div class="empresa-container">

            <h2 class="empresa-titulo">
                Galería
            </h2>

            <p class="empresa-subtitulo">
                Conoce algunos de nuestros trabajos y productos.
            </p>

            <div class="empresa-galeria">

                <?php
                $imagenesValidas = 0;

                foreach ($galeria as $imagen):
                    if (is_string($imagen)) {
                        $rutaGaleria = $imagen;
                        $textoGaleria = $nombre;
                    } elseif (is_array($imagen)) {
                        $rutaGaleria =
                            $imagen['imagen']
                            ?? $imagen['ruta']
                            ?? '';

                        $textoGaleria =
                            $imagen['titulo']
                            ?? $nombre;
                    } else {
                        continue;
                    }

                    if ($rutaGaleria === '') {
                        continue;
                    }

                    $imagenesValidas++;
                ?>

                    <img
                        src="<?= $escapar($urlImagen($rutaGaleria)) ?>"
                        alt="<?= $escapar($textoGaleria) ?>"
                        loading="lazy"
                    >

                <?php endforeach; ?>

                <?php if ($imagenesValidas === 0): ?>
                    <div class="empresa-vacio">
                        Próximamente se mostrarán las imágenes
                        de esta empresa.
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- =====================================================
         CONTACTO
         ===================================================== -->

    <section class="empresa-seccion" id="empresa-contacto">
        <div class="empresa-container">

            <h2 class="empresa-titulo">
                Contacta con nosotros
            </h2>

            <p class="empresa-subtitulo">
                ¿Tienes alguna duda? Ponte en contacto con
                <?= $escapar($nombre) ?>.
            </p>

            <div class="empresa-contacto">

                <?php if ($telefono !== ''): ?>
                    <div class="empresa-contacto-item">
                        <h3>Teléfono</h3>
                        <p><?= $escapar($telefono) ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($correo !== ''): ?>
                    <div class="empresa-contacto-item">
                        <h3>Correo electrónico</h3>
                        <p>
                            <a href="mailto:<?= $escapar($correo) ?>">
                                <?= $escapar($correo) ?>
                            </a>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if ($direccion !== ''): ?>
                    <div class="empresa-contacto-item">
                        <h3>Dirección</h3>
                        <p><?= nl2br($escapar($direccion)) ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($sitioWeb !== '' && $esUrlSegura($sitioWeb)): ?>
                    <div class="empresa-contacto-item">
                        <h3>Sitio web</h3>
                        <p>
                            <a
                                href="<?= $escapar($sitioWeb) ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                Visitar sitio web
                            </a>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if (
                    $telefono === ''
                    && $correo === ''
                    && $direccion === ''
                    && $sitioWeb === ''
                ): ?>
                    <div class="empresa-vacio">
                        Los datos de contacto de esta empresa
                        todavía no están disponibles.
                    </div>
                <?php endif; ?>

            </div>

            <?php if (!empty($redes)): ?>

                <div class="empresa-redes">

                    <?php foreach ($redes as $red): ?>
                        <?php
                        if (!is_array($red)) {
                            continue;
                        }

                        $nombreRed = $red['nombre'] ?? '';
                        $urlRed = $red['url'] ?? '';

                        if (
                            $nombreRed === ''
                            || !$esUrlSegura($urlRed)
                        ) {
                            continue;
                        }
                        ?>

                        <a
                            class="empresa-red"
                            href="<?= $escapar($urlRed) ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <?= $escapar($nombreRed) ?>
                        </a>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

            <?php if (!empty($preguntas)): ?>

                <div style="margin-top:55px">

                    <h2 class="empresa-titulo">
                        Preguntas frecuentes
                    </h2>

                    <?php foreach ($preguntas as $pregunta): ?>
                        <?php
                        if (!is_array($pregunta)) {
                            continue;
                        }

                        $textoPregunta =
                            $pregunta['pregunta']
                            ?? $pregunta['titulo']
                            ?? '';

                        $respuestaPregunta =
                            $pregunta['respuesta']
                            ?? $pregunta['descripcion']
                            ?? '';

                        if ($textoPregunta === '') {
                            continue;
                        }
                        ?>

                        <article class="empresa-pregunta">
                            <h3>
                                <?= $escapar($textoPregunta) ?>
                            </h3>

                            <p>
                                <?= nl2br($escapar($respuestaPregunta)) ?>
                            </p>
                        </article>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>
    </section>

    <!-- =====================================================
         IDENTIFICACIÓN DE LA EMPRESA
         ===================================================== -->

    <footer style="padding:25px 0;background:#30271f;color:#fff">
        <div class="empresa-container" style="text-align:center">
            <p>
                <?= $escapar($nombre) ?>
                · UTP-Market
            </p>
        </div>
    </footer>

</main>
