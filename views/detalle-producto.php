
<?php
$productos = [
    'llaveros' => [
        'nombre' => 'Llaveros personalizados en impresión 3D',
        'precio' => 35.00,
        'imagen' => 'assets/images/homepage-one/product-img/crea.jpeg',
        'categoria' => 'Impresión 3D',
        'descripcion' => 'Llaveros fabricados mediante impresión 3D, ideales para personalizar con nombres, iniciales, figuras o diseños originales. Una opción creativa para regalos, recuerdos y detalles especiales.',
        'caracteristicas' => [
            'Material: filamento para impresión 3D',
            'Personalización con nombres, iniciales o figuras',
            'Variedad de formas, colores y diseños',
            'Ideales para regalos y recuerdos personalizados'
        ]
    ],


    'fotos-estilo-polaroid' => [
        'nombre' => 'Fotos estilo Polaroid',
        'precio' => 50.00,
        'imagen' => 'assets/images/homepage-one/product-img/arial.jpeg',
        'categoria' => 'Impresión y fotografía',
        'descripcion' => 'Impresiones fotográficas con estilo Polaroid, perfectas para conservar recuerdos, decorar espacios o crear regalos personalizados.',
        'caracteristicas' => [
            'Formato inspirado en fotografías Polaroid',
            'Ideales para álbumes y decoración',
            'Adecuadas para regalos personalizados',
            'Consulta los tamaños y la cantidad disponibles'
        ]
    ],

    'taza-sublimada-personalizada' => [
        'nombre' => 'Taza sublimada personalizada',
        'precio' => 80.00,
        'imagen' => 'assets/images/homepage-one/product-img/dope.jpeg',
        'categoria' => 'Artículos personalizados',
        'descripcion' => 'Taza personalizada mediante sublimación, ideal para plasmar fotografías, frases, nombres o diseños originales.',
        'caracteristicas' => [
            'Personalización mediante sublimación',
            'Posibilidad de incluir nombres, frases o imágenes',
            'Ideal para regalos y uso cotidiano',
            'Consulta los diseños disponibles'
        ]
    ],

    'portacelular-corte-laser' => [
        'nombre' => 'Portacelular de corte láser',
        'precio' => 40.00,
        'imagen' => 'assets/images/homepage-one/product-img/corte.jpeg',
        'categoria' => 'Corte láser',
        'descripcion' => 'Portacelular elaborado mediante corte láser, diseñado para mantener el teléfono en una posición cómoda mientras estudias, trabajas o ves contenido multimedia.',
        'caracteristicas' => [
            'Diseño práctico para colocar el teléfono',
            'Fabricación mediante corte láser',
            'Ideal para escritorio o área de estudio',
            'Consulta el material y los modelos disponibles'
        ]
    ]
];

$slug = $_GET['slug'] ?? '';
$producto = $productos[$slug] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $producto
            ? htmlspecialchars($producto['nombre'])
            : 'Producto no encontrado' ?>
        | UTP-Market
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 20px;
            font-family: Arial, sans-serif;
            background: #f4f6f1;
            color: #26372b;
        }

        .contenedor {
            width: 100%;
            max-width: 760px;
            margin: 0 auto;
        }

        .producto {
            background: #ffffff;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 5px 22px rgba(25, 50, 30, 0.08);
            text-align: center;
        }

        .categoria {
            display: inline-block;
            margin: 0 0 15px;
            padding: 8px 14px;
            border-radius: 20px;
            background: #e8f0e8;
            color: #28583a;
            font-size: 13px;
            font-weight: bold;
        }

        .producto h2 {
            margin: 0 0 22px;
            color: #183c28;
            font-size: 29px;
            line-height: 1.3;
        }

        .imagen-producto {
            display: block;
            width: 100%;
            max-width: 340px;
            height: 300px;
            margin: 0 auto 25px;
            object-fit: contain;
            border-radius: 10px;
        }

        .precio {
            margin: 0 0 28px;
            color: #28613d;
            font-size: 30px;
            font-weight: bold;
        }

        .seccion {
            margin-top: 25px;
            text-align: left;
        }

        .seccion h3 {
            margin: 0 0 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e4e9e3;
            color: #234b31;
            font-size: 19px;
        }

        .descripcion {
            margin: 0;
            color: #5d685f;
            font-size: 15px;
            line-height: 1.8;
        }

        .caracteristicas {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .caracteristicas li {
            position: relative;
            margin-bottom: 12px;
            padding-left: 25px;
            color: #515e54;
            font-size: 15px;
            line-height: 1.6;
        }

        .caracteristicas li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #34754a;
            font-weight: bold;
        }

        .no-encontrado {
            padding: 35px;
            border-radius: 16px;
            background: #ffffff;
            text-align: center;
            box-shadow: 0 5px 22px rgba(25, 50, 30, 0.08);
        }

        .no-encontrado h2 {
            color: #183c28;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .producto {
                padding: 24px 18px;
            }

            .producto h2 {
                font-size: 24px;
            }

            .imagen-producto {
                height: 240px;
            }

            .precio {
                font-size: 27px;
            }

            .seccion h3 {
                font-size: 18px;
            }

            .descripcion,
            .caracteristicas li {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

<main class="contenedor">

    <?php if ($producto): ?>

        <section class="producto">

            <p class="categoria">
                <?= htmlspecialchars($producto['categoria']) ?>
            </p>

            <h2>
                <?= htmlspecialchars($producto['nombre']) ?>
            </h2>

            <img
                class="imagen-producto"
                src="<?= htmlspecialchars($producto['imagen']) ?>"
                alt="<?= htmlspecialchars($producto['nombre']) ?>"
            >

            <p class="precio">
                $<?= number_format($producto['precio'], 2) ?> MXN
            </p>

            <div class="seccion">
                <h3>Descripción</h3>

                <p class="descripcion">
                    <?= htmlspecialchars($producto['descripcion']) ?>
                </p>
            </div>

            <div class="seccion">
                <h3>Características</h3>

                <ul class="caracteristicas">
                    <?php foreach ($producto['caracteristicas'] as $caracteristica): ?>
                        <li>
                            <?= htmlspecialchars($caracteristica) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </section>

    <?php else: ?>

        <section class="no-encontrado">
            <h2>Producto no encontrado</h2>
            <p>El producto solicitado no existe o el enlace no es válido.</p>
        </section>

    <?php endif; ?>

</main>

</body>
</html>