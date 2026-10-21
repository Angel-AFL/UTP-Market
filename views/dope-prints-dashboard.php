<?php

if (!function_exists('dp_escape')) {
    function dp_escape($valor)
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }
}

/*
 * Ruta de las imágenes. Ajusta $dp_img si guardas la carpeta en otro lugar
 * (por ejemplo: asset('img/dope-prints/') si tu proyecto tiene helper asset()).
 */
$dp_img = 'assets/img/products/';

$servicios = [
    ['numero' => '01', 'titulo' => 'Diseños personalizados', 'descripcion' => 'Personaliza tus productos con diseños originales y creativos.'],
    ['numero' => '02', 'titulo' => 'Estampado DTF', 'descripcion' => 'Aplicación de diseños mediante planchado térmico en prendas compatibles.'],
    ['numero' => '03', 'titulo' => 'Personalización de productos', 'descripcion' => 'Opciones de personalización para distintos productos y ocasiones.'],
];

/* Galería de trabajos: imagen, etiqueta, título y descripción */
$galeria = [
    [
        'imagen' => 'stand-dope-prints.png',
        'etiqueta' => 'CONÓCENOS',
        'titulo' => 'DOPE PRINTS en feria universitaria',
        'descripcion' => 'Nuestro stand "Tu estilo, nuestra impresión": muestras de termos, tazas, stickers y tarjetas, con código QR para seguirnos en redes sociales.',
    ],
    [
        'imagen' => 'playeras-gaming-utp-2026.png',
        'etiqueta' => 'PLAYERAS · DTF',
        'titulo' => 'Playeras Gaming UTP 2026',
        'descripcion' => 'Diseño a todo color con temática gamer y el lema "Game Over", estampado en playeras negras con técnica DTF. Colores vivos y gran nivel de detalle.',
    ],
    [
        'imagen' => 'tazas-dia-del-maestro.png',
        'etiqueta' => 'TAZAS · SUBLIMACIÓN',
        'titulo' => 'Tazas "Feliz Día del Maestro"',
        'descripcion' => 'Tazas blancas personalizadas con el logo de la Universidad Tecnológica del Poniente y un mensaje de agradecimiento para los docentes. Ideales para regalos institucionales.',
    ],
    [
        'imagen' => 'termo-rojo-graffiti.png',
        'etiqueta' => 'TERMOS',
        'titulo' => 'Termo con diseño estilo graffiti',
        'descripcion' => 'Termo rojo de acero con un diseño de letras graffiti en tonos naranja y amarillo. Un detalle único para uso diario o para regalar.',
    ],
    [
        'imagen' => 'mesa-productos.png',
        'etiqueta' => 'PRODUCTOS',
        'titulo' => 'Variedad de productos personalizados',
        'descripcion' => 'Playeras, tazas, termos, vasos y stickers de graduación 2026. Cada pieza se adapta al diseño, nombre o evento que necesites.',
    ],
    [
        'imagen' => 'playera-hibisco.png',
        'etiqueta' => 'PLAYERAS · FRENTE Y ESPALDA',
        'titulo' => 'Playera negra con flor de hibisco',
        'descripcion' => 'Diseño floral a color: una versión pequeña al frente y una grande en la espalda. Muestra cómo combinar impresiones en ambos lados de la prenda.',
    ],
    [
        'imagen' => 'playera-encuentro-stem.png',
        'etiqueta' => 'EVENTOS · UNIFORMES',
        'titulo' => '3er Encuentro Nacional de Niñas STEM UTP',
        'descripcion' => 'Propuesta de playera morada con logotipo al frente y diseño grande en la espalda para el encuentro. Ejemplo de personalización para eventos institucionales.',
    ],
    [
        'imagen' => 'playera-dope-prints.png',
        'etiqueta' => 'MERCH DOPE PRINTS',
        'titulo' => 'Playera oficial DOPE PRINTS',
        'descripcion' => 'Playera negra con el logo de la marca al frente y un diseño completo en la espalda con nuestros servicios de impresión personalizada.',
    ],
];

