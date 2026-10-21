<?php
/*
 * Rutas de imágenes: déjalas vacías ('') para mostrar el recuadro de ejemplo.
 * Cuando tengas la foto, escribe la ruta, ej: 'images/grabado/paso-1.jpg'
 */

$imagenPrincipal = ''; // Imagen grande de portada (foto del láser grabando)



$productosMadera = [
    [
        'nombre'      => 'Letreros personalizados',
        'descripcion' => 'Letreros de madera con nombres, frases o logotipos para tu negocio y eventos.',
        'imagen'      => 'assets/images/grabado/letrero.jpeg',
    ],
    [
        'nombre'      => 'Llaveros grabados',
        'descripcion' => 'Llaveros de madera personalizados con iniciales, nombres o diseños especiales.',
        'imagen'      => 'assets/images/grabado/llaveros.jpeg',
    ],
    [
        'nombre'      => 'Reconocimientos en madera',
        'descripcion' => 'Piezas grabadas para reconocer logros académicos, deportivos o laborales.',
        'imagen'      => 'assets/images/grabado/reconocimiento.jpeg',
    ],
    [
        'nombre'      => 'Recuerdos para eventos',
        'descripcion' => 'Detalles personalizados para cumpleaños, bodas, bautizos y otras celebraciones.',
        'imagen'      => 'assets/images/grabado/recuerdos.jpeg',
    ],
];

$ventajas = [
    ['titulo' => 'Precisión',        'texto' => 'Detalles finos, letras pequeñas y líneas limpias.'],
    ['titulo' => 'Permanente',       'texto' => 'El grabado no se borra ni se despinta con el uso.'],
    ['titulo' => 'Personalizado',    'texto' => 'Cada pieza se hace a tu medida y con tu diseño.'],
    ['titulo' => 'Piezas únicas',    'texto' => 'Ideal para una pieza o para pedidos por volumen.'],
];

// Galería de trabajos terminados (agrega o quita las que necesites)
$galeria = ['', '', '', '', '', ''];

// Helper para mostrar imagen o recuadro de ejemplo
// Acepta URL completa (https://...) o ruta local (images/grabado/foto.jpg)
$mostrarImagen = function (string $ruta, string $alt, string $textoPlaceholder, string $clase = '') {
    if ($ruta !== '') {
        $esUrl = preg_match('#^(https?:)?//#i', $ruta) === 1;
        $src   = $esUrl ? $ruta : asset($ruta);

        echo '<img src="' . htmlspecialchars($src, ENT_QUOTES, 'UTF-8') . '"'
           . ' alt="' . htmlspecialchars($alt, ENT_QUOTES, 'UTF-8') . '"'
           . ' loading="lazy"'
           . ' class="madera-img ' . $clase . '">';
    } else {
        echo '<div class="madera-placeholder ' . $clase . '">'
           . '<span class="madera-placeholder-icono">▣</span>'
           . '<span>' . htmlspecialchars($textoPlaceholder, ENT_QUOTES, 'UTF-8') . '</span>'
           . '</div>';
    }
};
?>

