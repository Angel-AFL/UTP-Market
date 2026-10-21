<!--------------- estilos de la página Aerial Studio ---------------->
<style>
    :root { --vino: #722F37; --vino-oscuro: #5B1F2B; --vino-claro: #f6e9eb; }

    /* Barra de título (Inicio / Aerial Studio) */
    .blog.about-blog { background: linear-gradient(90deg, var(--vino-oscuro), var(--vino)) !important; }
    .blog.about-blog .heading,
    .blog.about-blog a,
    .blog.about-blog span,
    .blog.about-blog .devider { color: #ffffff !important; }

    /* Botones */
    .shop-btn { background: var(--vino) !important; border-color: var(--vino) !important; color: #ffffff !important; }
    .shop-btn:hover { background: var(--vino-oscuro) !important; border-color: var(--vino-oscuro) !important; }

    /* Tarjetas de servicios y opiniones */
    .emp-card {
        background: #ffffff;
        border: 1px solid var(--vino-claro);
        border-radius: 18px;
        padding: 28px;
        height: 100%;
        box-shadow: 0 10px 28px rgba(114, 47, 55, 0.08);
    }
    .emp-card .num {
        width: 48px; height: 48px; border-radius: 50%;
        background: var(--vino); color: #ffffff;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; margin-bottom: 16px;
    }
    .emp-card h5 { font-weight: 700; margin-bottom: 10px; }
    .emp-card p { margin: 0; color: #555555; line-height: 1.6; }

    .emp-title { text-align: center; margin-bottom: 36px; font-weight: 700; }

    /* Galería */
    .emp-gallery img { width: 100%; height: 260px; object-fit: cover; border-radius: 16px; }

    /* Llamado a la acción */
    .emp-cta {
        background: linear-gradient(90deg, var(--vino-oscuro), var(--vino));
        color: #ffffff; border-radius: 20px; padding: 48px 24px; text-align: center;
    }
    .emp-cta h3 { color: #ffffff; }
    .emp-cta .shop-btn { background: #ffffff !important; color: var(--vino) !important; }
</style>

<!--------------- título --------------->
<section class="blog about-blog">
    <div class="container">
        <div class="blog-bradcrum">
            <span><a href="/">Inicio</a></span>
            <span class="devider">/</span>
            <span><a href="#">Aerial Studio</a></span>
        </div>
        <div class="blog-heading about-heading">
            <h1 class="heading">Aerial Studio</h1>
        </div>
    </div>
</section>

<!--------------- presentación --------------->
<section class="about">
    <div class="container">
        <div class="about-section">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <div class="about-img" data-aos="fade-right">
                        <img src="<?= asset('assets/images/homepage-one/about/camara.avif') ?>" alt="Aerial Studio">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content" data-aos="fade-up">
                        <h3 class="about-title">Conoce más sobre Aerial Studio</h3>
                        <p class="about-info">
                            Somos un estudio especializado en producción aérea y video con drones.
                            Escribe aquí un párrafo más largo: quiénes son, cómo empezaron y qué los distingue.
                        </p>
                        <div class="about-list">
                            <ul>
                                <?php foreach (['Tomas aéreas profesionales', 'Edición incluida', 'Entrega rápida'] as $punto): ?>
                                <li>
                                    <span>
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12.5" cy="12.5" r="12.5" fill="#722F37" />
                                            <path d="M7 12.5l3.5 3.5L18 8.5" stroke="white" stroke-width="2" fill="none" />
                                        </svg>
                                    </span>
                                    <p><?= htmlspecialchars($punto) ?></p>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <a href="/contact-us" class="shop-btn">Contáctanos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--------------- servicios --------------->
<section class="product" style="padding: 60px 0;">
    <div class="container">
        <h3 class="emp-title">Nuestros servicios</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="emp-card">
                    <div class="num">1</div>
                    <h5>Video aéreo</h5>
                    <p>Grabación con dron para eventos, promocionales y recorridos de instalaciones.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="emp-card">
                    <div class="num">2</div>
                    <h5>Fotografía aérea</h5>
                    <p>Fotos de alta resolución para proyectos, terrenos, edificios y paisajes.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="emp-card">
                    <div class="num">3</div>
                    <h5>Edición y postproducción</h5>
                    <p>Montaje, corrección de color y música para entregar un video listo para publicar.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--------------- galería --------------->
<section class="product" style="padding: 20px 0 60px;">
    <div class="container">
        <h3 class="emp-title">Galería</h3>
        <div class="row g-4 emp-gallery">
            <div class="col-md-4"><img src="<?= asset('assets/images/homepage-one/about/DSC_0031.JPG') ?>" alt="Galería 1"></div>
            <div class="col-md-4"><img src="<?= asset('assets/images/homepage-one/about/DSC_0032.JPG') ?>" alt="Galería 2"></div>
            <div class="col-md-4"><img src="<?= asset('assets/images/homepage-one/about/DSC_0056.JPG') ?>" alt="Galería 3"></div>
        </div>
    </div>
</section>


<!--------------- contacto --------------->
<section style="padding: 0 0 70px;">
    <div class="container">
        <div class="emp-cta">
            <h3>¿Quieres cotizar un proyecto?</h3>
            <p style="margin: 12px 0 24px;">Escríbenos y te respondemos lo antes posible.</p>
            <a href="/contact-us" class="shop-btn">Contáctanos</a>
        </div>
    </div>
</section>