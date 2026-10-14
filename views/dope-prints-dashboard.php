<?php
/**
 * DOPE PRINTS
 * Apartado empresarial de UTP-Market.
 *
 * Esta vista no incluye la cabecera ni el menú principal
 * porque deben conservarse desde la plantilla de UTP-Market.
 */

if (!function_exists('dp_escape')) {
    function dp_escape($valor)
    {
        return htmlspecialchars(
            (string) $valor,
            ENT_QUOTES,
            'UTF-8'
        );
    }
}

$productos = [
    [
        'nombre' => 'Playeras personalizadas',
        'categoria' => 'PLAYERAS',
        'icono' => '👕',
        'descripcion' => 'Playeras personalizadas con diseños originales y estampado DTF.'
    ],
    [
        'nombre' => 'Sudaderas personalizadas',
        'categoria' => 'SUDADERAS',
        'icono' => '🧥',
        'descripcion' => 'Sudaderas con diseños personalizados para expresar tu estilo.'
    ],
    [
        'nombre' => 'Tazas personalizadas',
        'categoria' => 'TAZAS',
        'icono' => '☕',
        'descripcion' => 'Tazas personalizadas con imágenes, nombres y diseños.'
    ],
    [
        'nombre' => 'Termos personalizados',
        'categoria' => 'TERMOS',
        'icono' => '🥤',
        'descripcion' => 'Termos personalizados para regalar o utilizar diariamente.'
    ],
    [
        'nombre' => 'Estampado DTF',
        'categoria' => 'ESTAMPADO DTF',
        'icono' => '🎨',
        'descripcion' => 'Personalización de prendas mediante estampado térmico DTF.'
    ],
    [
        'nombre' => 'DTF UV',
        'categoria' => 'DTF UV',
        'icono' => '✨',
        'descripcion' => 'Diseños adhesivos para personalizar superficies compatibles.'
    ],
];

$servicios = [
    [
        'numero' => '01',
        'titulo' => 'Diseños personalizados',
        'descripcion' => 'Personaliza tus productos con diseños originales y creativos.'
    ],
    [
        'numero' => '02',
        'titulo' => 'Estampado DTF',
        'descripcion' => 'Aplicación de diseños mediante planchado térmico en prendas compatibles.'
    ],
    [
        'numero' => '03',
        'titulo' => 'Personalización de productos',
        'descripcion' => 'Opciones de personalización para distintos productos y ocasiones.'
    ],
];
?>

