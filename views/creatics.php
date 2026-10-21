<style>
    .creatics-page {
        --creatics-primary: #722f37;
        --creatics-dark: #5b1f2b;
        --creatics-soft: #f6e9eb;
        --creatics-text: #34271f;
        --creatics-muted: #666;
        --creatics-paper: #fbf8f6;
        overflow: hidden;
        padding-bottom: 84px;
        background: var(--creatics-paper);
        color: var(--creatics-text);
    }

    .creatics-page .creatics-hero {
        position: relative;
        overflow: hidden;
        padding: 24px 0 70px;
        background:
            radial-gradient(ellipse at 78% 20%, rgba(255, 255, 255, .17), transparent 28%),
            linear-gradient(125deg, var(--creatics-dark), var(--creatics-primary) 66%, #914b4f);
    }

    .creatics-page .creatics-hero::after {
        position: absolute;
        right: -110px;
        bottom: -260px;
        width: 500px;
        height: 500px;
        border: 1px solid rgba(255, 255, 255, .13);
        border-radius: 50%;
        content: "";
        pointer-events: none;
    }

    .creatics-page .creatics-breadcrumb,
    .creatics-page .creatics-breadcrumb a {
        color: #fff !important;
    }

    .creatics-page .creatics-breadcrumb {
        position: relative;
        z-index: 1;
        margin-bottom: 44px;
        font-size: 13px;
        opacity: .8;
    }

    .creatics-page .creatics-breadcrumb a {
        text-decoration: none;
    }

    .creatics-page .creatics-hero-content {
        position: relative;
        z-index: 1;
    }

    .creatics-page .creatics-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 18px;
        padding: 8px 13px;
        border: 1px solid rgba(255, 255, 255, .32);
        border-radius: 99px;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .creatics-page .creatics-eyebrow::before {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f1c9a5;
        content: "";
    }

    .creatics-page .creatics-hero h1 {
        max-width: 620px;
        margin: 0 0 20px;
        color: #fff;
        font-size: clamp(40px, 5.4vw, 68px);
        font-weight: 800;
        letter-spacing: -2px;
        line-height: 1.04;
    }

    .creatics-page .creatics-hero h1 span {
        color: #f1c9a5;
    }

    .creatics-page .creatics-hero-copy {
        max-width: 500px;
        margin: 0 0 28px;
        color: rgba(255, 255, 255, .83);
        font-size: 16px;
        line-height: 1.75;
    }

    .creatics-page .shop-btn {
        display: inline-flex;
        min-height: 48px;
        align-items: center;
        justify-content: center;
        padding: 0 22px;
        border-color: var(--creatics-primary) !important;
        background: var(--creatics-primary) !important;
        color: #fff !important;
        font-weight: 700;
        text-decoration: none;
        transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .creatics-page .shop-btn:hover {
        border-color: var(--creatics-dark) !important;
        background: var(--creatics-dark) !important;
        box-shadow: 0 10px 24px rgba(35, 12, 17, .18);
        transform: translateY(-2px);
    }

    .creatics-page .creatics-hero-image {
        position: relative;
        max-width: 450px;
        margin-left: auto;
        padding: 12px;
        border: 1px solid rgba(255, 255, 255, .35);
        border-radius: 24px;
        background: rgba(255, 255, 255, .12);
        box-shadow: 0 28px 70px rgba(37, 12, 18, .26);
        transform: rotate(2deg);
    }

    .creatics-page .creatics-hero-image img {
        width: 100%;
        height: 390px;
        border-radius: 16px;
        object-fit: cover;
    }

    .creatics-page .creatics-hero-image figcaption {
        position: absolute;
        right: -18px;
        bottom: 30px;
        padding: 13px 17px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 12px 30px rgba(37, 12, 18, .18);
        color: var(--creatics-dark);
        font-size: 13px;
        font-weight: 700;
    }

    .creatics-page .creatics-section {
        padding: 74px 0 10px;
    }

    .creatics-page .creatics-title {
        margin-bottom: 12px;
        color: var(--creatics-text);
        font-size: clamp(27px, 3vw, 36px);
        font-weight: 700;
        text-align: center;
    }

    .creatics-page .creatics-section-intro {
        max-width: 570px;
        margin: 0 auto 34px;
        color: var(--creatics-muted);
        line-height: 1.7;
        text-align: center;
    }

    .creatics-page .creatics-card {
        position: relative;
        height: 100%;
        overflow: hidden;
        padding: 30px;
        border: 1px solid #efe5e1;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(68, 38, 30, .045);
        transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    }

    .creatics-page .creatics-card:hover {
        border-color: #e2c5c3;
        box-shadow: 0 18px 38px rgba(68, 38, 30, .10);
        transform: translateY(-5px);
    }

    .creatics-page .creatics-card .number {
        display: flex;
        width: 46px;
        height: 46px;
        margin-bottom: 16px;
        align-items: center;
        justify-content: center;
        border: 1px solid #ead2d1;
        border-radius: 14px;
        background: var(--creatics-soft);
        color: var(--creatics-primary);
        font-weight: 700;
    }

    .creatics-page .creatics-card h3 {
        margin-bottom: 10px;
        font-size: 20px;
        font-weight: 700;
    }

    .creatics-page .creatics-card p {
        margin: 0;
        color: var(--creatics-muted);
        line-height: 1.65;
    }

    .creatics-page .creatics-gallery-card {
        height: 100%;
        overflow: hidden;
        border: 1px solid #efe5e1;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(68, 38, 30, .05);
        transition: transform .22s ease, box-shadow .22s ease;
    }

    .creatics-page .creatics-gallery-card:hover {
        box-shadow: 0 18px 38px rgba(68, 38, 30, .12);
        transform: translateY(-5px);
    }

    .creatics-page .creatics-gallery-photo {
        overflow: hidden;
        background: #f0e8e4;
    }

    .creatics-page .creatics-gallery-card img {
        width: 100%;
        height: 275px;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .creatics-page .creatics-gallery-card:hover img {
        transform: scale(1.045);
    }

    .creatics-page .creatics-gallery-caption {
        padding: 19px 20px 21px;
    }

    .creatics-page .creatics-gallery-caption span {
        color: var(--creatics-primary);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .creatics-page .creatics-gallery-caption h3 {
        margin: 6px 0 0;
        color: var(--creatics-text);
        font-size: 17px;
        font-weight: 700;
    }

    .creatics-page .creatics-cta {
        position: relative;
        overflow: hidden;
        padding: 54px 24px;
        border-radius: 22px;
        background:
            radial-gradient(circle at 90% 10%, rgba(255, 255, 255, .14), transparent 28%),
            linear-gradient(115deg, var(--creatics-dark), var(--creatics-primary));
        color: #fff;
        text-align: center;
    }

    .creatics-page .creatics-cta h2 {
        margin-bottom: 10px;
        color: #fff;
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 700;
    }

    .creatics-page .creatics-cta p {
        margin: 0 0 24px !important;
        color: rgba(255, 255, 255, .82);
    }

    .creatics-page .creatics-cta .shop-btn {
        border-color: #fff !important;
        background: #fff !important;
        color: var(--creatics-primary) !important;
    }

    .creatics-page .creatics-cta .shop-btn:hover {
        background: #f8e9e7 !important;
    }

    @media (max-width: 991px) {
        .creatics-page .creatics-hero-image {
            max-width: 390px;
            margin: 20px auto 0;
        }
    }

    @media (max-width: 575px) {
        .creatics-page {
            padding-bottom: 56px;
        }

        .creatics-page .creatics-hero {
            padding: 20px 0 48px;
        }

        .creatics-page .creatics-breadcrumb {
            margin-bottom: 32px;
        }

        .creatics-page .creatics-hero h1 {
            letter-spacing: -1px;
        }

        .creatics-page .creatics-hero-copy {
            font-size: 15px;
        }

        .creatics-page .creatics-hero-image img {
            height: 290px;
        }

        .creatics-page .creatics-hero-image figcaption {
            right: -7px;
        }

        .creatics-page .creatics-section {
            padding-top: 54px;
        }

        .creatics-page .creatics-card {
            padding: 24px;
        }

        .creatics-page .creatics-gallery-card img {
            height: 245px;
        }
    }
</style>

<main class="creatics-page">
    <section class="creatics-hero">
        <div class="container">
            <div class="creatics-breadcrumb">
                <span><a href="<?= url() ?>">Inicio</a></span>
                <span aria-hidden="true"> / </span>
                <span><a href="<?= url('creatics') ?>">Creatics</a></span>
            </div>
            <div class="row align-items-center gy-4">
                <div class="col-lg-7">
                    <div class="creatics-hero-content">
                        <span class="creatics-eyebrow">Creatividad hecha en 3D</span>
                        <h1>Tus ideas toman forma <span>capa por capa.</span></h1>
                        <p class="creatics-hero-copy">
                            Creamos prototipos, figuras y piezas personalizadas con impresión 3D.
                            Del concepto a un objeto real, hecho para ti.
                        </p>
                        <a href="<?= url('product-sidebar') ?>" class="shop-btn">Explorar servicios</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <figure class="creatics-hero-image">
                        <img
                            src="<?= asset('assets/images/homepage-one/product-img/crea.jpeg') ?>"
                            alt="Pieza personalizada creada por Creatics"
                        >
                        <figcaption>Impresión 3D para tus ideas.</figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="creatics-section">
        <div class="container">
            <h2 class="creatics-title">Lo que podemos crear</h2>
            <p class="creatics-section-intro">Soluciones de impresión 3D para explorar ideas, desarrollar proyectos y crear piezas a tu medida.</p>
            <div class="row g-4">
                <div class="col-md-4">
                    <article class="creatics-card">
                        <span class="number">01</span>
                        <h3>Impresión 3D</h3>
                        <p>Prototipos, figuras y piezas personalizadas para convertir tus diseños en objetos reales.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="creatics-card">
                        <span class="number">02</span>
                        <h3>Prototipado rápido</h3>
                        <p>Desarrollamos prototipos impresos en 3D para probar y materializar tus ideas.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="creatics-card">
                        <span class="number">03</span>
                        <h3>Piezas personalizadas</h3>
                        <p>Creamos figuras y piezas impresas en 3D adaptadas a tu proyecto o necesidad.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="creatics-section">
        <div class="container">
            <h2 class="creatics-title">Ideas hechas realidad</h2>
            <p class="creatics-section-intro">Conoce algunos ejemplos de piezas realizadas con impresión 3D.</p>
            <div class="row g-4 creatics-gallery">
                <div class="col-sm-6 col-lg-4">
                    <article class="creatics-gallery-card">
                        <div class="creatics-gallery-photo">
                            <img src="<?= asset('assets/images/homepage-one/product-img/product-img-2.jpeg') ?>" alt="Pieza de prototipado 3D" loading="lazy">
                        </div>
                        <div class="creatics-gallery-caption">
                            <span>Prototipado</span>
                            <h3>De la idea al primer modelo</h3>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <article class="creatics-gallery-card">
                        <div class="creatics-gallery-photo">
                            <img src="<?= asset('assets/images/homepage-one/product-img/product-img-1.jpeg') ?>" alt="Figura creada con impresión 3D" loading="lazy">
                        </div>
                        <div class="creatics-gallery-caption">
                            <span>Diseño personalizado</span>
                            <h3>Figuras con tu estilo</h3>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <article class="creatics-gallery-card">
                        <div class="creatics-gallery-photo">
                            <img src="<?= asset('assets/images/homepage-one/product-img/product-img-3.jpeg') ?>" alt="Producto de impresión 3D" loading="lazy">
                        </div>
                        <div class="creatics-gallery-caption">
                            <span>Impresión 3D</span>
                            <h3>Piezas listas para crear</h3>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="creatics-section">
        <div class="container">
            <div class="creatics-cta">
                <h2>¿Tienes una idea para crear?</h2>
                <p>Cuéntanos tu proyecto y empecemos a darle forma en 3D.</p>
                <a href="<?= url('contact-us') ?>" class="shop-btn">Contáctanos</a>
            </div>
        </div>
    </section>
</main>