/* Cómo trabajamos (sin imágenes) */
$pasos = [
    ['numero' => '1', 'titulo' => 'Cuéntanos tu idea', 'descripcion' => 'Elige el producto y platícanos qué quieres: un diseño, un nombre, un logo o una frase.'],
    ['numero' => '2', 'titulo' => 'Diseñamos contigo', 'descripcion' => 'Preparamos una propuesta visual para que la revises y pidas los ajustes que necesites.'],
    ['numero' => '3', 'titulo' => 'Producimos', 'descripcion' => 'Una vez aprobado el diseño, lo estampamos o sublimamos en tu producto.'],
    ['numero' => '4', 'titulo' => 'Recibe tu pedido', 'descripcion' => 'Entregamos tu producto listo para usar, regalar o presumir.'],
];

/* Preguntas frecuentes (sin imágenes) */
$faq = [
    ['pregunta' => '¿Qué productos puedo personalizar?', 'respuesta' => 'Playeras, sudaderas, tazas, termos y otras superficies compatibles con DTF y DTF UV.'],
    ['pregunta' => '¿Puedo llevar mi propio diseño?', 'respuesta' => 'Sí. Puedes enviarnos tu diseño o describirnos tu idea y nosotros te ayudamos a crearlo.'],
    ['pregunta' => '¿Hacen pedidos para grupos o eventos?', 'respuesta' => 'Sí. Hacemos playeras, tazas y recuerdos para graduaciones, eventos, equipos y regalos institucionales.'],
    ['pregunta' => '¿Cómo hago mi pedido?', 'respuesta' => 'Entra al catálogo de UTP-Market, elige tu producto y contáctanos con los detalles de tu diseño.'],
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

    .dope-page *, .dope-page *::before, .dope-page *::after { box-sizing: border-box; }

    .dope-container { width: 100%; max-width: 1180px; margin: 0 auto; }

    .dope-breadcrumb { margin-bottom: 25px; color: var(--dp-gris); font-size: 13px; }
    .dope-breadcrumb a { color: inherit; text-decoration: none; }
    .dope-breadcrumb a:hover { color: var(--dp-vino); }

    .dope-hero {
        display: grid; grid-template-columns: 1.4fr .6fr; align-items: center; gap: 30px;
        padding: 42px; margin-bottom: 35px; overflow: hidden;
        background: #fff; border: 1px solid var(--dp-borde); border-radius: 12px;
    }

    .dope-eyebrow { margin-bottom: 15px; color: var(--dp-vino); font-size: 11px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; }

    .dope-hero h1 { margin: 0; color: var(--dp-texto); font-size: clamp(32px, 4vw, 48px); font-weight: 800; line-height: 1.13; letter-spacing: -1.3px; }
    .dope-hero h1 span { color: var(--dp-vino); }
    .dope-hero p { max-width: 600px; margin: 18px 0 24px; color: var(--dp-gris); font-size: 14px; line-height: 1.8; }

    .dope-button {
        display: inline-block; padding: 13px 22px; border: 0; border-radius: 6px;
        background: var(--dp-amarillo); color: #352719 !important; font-size: 12px; font-weight: 700;
        text-decoration: none !important; cursor: pointer; transition: background .2s, transform .2s;
    }
    .dope-button:hover { background: #f2ae1d; transform: translateY(-1px); }

    .dope-brand-panel {
        display: flex; min-height: 220px; flex-direction: column; align-items: center; justify-content: center;
        padding: 25px; border-radius: 10px; background: var(--dp-vino); color: #fff; text-align: center;
    }
    .dope-brand-letter { color: var(--dp-amarillo); font-size: 83px; font-weight: 900; line-height: 1; text-shadow: 4px 4px 0 #542027; }
    .dope-brand-panel strong { margin-top: 12px; font-size: 22px; letter-spacing: 2px; }
    .dope-brand-panel small { margin-top: 8px; color: #f0dddd; font-size: 10px; letter-spacing: 2px; }

    .dope-section { margin-top: 38px; }
    .dope-section-heading { display: flex; align-items: end; justify-content: space-between; gap: 15px; margin-bottom: 20px; }
    .dope-section-heading h2 { margin: 0; color: var(--dp-texto); font-size: 25px; font-weight: 800; }
    .dope-section-heading p { margin: 8px 0 0; color: var(--dp-gris); font-size: 13px; line-height: 1.6; }

    /* Galería */
    .dope-gallery { display: grid; grid-template-columns: repeat(6, minmax(0, 1fr)); gap: 22px; }
    .dope-gallery-card { grid-column: span 2; overflow: hidden; border: 1px solid var(--dp-borde); border-radius: 9px; background: #fff; transition: transform .2s, box-shadow .2s; }
    .dope-gallery-card:hover { transform: translateY(-3px); box-shadow: 0 10px 25px #3d21100d; }
    .dope-gallery-card.is-wide { grid-column: span 3; }
    .dope-gallery-photo { height: 280px; background: #f1e9e5; overflow: hidden; }
    .dope-gallery-card.is-wide .dope-gallery-photo { height: 330px; }
    .dope-gallery-photo img { display: block; width: 100%; height: 100%; object-fit: cover; }
    .dope-gallery-body { padding: 20px 21px 24px; }
    .dope-gallery-body h3 { margin: 14px 0 9px; color: var(--dp-texto); font-size: 17px; }
    .dope-gallery-body p { margin: 0; color: var(--dp-gris); font-size: 12px; line-height: 1.8; }


    /* Logo */
    .dope-brand-logo { display: block; width: 100%; max-width: 200px; height: auto; }

    /* Pasos */
    .dope-steps { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; }
    .dope-step { position: relative; padding: 23px; border: 1px solid var(--dp-borde); border-radius: 9px; background: #fff; }
    .dope-step-number { display: inline-flex; width: 39px; height: 39px; align-items: center; justify-content: center; border-radius: 50%; background: var(--dp-vino); color: #fff; font-weight: 800; }
    .dope-step h3 { margin: 17px 0 9px; font-size: 15px; }
    .dope-step p { margin: 0; color: var(--dp-gris); font-size: 12px; line-height: 1.8; }


    /* FAQ */
    .dope-faq { display: grid; gap: 12px; }
    .dope-faq details { border: 1px solid var(--dp-borde); border-radius: 9px; background: #fff; padding: 16px 20px; }
    .dope-faq summary { cursor: pointer; font-size: 14px; font-weight: 700; color: var(--dp-texto); }
    .dope-faq details[open] summary { color: var(--dp-vino); }
    .dope-faq details p { margin: 12px 0 0; color: var(--dp-gris); font-size: 13px; line-height: 1.8; }


    .dope-tag { display: inline-block; padding: 6px 9px; border-radius: 4px; background: #f7eddf; color: var(--dp-vino); font-size: 9px; font-weight: 800; letter-spacing: .8px; }



    .dope-services-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
    .dope-service-card { padding: 23px; border: 1px solid var(--dp-borde); border-radius: 9px; background: #fff; }
    .dope-service-number { display: inline-flex; width: 39px; height: 39px; align-items: center; justify-content: center; border-radius: 8px; background: var(--dp-amarillo); color: var(--dp-texto); font-weight: 800; }
    .dope-service-card h3 { margin: 17px 0 9px; font-size: 15px; }
    .dope-service-card p { margin: 0; color: var(--dp-gris); font-size: 12px; line-height: 1.8; }


    @media (max-width: 850px) {
        .dope-hero { grid-template-columns: 1fr; padding: 28px; }
        .dope-brand-panel { min-height: 170px; }
        .dope-services-grid { grid-template-columns: 1fr; }
        .dope-steps { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .dope-gallery { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .dope-gallery-card, .dope-gallery-card.is-wide { grid-column: span 1; }
        .dope-gallery-card.is-wide .dope-gallery-photo, .dope-gallery-photo { height: 240px; }
    }

    @media (max-width: 520px) {
        .dope-page { padding: 22px 12px 40px; }
        .dope-hero { padding: 22px; }
        .dope-gallery, .dope-steps { grid-template-columns: 1fr; }
        .dope-section-heading h2 { font-size: 22px; }
    }
</style>

<div class="dope-page">
    <div class="dope-container">

        <div class="dope-breadcrumb">
            <a href="<?= dp_escape(function_exists('url') ? url('home') : '/') ?>">Inicio</a>
            / <strong>DOPE PRINTS</strong>
        </div>

        <section class="dope-hero">
            <div>
                <div class="dope-eyebrow">CREATIVIDAD · ESTILO · PERSONALIZACIÓN</div>

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

                <a href="#dope-trabajos" class="dope-button">Ver nuestros trabajos →</a>
            </div>

            <div class="dope-brand-panel">
                <img class="dope-brand-logo"
                     src="<?= dp_escape($dp_img . 'logo-dope-prints.png') ?>"
                     alt="Logo DOPE PRINTS Custom & DTF">
                <small>MAKE IT YOURS</small>
            </div>
        </section>

        <section id="dope-trabajos" class="dope-section">
            <div class="dope-section-heading">
                <div>
                    <h2>Nuestros trabajos</h2>
                    <p>Algunos de los productos y diseños que hemos realizado.</p>
                </div>
            </div>

            <div class="dope-gallery">
                <?php foreach ($galeria as $i => $foto): ?>
                    <?php $ancha = $i >= count($galeria) - 2; /* las 2 últimas ocupan media fila */ ?>
                    <article class="dope-gallery-card<?= $ancha ? ' is-wide' : '' ?>">
                        <div class="dope-gallery-photo">
                            <img
                                src="<?= dp_escape($dp_img . $foto['imagen']) ?>"
                                alt="<?= dp_escape($foto['titulo']) ?>"
                                loading="lazy"
                            >
                        </div>
                        <div class="dope-gallery-body">
                            <span class="dope-tag"><?= dp_escape($foto['etiqueta']) ?></span>
                            <h3><?= dp_escape($foto['titulo']) ?></h3>
                            <p><?= dp_escape($foto['descripcion']) ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="dope-servicios" class="dope-section">
            <div class="dope-section-heading">
                <div>
                    <h2>Nuestros servicios</h2>
                    <p>Opciones de personalización para expresar tu estilo.</p>
                </div>
            </div>

            <div class="dope-services-grid">
                <?php foreach ($servicios as $servicio): ?>
                    <article class="dope-service-card">
                        <span class="dope-service-number"><?= dp_escape($servicio['numero']) ?></span>
                        <h3><?= dp_escape($servicio['titulo']) ?></h3>
                        <p><?= dp_escape($servicio['descripcion']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="dope-proceso" class="dope-section">
            <div class="dope-section-heading">
                <div>
                    <h2>¿Cómo trabajamos?</h2>
                    <p>Del primer boceto a tu producto terminado en 4 pasos.</p>
                </div>
            </div>

            <div class="dope-steps">
                <?php foreach ($pasos as $paso): ?>
                    <article class="dope-step">
                        <span class="dope-step-number"><?= dp_escape($paso['numero']) ?></span>
                        <h3><?= dp_escape($paso['titulo']) ?></h3>
                        <p><?= dp_escape($paso['descripcion']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="dope-faq" class="dope-section">
            <div class="dope-section-heading">
                <div>
                    <h2>Preguntas frecuentes</h2>
                    <p>Resolvemos tus dudas antes de hacer tu pedido.</p>
                </div>
            </div>

            <div class="dope-faq">
                <?php foreach ($faq as $item): ?>
                    <details>
                        <summary><?= dp_escape($item['pregunta']) ?></summary>
                        <p><?= dp_escape($item['respuesta']) ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        </section>

    </div>
</div>