<style>
    .dope-page {
        --dp-vino: #7b2e34;
        --dp-vino-oscuro: #652329;
        --dp-amarillo: #ffbf35;
        --dp-fondo: #f8f6f4;
        --dp-texto: #34271f;
        --dp-gris: #77716d;
        --dp-borde: #eee7e2;

        width: 100%;
        padding: 28px 20px 55px;
        background: var(--dp-fondo);
        color: var(--dp-texto);
        font-family: inherit;
    }

    .dope-page *,
    .dope-page *::before,
    .dope-page *::after {
        box-sizing: border-box;
    }

    .dope-container {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    .dope-breadcrumb {
        margin-bottom: 25px;
        color: var(--dp-gris);
        font-size: 13px;
    }

    .dope-breadcrumb a:hover {
        color: var(--dp-vino);
    }

    .dope-breadcrumb a {
        color: inherit;
        text-decoration: none;
    }

    .dope-hero {
        display: grid;
        grid-template-columns: 1.4fr .6fr;
        align-items: center;
        gap: 30px;
        padding: 42px;
        margin-bottom: 35px;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--dp-borde);
        border-radius: 12px;
    }

    .dope-eyebrow {
        margin-bottom: 15px;
        color: var(--dp-vino);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .dope-hero h1 {
        margin: 0;
        color: var(--dp-texto);
        font-size: clamp(32px, 4vw, 48px);
        font-weight: 800;
        line-height: 1.13;
        letter-spacing: -1.3px;
    }

    .dope-hero h1 span {
        color: var(--dp-vino);
    }

    .dope-hero p {
        max-width: 600px;
        margin: 18px 0 24px;
        color: var(--dp-gris);
        font-size: 14px;
        line-height: 1.8;
    }

    .dope-button {
        display: inline-block;
        padding: 13px 22px;
        border: 0;
        border-radius: 6px;
        background: var(--dp-amarillo);
        color: #352719 !important;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none !important;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .dope-button:hover {
        background: #f2ae1d;
        transform: translateY(-1px);
    }

    .dope-brand-panel {
        display: flex;
        min-height: 220px;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 25px;
        border-radius: 10px;
        background: var(--dp-vino);
        color: #fff;
        text-align: center;
    }

    .dope-brand-letter {
        color: var(--dp-amarillo);
        font-size: 83px;
        font-weight: 900;
        line-height: 1;
        text-shadow: 4px 4px 0 #542027;
    }

    .dope-brand-panel strong {
        margin-top: 12px;
        font-size: 22px;
        letter-spacing: 2px;
    }

    .dope-brand-panel small {
        margin-top: 8px;
        color: #f0dddd;
        font-size: 10px;
        letter-spacing: 2px;
    }

    .dope-section {
        margin-top: 38px;
    }

    .dope-section-heading {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
    }

    .dope-section-heading h2 {
        margin: 0;
        color: var(--dp-texto);
        font-size: 25px;
        font-weight: 800;
    }

    .dope-section-heading p {
        margin: 8px 0 0;
        color: var(--dp-gris);
        font-size: 13px;
        line-height: 1.6;
    }

    .dope-products-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .dope-product-card {
        overflow: hidden;
        border: 1px solid var(--dp-borde);
        border-radius: 9px;
        background: #fff;
        transition: transform .2s, box-shadow .2s;
    }

    .dope-product-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px #3d21100d;
    }

    .dope-product-image {
        display: flex;
        height: 155px;
        align-items: center;
        justify-content: center;
        background: #f1e9e5;
        font-size: 64px;
    }

    .dope-product-content {
        padding: 21px;
    }

    .dope-tag {
        display: inline-block;
        padding: 6px 9px;
        border-radius: 4px;
        background: #f7eddf;
        color: var(--dp-vino);
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .8px;
    }

    .dope-product-content h3 {
        margin: 14px 0 9px;
        color: var(--dp-texto);
        font-size: 17px;
    }

    .dope-product-content p {
        min-height: 60px;
        margin: 0 0 18px;
        color: var(--dp-gris);
        font-size: 12px;
        line-height: 1.8;
    }

    .dope-product-link {
        display: block;
        padding: 12px;
        border-radius: 5px;
        background: var(--dp-vino);
        color: #fff !important;
        text-align: center;
        text-decoration: none !important;
        font-size: 12px;
        font-weight: 700;
    }

    .dope-product-link:hover {
        background: var(--dp-vino-oscuro);
    }

    .dope-services-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .dope-service-card {
        padding: 23px;
        border: 1px solid var(--dp-borde);
        border-radius: 9px;
        background: #fff;
    }

    .dope-service-number {
        display: inline-flex;
        width: 39px;
        height: 39px;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: var(--dp-amarillo);
        color: var(--dp-texto);
        font-weight: 800;
    }

    .dope-service-card h3 {
        margin: 17px 0 9px;
        font-size: 15px;
    }

    .dope-service-card p {
        margin: 0;
        color: var(--dp-gris);
        font-size: 12px;
        line-height: 1.8;
    }

    .dope-contact {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 22px;
        margin-top: 38px;
        padding: 30px;
        border-radius: 9px;
        background: var(--dp-vino);
        color: #fff;
    }

    .dope-contact h2 {
        margin: 0;
        font-size: 22px;
    }

    .dope-contact p {
        margin: 9px 0 0;
        color: #f0dddd;
        font-size: 13px;
        line-height: 1.7;
    }

    @media (max-width: 850px) {
        .dope-hero {
            grid-template-columns: 1fr;
            padding: 28px;
        }

        .dope-brand-panel {
            min-height: 170px;
        }

        .dope-products-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dope-services-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 520px) {
        .dope-page {
            padding: 22px 12px 40px;
        }

        .dope-hero {
            padding: 22px;
        }

        .dope-products-grid {
            grid-template-columns: 1fr;
        }

        .dope-contact {
            align-items: flex-start;
            flex-direction: column;
            padding: 23px;
        }

        .dope-section-heading h2 {
            font-size: 22px;
        }
    }