<section class="product footer-padding">
    <div class="container">

        <!-- ENCABEZADO -->
        <a href="<?= url('product-sidebar') ?>" class="madera-volver">← Volver al catálogo</a>

        <div class="row align-items-center g-5 mt-2 mb-5">
            <div class="col-lg-6">
                <span class="madera-etiqueta">Grabado láser</span>
                <h1 class="madera-h1">Grabado en Madera</h1>
                <p class="madera-lead">
                    Personaliza tus piezas de madera con nombres, logotipos, frases
                    y diseños especiales mediante grabado láser. Conoce cómo lo hacemos,
                    paso a paso.
                </p>
            </div>
            <div class="col-lg-6">
                <?php $mostrarImagen($imagenPrincipal, 'Grabado láser en madera', 'Imagen principal: láser grabando madera', 'madera-hero'); ?>
            </div>
        </div>

        <!-- VENTAJAS -->
        <div class="row g-3 mb-5">
            <?php foreach ($ventajas as $v): ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="madera-ventaja">
                        <h4><?= htmlspecialchars($v['titulo'], ENT_QUOTES, 'UTF-8') ?></h4>
                        <p class="mb-0"><?= htmlspecialchars($v['texto'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- PROCESO -->
       

        <!-- GALERÍA -->
        <div class="mb-5">
            <span class="madera-etiqueta">Galería</span>
            <h2 class="madera-h2">Trabajos terminados</h2>

            <div class="row g-3">
                <?php foreach ($galeria as $i => $foto): ?>
                    <div class="col-lg-4 col-sm-6">
                        <?php $mostrarImagen($foto, 'Trabajo de grabado ' . ($i + 1), 'Foto de trabajo ' . ($i + 1), 'madera-galeria-img'); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- PRODUCTOS -->
        <div class="mb-5">
            <span class="madera-etiqueta">Qué puedes grabar</span>
            <h2 class="madera-h2">Productos más solicitados</h2>

            <div class="row g-4">
                <?php foreach ($productosMadera as $producto): ?>
                    <div class="col-lg-3 col-sm-6">
                        <article class="madera-card">
                            <?php $mostrarImagen($producto['imagen'], $producto['nombre'], 'Grabado láser en madera', 'madera-card-img'); ?>
                            <div class="p-4">
                                <h3 class="madera-titulo">
                                    <?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                </h3>
                                <p class="mt-2 mb-0">
                                    <?= htmlspecialchars($producto['descripcion'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- NOTA / CTA -->
        <div class="madera-nota">
            <h3>Un diseño a tu medida</h3>
            <p class="mb-0 mt-2">
                El costo depende del tamaño, el material y la complejidad
                del diseño que deseas grabar. Cuéntanos tu idea y te ayudamos
                a hacerla realidad.
            </p>
        </div>

    </div>
</section>

<style>
    /* Paleta rojo vino */
    :root {
        --vino-principal: #722F37;
        --vino-oscuro:    #4A1520;
        --vino-medio:     #5E2029;
        --vino-suave:     #F6E7E9;
        --vino-fondo:     #FBF1F2;
        --vino-borde:     #E6D0D3;
        --vino-dash:      #D9AEB4;
    }

    .madera-volver {
        color: #666;
        text-decoration: none;
    }

    .madera-volver:hover {
        color: var(--vino-principal);
    }

    .madera-etiqueta {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 999px;
        background: var(--vino-suave);
        color: var(--vino-principal);
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .madera-h1 {
        margin-top: 16px;
        color: var(--vino-oscuro);
        font-size: clamp(32px, 5vw, 46px);
        line-height: 1.15;
    }

    .madera-h2 {
        margin: 12px 0 28px;
        color: var(--vino-oscuro);
        font-size: clamp(24px, 3.5vw, 32px);
    }

    .madera-lead {
        margin-top: 16px;
        color: #626262;
        font-size: 18px;
        line-height: 1.7;
    }

    /* Imágenes y placeholders */
    .madera-img,
    .madera-placeholder {
        width: 100%;
        border-radius: 16px;
    }

    .madera-img {
        display: block;
        object-fit: cover;
    }

    .madera-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 24px;
        border: 2px dashed var(--vino-dash);
        background: var(--vino-suave);
        color: var(--vino-principal);
        font-size: 16px;
        font-weight: 600;
        text-align: center;
    }

    .madera-placeholder-icono {
        font-size: 34px;
        line-height: 1;
        opacity: .6;
    }

    .madera-hero { height: 360px; }
    .madera-paso-img { height: 280px; }
    .madera-galeria-img { height: 240px; }
    .madera-card-img { height: 200px; border-radius: 0; }

    /* Ventajas */
    .madera-ventaja {
        height: 100%;
        padding: 22px;
        border: 1px solid var(--vino-borde);
        border-top: 4px solid var(--vino-principal);
        border-radius: 16px;
        background: #fff;
    }

    .madera-ventaja h4 {
        color: var(--vino-medio);
        font-size: 18px;
    }

    .madera-ventaja p {
        margin-top: 6px;
        color: #626262;
        line-height: 1.6;
    }

    /* Pasos */
    .madera-paso {
        margin-bottom: 40px;
    }

    .madera-numero {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        margin-bottom: 12px;
        border-radius: 50%;
        background: var(--vino-principal);
        color: #fff;
        font-size: 20px;
        font-weight: 700;
    }

    .madera-paso-titulo {
        margin-bottom: 10px;
        color: var(--vino-medio);
        font-size: 24px;
    }

    .madera-paso p {
        color: #626262;
        font-size: 17px;
        line-height: 1.7;
    }

    /* Tarjetas de producto */
    .madera-card {
        height: 100%;
        overflow: hidden;
        border: 1px solid var(--vino-borde);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 5px 18px rgba(114, 47, 55, 0.08);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .madera-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 26px rgba(114, 47, 55, 0.18);
    }

    .madera-titulo {
        color: var(--vino-medio);
        font-size: 20px;
    }

    .madera-card p {
        color: #626262;
        line-height: 1.7;
    }

    /* Nota final */
    .madera-nota {
        padding: 32px;
        border-left: 6px solid var(--vino-principal);
        border-radius: 16px;
        background: var(--vino-fondo);
    }

    .madera-nota h3 {
        color: var(--vino-medio);
    }

    .madera-nota p {
        color: #626262;
        line-height: 1.7;
    }

    @media (max-width: 991px) {
        .madera-hero { height: 260px; }
        .madera-paso-img { height: 220px; }
    }
</style>