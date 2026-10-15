<?php
$productosAcrilico = [
    [
        'nombre' => 'Letreros personalizados',
        'descripcion' => 'Nombres y logotipos en acrílico para negocios, eventos y decoración.',
    ],
    [
        'nombre' => 'Llaveros personalizados',
        'descripcion' => 'Piezas con nombres, figuras o diseños para recuerdos y regalos.',
    ],
    [
        'nombre' => 'Nombres y letras decorativas',
        'descripcion' => 'Letras cortadas a medida para mesas, paredes y celebraciones.',
    ],
    [
        'nombre' => 'Piezas a medida',
        'descripcion' => 'Corte de formas y componentes según las medidas de tu proyecto.',
    ],
];
?>

<style>
    .acrilico-page {
        --acrilico-color: #7b3038;
        max-width: 1200px;
        margin: 0 auto;
        padding: 45px 20px 65px;
        color: #292929;
    }

    .acrilico-page * {
        box-sizing: border-box;
    }

    .acrilico-page .acrilico-breadcrumb {
        margin-bottom: 24px;
        font-size: 14px;
    }

    .acrilico-page .acrilico-breadcrumb a {
        color: var(--acrilico-color);
        text-decoration: none;
    }

    .acrilico-page .acrilico-hero {
        padding: 48px 35px;
        border-radius: 18px;
        background: #f4e8e9;
    }

    .acrilico-page .acrilico-etiqueta {
        display: inline-block;
        margin-bottom: 14px;
        color: var(--acrilico-color);
        font-weight: 700;
        font-size: 14px;
    }

    .acrilico-page h1 {
        margin: 0 0 18px;
        color: var(--acrilico-color);
        font-size: clamp(30px, 5vw, 46px);
    }

    .acrilico-page .acrilico-hero p {
        max-width: 720px;
        margin: 0;
        font-size: 17px;
        line-height: 1.8;
    }

    .acrilico-page h2 {
        margin: 40px 0 22px;
        font-size: 27px;
        color: #292929;
    }

    .acrilico-page .acrilico-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
    }

    .acrilico-page .acrilico-card {
        padding: 25px;
        background: #fff;
        border: 1px solid #eadfe0;
        border-radius: 14px;
    }

    .acrilico-page .acrilico-numero {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        margin-bottom: 18px;
        border-radius: 12px;
        background: #f4e8e9;
        color: var(--acrilico-color);
        font-weight: 700;
    }

    .acrilico-page .acrilico-card h3 {
        margin: 0 0 12px;
        font-size: 20px;
        color: #292929;
    }

    .acrilico-page .acrilico-card p {
        margin: 0;
        color: #606060;
        line-height: 1.7;
    }

    .acrilico-page .acrilico-info {
        margin-top: 35px;
        padding: 28px;
        border-left: 5px solid var(--acrilico-color);
        border-radius: 10px;
        background: #fff;
    }

    .acrilico-page .acrilico-info h2 {
        margin: 0 0 15px;
        font-size: 24px;
    }

    .acrilico-page .acrilico-info ul {
        padding-left: 22px;
        margin: 0;
        line-height: 1.9;
    }

    @media (max-width: 900px) {
        .acrilico-page .acrilico-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 540px) {
        .acrilico-page .acrilico-grid {
            grid-template-columns: 1fr;
        }

        .acrilico-page .acrilico-hero {
            padding: 30px 22px;
        }
    }
</style>

<main class="acrilico-page">
  <a href="<?= url('product-sidebar') ?>" class="madera-volver">← Volver al catálogo</a>

    <section class="acrilico-hero">
        <span class="acrilico-etiqueta">CORTADORA LÁSER</span>

        <h1>Corte en Acrílico</h1>

        <p>
            Dale forma a tus ideas con piezas de acrílico personalizadas.
            Crea letreros, llaveros, letras decorativas y piezas a medida
            para tus proyectos, negocios o eventos.
        </p>
    </section>

    <section aria-labelledby="acrilico-productos">
        <h2 id="acrilico-productos">¿Qué puedes crear?</h2>

        <div class="acrilico-grid">
            <?php foreach ($productosAcrilico as $indice => $producto): ?>
                <article class="acrilico-card">
                    <span class="acrilico-numero" aria-hidden="true">
                        <?= $indice + 1 ?>
                    </span>

                    <h3>
                        <?= htmlspecialchars(
                            $producto['nombre'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </h3>

                    <p>
                        <?= htmlspecialchars(
                            $producto['descripcion'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="acrilico-info">
        <h2>Prepara tu proyecto</h2>

        <ul>
            <li>Define el diseño o figura que deseas cortar.</li>
            <li>Indica las medidas y la cantidad de piezas.</li>
            <li>
                Consulta los colores y espesores de acrílico disponibles
                con el proveedor.
            </li>
            <li>
                El costo se determina según el material, tamaño,
                cantidad y complejidad del diseño.
            </li>
        </ul>
    </section>
</main>