</style>

<div class="dope-page">
    <div class="dope-container">

        <div class="dope-breadcrumb">
            <a href="<?= dp_escape(function_exists('url') ? url('home') : '/') ?>">
                Inicio
            </a>
            / <strong>DOPE PRINTS</strong>
        </div>

        <section class="dope-hero">
            <div>
                <div class="dope-eyebrow">
                    CREATIVIDAD · ESTILO · PERSONALIZACIÓN
                </div>

                <h1>
                    Tu estilo.<br>
                    Tus ideas.<br>
                    <span>DOPE PRINTS.</span>
                </h1>

                <p>
                    Descubre nuestros productos personalizados, diseños
                    originales y servicios de estampado. Convierte tus ideas
                    en productos que reflejen tu estilo.
                </p>

                <a href="#dope-productos" class="dope-button">
                    Explorar catálogo →
                </a>
            </div>

            <div class="dope-brand-panel">
                <div class="dope-brand-letter">D</div>
                <strong>DOPE PRINTS</strong>
                <small>MAKE IT YOURS</small>
            </div>
        </section>

        <section id="dope-productos" class="dope-section">
            <div class="dope-section-heading">
                <div>
                    <h2>Nuestros productos</h2>
                    <p>
                        Conoce las categorías que forman parte de DOPE PRINTS.
                    </p>
                </div>
            </div>

            <div class="dope-products-grid">
                <?php foreach ($productos as $producto): ?>
                    <article class="dope-product-card">
                        <div class="dope-product-image" aria-hidden="true">
                            <?= $producto['icono'] ?>
                        </div>

                        <div class="dope-product-content">
                            <span class="dope-tag">
                                <?= dp_escape($producto['categoria']) ?>
                            </span>

                            <h3><?= dp_escape($producto['nombre']) ?></h3>

                            <p><?= dp_escape($producto['descripcion']) ?></p>

                            <a
                                class="dope-product-link"
                                href="<?= dp_escape(
                                    function_exists('url')
                                        ? url('product-sidebar')
                                        : '/product-sidebar'
                                ) ?>"
                            >
                                Consultar catálogo →
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="dope-servicios" class="dope-section">
            <div class="dope-section-heading">
                <div>
                    <h2>Nuestros servicios</h2>
                    <p>
                        Opciones de personalización para expresar tu estilo.
                    </p>
                </div>
            </div>

            <div class="dope-services-grid">
                <?php foreach ($servicios as $servicio): ?>
                    <article class="dope-service-card">
                        <span class="dope-service-number">
                            <?= dp_escape($servicio['numero']) ?>
                        </span>

                        <h3><?= dp_escape($servicio['titulo']) ?></h3>

                        <p><?= dp_escape($servicio['descripcion']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="dope-contact">
            <div>
                <h2>Haz realidad tu diseño</h2>
                <p>
                    Explora el catálogo de UTP-Market y encuentra productos
                    para personalizar.
                </p>
            </div>

            <a
                class="dope-button"
                href="<?= dp_escape(
                    function_exists('url')
                        ? url('product-sidebar')
                        : '/product-sidebar'
                ) ?>"
            >
                Ir al catálogo →
            </a>
        </section>

    </div>
</div>
```