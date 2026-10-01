<!--------------- blog-tittle-section---------------->
    
<style>
    :root {
        --vino: #722F37;
        --vino-oscuro: #5B1F2B;
        --vino-claro: #f6e9eb;
    }

    /* Barra de "Inicio / Sobre nosotros" */
    .blog.about-blog {
        background: linear-gradient(90deg, var(--vino-oscuro), var(--vino)) !important;
    }
    .blog.about-blog .heading,
    .blog.about-blog a,
    .blog.about-blog span,
    .blog.about-blog .devider {
        color: #ffffff !important;
    }

    /* Todos los íconos SVG que eran morados (#AE1C9A) */
    svg [fill="#AE1C9A"],
    svg[fill="#AE1C9A"] {
        fill: var(--vino) !important;
    }

    /* Botones y enlaces */
    .shop-btn,
    .about-btn {
        background: var(--vino) !important;
        border-color: var(--vino) !important;
        color: #ffffff !important;
    }
    .shop-btn:hover,
    .about-btn:hover {
        background: var(--vino-oscuro) !important;
        border-color: var(--vino-oscuro) !important;
    }
    a:hover,
    .about-details:hover {
        color: var(--vino) !important;
    }

    /* Reseñas */
    .about-feedback .testimonial-wrapper::before {
        background: linear-gradient(90deg, var(--vino-oscuro), var(--vino)) !important;
    }
    .about-feedback .testimonial-wrapper {
        border-color: var(--vino-claro) !important;
        box-shadow: 0 12px 32px rgba(114, 47, 55, 0.10) !important;
    }
    .about-feedback .testimonial-wrapper .blockquote span {
        background: var(--vino-claro) !important;
    }
    .about-feedback .testimonial-wrapper .testimonial-info-details {
        border-left-color: var(--vino) !important;
    }

    /* Paginación del slider */
    .swiper-pagination-bullet-active {
        background: var(--vino) !important;
    }
</style><section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="/">Inicio</a></span>
                <span class="devider">/</span>
                <span><a href="#">Sobre nosotros</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">Sobre Nosotros</h1>
            </div>
        </div>
    </section>
    <!--------------- blog-tittle-section-end---------------->

    <!--------------- about-section---------------->
    <section class="about">
        <div class="container">
            <div class="about-section">
                <div class="row align-items-center gy-5">
                    <div class="col-lg-6">
                        <div class="about-img" data-aos="fade-right">
                            <img src="assets/images/homepage-one/about/camara.avif" alt="img">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-content" data-aos="fade-up">
                            <h3 class="about-title">Conoce más sobre nosotros</h3>
                            <p class="about-info">
                                Somos una empresa dedicada a la venta de objetos personalizados con tecnología de impresión 3D y
                                sublimación como objetos dibujados medinate laser otra particularidad es en si la de fotografia 
                                que se maneja de manera profesional y con la mejor calidad de imagen,
                                Entre más cosas para ofrecer, calidad de productos con la facilidad de compra y venta.
                            </p>
                            <div class="about-list">
                                <ul>
                                    <li>
                                        <span>
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12.5" cy="12.5" r="12.5" fill="#AE1C9A" />
                                                <path
                                                    d="M10.1691 13.2566C10.5172 12.8649 10.8498 12.4803 11.198 12.1029C12.7761 10.3864 14.4973 8.80535 16.4699 7.47353C16.6749 7.33465 16.8876 7.20289 17.1042 7.0747C17.1739 7.03552 17.2628 7.00347 17.344 7.00347C17.7888 6.99635 18.2337 6.99991 18.6746 6.99991C18.8138 6.99991 18.926 7.04265 18.9763 7.16728C19.0266 7.28836 18.9879 7.39163 18.8835 7.48065C17.0772 8.99765 15.588 10.7639 14.1724 12.5872C12.8689 14.2644 11.6621 16.0022 10.5288 17.7863C10.4901 17.8504 10.4398 17.918 10.3741 17.9572C10.2348 18.0462 10.0763 17.9964 9.97183 17.8432C9.79777 17.5868 9.63532 17.3233 9.44966 17.074C8.36278 15.6318 7.26817 14.1896 6.17742 12.751C6.13488 12.6976 6.08846 12.6441 6.04978 12.5872C5.97243 12.4732 5.97629 12.3486 6.07686 12.256C6.36695 11.9853 6.66478 11.7147 6.96261 11.4476C7.07864 11.3444 7.20242 11.3515 7.35713 11.4476C7.83675 11.7539 8.31637 12.0637 8.79212 12.3699C9.24853 12.6655 9.70495 12.9575 10.1691 13.2566Z"
                                                    fill="white" />
                                            </svg>

                                        </span>
                                        <p>objetos personalizados</p>
                                    </li>
                                    <li>
                                        <span>
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12.5" cy="12.5" r="12.5" fill="#AE1C9A" />
                                                <path
                                                    d="M10.1691 13.2566C10.5172 12.8649 10.8498 12.4803 11.198 12.1029C12.7761 10.3864 14.4973 8.80535 16.4699 7.47353C16.6749 7.33465 16.8876 7.20289 17.1042 7.0747C17.1739 7.03552 17.2628 7.00347 17.344 7.00347C17.7888 6.99635 18.2337 6.99991 18.6746 6.99991C18.8138 6.99991 18.926 7.04265 18.9763 7.16728C19.0266 7.28836 18.9879 7.39163 18.8835 7.48065C17.0772 8.99765 15.588 10.7639 14.1724 12.5872C12.8689 14.2644 11.6621 16.0022 10.5288 17.7863C10.4901 17.8504 10.4398 17.918 10.3741 17.9572C10.2348 18.0462 10.0763 17.9964 9.97183 17.8432C9.79777 17.5868 9.63532 17.3233 9.44966 17.074C8.36278 15.6318 7.26817 14.1896 6.17742 12.751C6.13488 12.6976 6.08846 12.6441 6.04978 12.5872C5.97243 12.4732 5.97629 12.3486 6.07686 12.256C6.36695 11.9853 6.66478 11.7147 6.96261 11.4476C7.07864 11.3444 7.20242 11.3515 7.35713 11.4476C7.83675 11.7539 8.31637 12.0637 8.79212 12.3699C9.24853 12.6655 9.70495 12.9575 10.1691 13.2566Z"
                                                    fill="white" />
                                            </svg>

                                        </span>
                                        <p>facilidad de compra y venta</p>
                                    </li>
                                    <li>
                                        <span>
                                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12.5" cy="12.5" r="12.5" fill="#AE1C9A" />
                                                <path
                                                    d="M10.1691 13.2566C10.5172 12.8649 10.8498 12.4803 11.198 12.1029C12.7761 10.3864 14.4973 8.80535 16.4699 7.47353C16.6749 7.33465 16.8876 7.20289 17.1042 7.0747C17.1739 7.03552 17.2628 7.00347 17.344 7.00347C17.7888 6.99635 18.2337 6.99991 18.6746 6.99991C18.8138 6.99991 18.926 7.04265 18.9763 7.16728C19.0266 7.28836 18.9879 7.39163 18.8835 7.48065C17.0772 8.99765 15.588 10.7639 14.1724 12.5872C12.8689 14.2644 11.6621 16.0022 10.5288 17.7863C10.4901 17.8504 10.4398 17.918 10.3741 17.9572C10.2348 18.0462 10.0763 17.9964 9.97183 17.8432C9.79777 17.5868 9.63532 17.3233 9.44966 17.074C8.36278 15.6318 7.26817 14.1896 6.17742 12.751C6.13488 12.6976 6.08846 12.6441 6.04978 12.5872C5.97243 12.4732 5.97629 12.3486 6.07686 12.256C6.36695 11.9853 6.66478 11.7147 6.96261 11.4476C7.07864 11.3444 7.20242 11.3515 7.35713 11.4476C7.83675 11.7539 8.31637 12.0637 8.79212 12.3699C9.24853 12.6655 9.70495 12.9575 10.1691 13.2566Z"
                                                    fill="white" />
                                            </svg>

                                        </span>
                                        <p>Rapidez en la entrega</p>
                                    </li>
                                </ul>
                            </div>
                            <a href="/contact-us" class="shop-btn">
                                Contactanos
                                <span>
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="1.45312" y="0.914062" width="9.25346" height="2.05632"
                                            transform="rotate(45 1.45312 0.914062)" fill="white" />
                                        <rect x="8" y="7.45703" width="9.25346" height="2.05632"
                                            transform="rotate(135 8 7.45703)" fill="white" />
                                    </svg>

                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--------------- about-section-end---------------->

    <!--------------- about-service---------------->
    <section class="about-service product ">
        <div class="container">
            <div class="about-service-section">
                <!-- Misión -->
                <div class="about-wrapper">
                    <div class="wrapper-img">
                        <span>
                            <svg width="104" height="104" viewBox="0 0 104 104" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="52" cy="52" r="52" fill="#AE1C9A" />
                                <path d="M52 32C41 32 32 41 32 52C32 63 41 72 52 72C63 72 72 63 72 52C72 41 63 32 52 32ZM52 68C43.2 68 36 60.8 36 52C36 43.2 43.2 36 52 36C60.8 36 68 43.2 68 52C68 60.8 60.8 68 52 68Z" fill="white" />
                                <path d="M50 44H54V56H50V44ZM50 60H54V64H50V60Z" fill="white" />
                            </svg>
                        </span>
                    </div>
                    <div class="wrapper-info">
                        <h5 class="wrapper-details about-details">Nuestra Misión</h5>
                        <p>Impulsar la creatividad, la innovación tecnológica y la personalización a través de servicios universitarios de alta calidad en fotografía, sublimación, robótica, impresión 3D y corte láser, transformando ideas en soluciones tangibles.</p>
                    </div>
                </div>
                <div class="seperator">
                </div>
                <!-- Visión -->
                <div class="about-wrapper">
                    <div class="wrapper-img">
                        <span>
                            <svg width="104" height="104" viewBox="0 0 104 104" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="52" cy="52" r="52" fill="#AE1C9A" />
                                <path d="M52 36C38 36 26 46 22 52C26 58 38 68 52 68C66 68 78 58 82 52C78 46 66 36 52 36ZM52 62C44.3 62 38 55.7 38 48C38 40.3 44.3 34 52 34C59.7 34 66 40.3 66 48C66 55.7 59.7 62 52 62ZM52 40C46.5 40 42 44.5 42 50C42 55.5 46.5 60 52 60C57.5 60 62 55.5 62 50C62 44.5 57.5 40 52 40Z" fill="white" />
                            </svg>
                        </span>
                    </div>
                    <div class="wrapper-info">
                        <h5 class="wrapper-details about-details">Nuestra Visión</h5>
                        <p>Consolidarnos como un referente de desarrollo tecnológico y diseño dentro de la comunidad universitaria, expandiendo nuestro alcance y destacando por la excelencia y versatilidad en cada uno de nuestros proyectos y productos.</p>
                    </div>
                </div>
                <div class="seperator">
                </div>
                <!-- Valores -->
                <div class="about-wrapper">
                    <div class="wrapper-img">
                        <span>
                            <svg width="104" height="104" viewBox="0 0 104 104" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="52" cy="52" r="52" fill="#AE1C9A" />
                                <path d="M52 34L41 42H34V49L41 57L52 65L63 57L70 49V42H63L52 34Z" fill="white" />
                            </svg>
                        </span>
                    </div>
                    <div class="wrapper-info">
                        <h5 class="wrapper-details about-details">Nuestros Valores</h5>
                        <p>Innovación constante, trabajo en equipo, calidad superior en cada acabado, compromiso con el aprendizaje práctico y pasión por la tecnología y el diseño digital.</p>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!--------------- about-service-end---------------->


    <!--------------- about-promotion-section---------------->
    <div class="about-promotion">
        <a href="assets/images/homepage-one/about/advertrisement-vedio.mp4" target="_blank" class="about-btn">
            <span>
                <svg width="34" height="38" viewBox="0 0 34 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5.19276 0.628906C6.04182 0.925379 6.95574 1.10689 7.72983 1.53849C15.5883 5.91299 23.4346 10.3097 31.2626 14.7386C34.8453 16.7655 34.8595 21.3861 31.2829 23.413C23.4569 27.846 15.6126 32.2467 7.75617 36.6252C4.10052 38.6622 0.0780744 36.3267 0.0618631 32.1478C0.0294404 23.4452 0.0395725 14.7426 0.0578102 6.04005C0.0659159 2.98657 2.26255 0.751933 5.19276 0.628906Z"
                        fill="#AE1C9A" />
                </svg>
            </span>
        </a>
        <video src="assets/images/homepage-one/about/advertrisement-vedio.mp4" autoplay loop muted></video>
    </div>
    <!--------------- about-promotion-end---------------->

    <!--------------- about-slider-section---------------->
    <style>
        .about-feedback .about-swiper .swiper-slide {
            height: auto;
            display: flex;
        }
        .about-feedback .testimonial-wrapper {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            height: auto;
            padding: 36px 30px 28px;
            background: #ffffff;
            border: 1px solid #f0e3ee;
            border-radius: 22px;
            box-shadow: 0 12px 32px rgba(174, 28, 154, 0.08);
            text-align: left;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .about-feedback .testimonial-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #AE1C9A, #d65bc6);
        }
        .about-feedback .testimonial-wrapper:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(174, 28, 154, 0.16);
        }
        .about-feedback .testimonial-wrapper .blockquote {
            background: none;
            padding: 0;
            margin: 0 0 18px;
        }
        .about-feedback .testimonial-wrapper .blockquote span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: rgba(174, 28, 154, 0.1);
        }
        .about-feedback .testimonial-wrapper .ratings {
            margin-bottom: 14px;
        }
        .about-feedback .testimonial-wrapper .testimonial-details {
            flex-grow: 1;
            margin: 0 0 20px;
            font-size: 16px;
            line-height: 1.7;
            color: #4a4a4a;
        }
        .about-feedback .testimonial-wrapper .divider {
            height: 1px;
            background: #f0e3ee;
            margin-bottom: 18px;
        }
        .about-feedback .testimonial-wrapper .testimonial-info {
            display: flex;
            align-items: center;
        }
        .about-feedback .testimonial-wrapper .testimonial-info-details {
            padding-left: 14px;
            border-left: 3px solid #4c3349;
        }
        .about-feedback .testimonial-wrapper .testimonial-name {
            margin: 0 0 2px;
            font-size: 17px;
            font-weight: 700;
            color: #1b1b1b;
        }
        .about-feedback .testimonial-wrapper .testimonial-title {
            margin: 0;
            font-size: 14px;
            color: #8a8a8a;
        }
        @media (max-width: 575px) {
            .about-feedback .testimonial-wrapper {
                padding: 30px 22px 24px;
            }
        }
    </style>

    <!-- Íconos reutilizables de las reseñas (se declaran una sola vez) -->
    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <symbol id="rev-quote" viewBox="0 0 38 30">
            <path d="M7.82644 11.9446C8.29006 9.03034 11.9328 5.91742 14.7808 5.85119C14.9795 5.85119 15.1782 5.78496 15.3107 5.65249C15.4431 5.58626 15.5756 5.52003 15.6418 5.32133C16.6353 3.46683 16.1055 2.00972 14.4497 0.817536C12.5289 -0.573341 9.48225 0.817536 7.9589 2.07595C4.11743 5.2551 0.20973 10.7523 0.408427 15.9847C-0.253896 19.4951 -0.121431 23.2703 0.872052 26.3832C1.53437 28.3702 3.45511 29.3636 5.44208 29.4961C7.42905 29.6287 11.5354 30.2247 13.3237 29.0326C15.112 27.8403 15.2445 25.5222 15.4431 23.5353C15.6418 21.3496 16.2379 17.2431 14.3834 15.5211C12.5289 13.8653 7.23035 15.6536 7.82644 11.9446Z" fill="#AE1C9A" />
            <path d="M29.683 11.9446C30.1466 9.03034 33.7893 5.91742 36.6374 5.85119C36.8361 5.85119 37.0348 5.78496 37.1673 5.65249C37.2998 5.58626 37.4322 5.52003 37.4985 5.32133C38.492 3.46683 37.9622 2.00972 36.3064 0.817536C34.3856 -0.573341 31.3389 0.817536 29.8155 2.07595C25.974 5.2551 22.0663 10.7524 22.265 15.9847C21.6027 19.4951 21.7351 23.2703 22.7285 26.3832C23.3908 28.3702 25.3116 29.3636 27.2987 29.4961C29.2856 29.6287 33.392 30.2247 35.1803 29.0326C36.9685 27.8403 37.101 25.5222 37.2997 23.5353C37.4984 21.3496 38.0945 17.2431 36.24 15.5211C34.3855 13.8653 29.0207 15.6536 29.683 11.9446Z" fill="#AE1C9A" />
        </symbol>
        <symbol id="rev-stars" viewBox="0 0 75 15">
            <path d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z" fill="#FFA800" />
            <path d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z" fill="#FFA800" />
            <path d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z" fill="#FFA800" />
            <path d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z" fill="#FFA800" />
            <path d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z" fill="#FFA800" />
        </symbol>
    </svg>

    <section class="about-feedback product">
        <div class="container p-0">
            <div class="position-relative px-5">
                <div class="swiper about-swiper">
                    <div class="swiper-wrapper">
                        <!-- Roxana Gutierrez -->
                        <div class="swiper-slide testimonial-wrapper">
                            <div class="blockquote">
                                <span><svg width="26" height="20"><use href="#rev-quote" /></svg></span>
                            </div>
                            <div class="ratings">
                                <span><svg width="75" height="15"><use href="#rev-stars" /></svg></span>
                            </div>
                            <p class="testimonial-details">Pedí unas tazas sublimadas con fotos de mi familia y quedaron idénticas a lo que mandé. Los colores no se despintan ni después de varios lavados. Además me las entregaron antes de la fecha que me dijeron.
                            </p>
                            <div class="divider"></div>
                            <div class="testimonial-info">
                                <div class="testimonial-info-details">
                                    <h5 class="testimonial-name">Roxana Gutierrez</h5>
                                    <p class="testimonial-title">Clienta</p>
                                </div>
                            </div>
                        </div>
                        <!-- Omar Villamil -->
                        <div class="swiper-slide testimonial-wrapper">
                            <div class="blockquote">
                                <span><svg width="26" height="20"><use href="#rev-quote" /></svg></span>
                            </div>
                            <div class="ratings">
                                <span><svg width="75" height="15"><use href="#rev-stars" /></svg></span>
                            </div>
                            <p class="testimonial-details">Mandé a hacer un llavero en impresión 3D con el logo de mi equipo y salió con muy buen detalle. Me ayudaron a ajustar el diseño antes de imprimirlo y eso se agradece. Ya les pedí otro pedido.
                            </p>
                            <div class="divider"></div>
                            <div class="testimonial-info">
                                <div class="testimonial-info-details">
                                    <h5 class="testimonial-name">Omar Villamil</h5>
                                    <p class="testimonial-title">Cliente</p>
                                </div>
                            </div>
                        </div>
                        <!-- Jorge Moo -->
                        <div class="swiper-slide testimonial-wrapper">
                            <div class="blockquote">
                                <span><svg width="26" height="20"><use href="#rev-quote" /></svg></span>
                            </div>
                            <div class="ratings">
                                <span><svg width="75" height="15"><use href="#rev-stars" /></svg></span>
                            </div>
                            <p class="testimonial-details">Les encargué unas placas grabadas con corte láser para un regalo y el acabado quedó muy limpio. El trato fue rápido y amable, me respondieron por mensaje en el momento. Sin duda vuelvo a comprar.
                            </p>
                            <div class="divider"></div>
                            <div class="testimonial-info">
                                <div class="testimonial-info-details">
                                    <h5 class="testimonial-name">Jorge Moo</h5>
                                    <p class="testimonial-title">Cliente</p>
                                </div>
                            </div>
                        </div>
                        <!-- Carlos Gutierrez -->
                        <div class="swiper-slide testimonial-wrapper">
                            <div class="blockquote">
                                <span><svg width="26" height="20"><use href="#rev-quote" /></svg></span>
                            </div>
                            <div class="ratings">
                                <span><svg width="75" height="15"><use href="#rev-stars" /></svg></span>
                            </div>
                            <p class="testimonial-details">Compré recuerdos fotográficos para mi graduación y la calidad de impresión me sorprendió. Los marcos llegaron bien empacados y sin ningún detalle. El precio me pareció justo para lo que ofrecen.
                            </p>
                            <div class="divider"></div>
                            <div class="testimonial-info">
                                <div class="testimonial-info-details">
                                    <h5 class="testimonial-name">Carlos Gutierrez</h5>
                                    <p class="testimonial-title">Cliente</p>
                                </div>
                            </div>
                        </div>
                        <!-- Mauricio Piste -->
                        <div class="swiper-slide testimonial-wrapper">
                            <div class="blockquote">
                                <span><svg width="26" height="20"><use href="#rev-quote" /></svg></span>
                            </div>
                            <div class="ratings">
                                <span><svg width="75" height="15"><use href="#rev-stars" /></svg></span>
                            </div>
                            <p class="testimonial-details">Pedí playeras personalizadas para un evento y llegaron todas a tiempo. El estampado se ve nítido y no se siente pesado. Lo recomiendo si necesitas varias piezas y quieres que queden parejas.
                            </p>
                            <div class="divider"></div>
                            <div class="testimonial-info">
                                <div class="testimonial-info-details">
                                    <h5 class="testimonial-name">Mauricio Piste</h5>
                                    <p class="testimonial-title">Cliente</p>
                                </div>
                            </div>
                        </div>
                        <!-- Gadiel Cab -->
                        <div class="swiper-slide testimonial-wrapper">
                            <div class="blockquote">
                                <span><svg width="26" height="20"><use href="#rev-quote" /></svg></span>
                            </div>
                            <div class="ratings">
                                <span><svg width="75" height="15"><use href="#rev-stars" /></svg></span>
                            </div>
                            <p class="testimonial-details">Me gustó que puedes combinar varios servicios en un mismo pedido, como una pieza en 3D y otra sublimada. Me explicaron todo con paciencia y el resultado final superó lo que esperaba.
                            </p>
                            <div class="divider"></div>
                            <div class="testimonial-info">
                                <div class="testimonial-info-details">
                                    <h5 class="testimonial-name">Gadiel Cab</h5>
                                    <p class="testimonial-title">Cliente</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </section>

    <!--------------- about-slider-section-end---------------->

    <!--------------- latest-news-section---------------->
    <section class="latest product footer-padding">
        <div class="container">
            <div class="section-title text-center">
                <h4 class="about-details">My Latest News</h4>
            </div>
            <div class="latest-section">
                <div class="row g-5">
                    <div class="col-lg-4 col-sm-6">
                        <div class="blogs-wrapper product-wrapper" data-aos="fade-up" data-aos-duration="300">
                            <div class="wrapper-img">
                                <img src="assets/images/homepage-one/about/image.png" alt="">
                            </div>
                            <div class="wrapper-info">
                                <div class="wrapper-data">
                                    <div class="admin wrapper-item">
                                        <span class="icon">
                                            <svg width="12" height="15" viewBox="0 0 12 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M1.761 14.9996C1.55973 14.9336 1.35152 14.8896 1.16065 14.7978C0.397206 14.4272 -0.02963 13.6273 0.00160193 12.743C0.0397743 11.6936 0.275749 10.7103 0.765049 9.7966C1.42439 8.56373 2.36829 7.65741 3.59327 7.07767C3.67309 7.04098 3.7529 7.00428 3.85007 6.95658C2.68061 5.9512 2.17396 4.67062 2.43422 3.10017C2.58691 2.18285 3.03804 1.42698 3.72514 0.847238C5.24163 -0.42967 7.34458 -0.216852 8.60773 1.1738C9.36424 2.00673 9.70779 3.01211 9.61757 4.16426C9.52734 5.31642 9.01375 6.23374 8.14619 6.94924C8.33359 7.04098 8.50363 7.11436 8.6702 7.20609C10.1485 8.006 11.1618 9.24254 11.6997 10.9011C11.9253 11.5945 12.0328 12.3137 11.9912 13.0476C11.9357 14.0163 11.2243 14.8235 10.3151 14.9703C10.2908 14.974 10.2665 14.9886 10.2387 14.9996C7.41051 14.9996 4.58575 14.9996 1.761 14.9996ZM6.00507 13.8475C7.30293 13.8475 8.60079 13.8401 9.89518 13.8512C10.5684 13.8548 10.9571 13.3338 10.9015 12.7577C10.8807 12.5486 10.8773 12.3394 10.846 12.1303C10.6309 10.6185 9.92294 9.41133 8.72225 8.5784C7.17106 7.50331 5.50883 7.3602 3.84313 8.23349C2.05944 9.16916 1.15718 10.7506 1.09125 12.8568C1.08778 13.0072 1.12595 13.1723 1.18494 13.3044C1.36193 13.6934 1.68466 13.8438 2.08026 13.8438C3.392 13.8475 4.70027 13.8475 6.00507 13.8475ZM5.99119 6.53462C7.38969 6.54196 8.53833 5.33843 8.54527 3.85238C8.55221 2.37733 7.41745 1.16647 6.00507 1.15179C4.62046 1.13344 3.45794 2.35531 3.45099 3.8377C3.44405 5.31275 4.58922 6.52728 5.99119 6.53462Z"
                                                    fill="#AE1C9A" />
                                            </svg>
                                        </span>
                                        <span class="text">
                                            By Admin
                                        </span>
                                    </div>
                                    <div class="comments wrapper-item">
                                        <span class="icon">
                                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.73587 12.2092C3.29657 12.1112 2.8914 11.9493 2.52887 11.698C1.55219 11.0206 1.02333 10.0834 1.01053 8.89479C0.989208 7.06292 0.993473 5.23105 1.00627 3.39919C1.02333 1.68235 2.23885 0.297797 3.94059 0.0379278C4.11119 0.0123668 4.29032 0.00384653 4.46518 0.00384653C7.1564 0.00384653 9.84761 -0.000413627 12.5388 0.00384653C14.2064 0.00810668 15.5712 1.10723 15.9167 2.73034C15.9679 2.97317 15.9892 3.22452 15.9892 3.47587C15.9935 5.25236 15.9977 7.0331 15.9935 8.80958C15.9892 10.5136 14.8632 11.8939 13.2042 12.2134C12.9696 12.2603 12.7307 12.2688 12.4919 12.2688C11.2934 12.2731 10.0992 12.2731 8.90078 12.2688C8.77283 12.2688 8.66621 12.2986 8.55958 12.3711C7.33126 13.1933 6.10294 14.0112 4.87462 14.8334C4.71682 14.9399 4.55048 15.0166 4.35429 14.9953C3.9875 14.957 3.7444 14.6843 3.74013 14.3009C3.73587 13.6747 3.74013 13.0442 3.74013 12.4179C3.73587 12.354 3.73587 12.2901 3.73587 12.2092ZM5.09214 13.0442C5.16891 12.9973 5.21582 12.9632 5.26274 12.9334C6.17971 12.3242 7.09669 11.715 8.0094 11.0973C8.20559 10.9652 8.40178 10.9098 8.63635 10.9098C9.94144 10.9141 11.2423 10.9141 12.5474 10.9098C13.7416 10.9056 14.6329 10.0109 14.6329 8.81384C14.6329 7.02458 14.6329 5.23531 14.6329 3.44605C14.6329 2.26173 13.7373 1.36284 12.5516 1.36284C9.85614 1.36284 7.1564 1.36284 4.46092 1.36284C3.27098 1.36284 2.37533 2.26173 2.37533 3.45457C2.37533 5.23957 2.37533 7.02032 2.37533 8.80532C2.37533 9.97261 3.20701 10.8459 4.37562 10.9056C4.84903 10.9311 5.09214 11.1825 5.0964 11.6554C5.09214 12.1069 5.09214 12.5543 5.09214 13.0442Z"
                                                    fill="#AE1C9A" />
                                                <path
                                                    d="M8.48293 5.45638C7.13519 5.45638 5.79171 5.45638 4.44397 5.45638C3.93644 5.45638 3.60377 4.99628 3.77437 4.54044C3.87673 4.26353 4.08998 4.12295 4.38 4.09313C4.43118 4.08887 4.48662 4.08887 4.5378 4.08887C7.17784 4.08887 9.81361 4.08887 12.4536 4.08887C12.5688 4.08887 12.6882 4.09739 12.7991 4.13147C13.1147 4.22945 13.2981 4.5447 13.2512 4.88552C13.2085 5.19651 12.9271 5.44786 12.5944 5.45212C12.2105 5.46064 11.8267 5.45212 11.4471 5.45212C10.4619 5.45638 9.47241 5.45638 8.48293 5.45638Z"
                                                    fill="#AE1C9A" />
                                                <path
                                                    d="M8.483 8.17895C7.58735 8.17895 6.69597 8.18321 5.80458 8.17895C5.3269 8.17469 5.01129 7.78701 5.11792 7.3397C5.18189 7.05853 5.42926 6.84552 5.71928 6.82848C5.76193 6.82422 5.80458 6.82422 5.84723 6.82422C7.61721 6.82422 9.39145 6.82422 11.1614 6.82422C11.5581 6.82422 11.8268 7.02871 11.895 7.37378C11.976 7.78275 11.6818 8.16617 11.2638 8.17895C10.8885 8.19173 10.5089 8.18321 10.1293 8.18321C9.57911 8.17895 9.03319 8.17895 8.483 8.17895Z"
                                                    fill="#AE1C9A" />
                                            </svg>
                                        </span>
                                        <span class="text">
                                            Comments
                                        </span>
                                    </div>
                                </div>
                                <a href="/blogs-details" class="about-details wrapper-details"
                                >Nuevos diseños y acabados en sublimación de tazas y playeras personalizados
                            </a>
                                </a>
                                <div class="divider"></div>

                                <a href="/blogs-details" class="shop-btn">
                                    Learn More
                                    <span>
                                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.6227 4.38176C12.5587 4.38176 12.4989 4.38176 12.4349 4.38176C8.56302 4.38176 4.69114 4.38176 0.819254 4.38176C0.7168 4.38176 0.614347 4.37785 0.516163 4.40129C0.195996 4.4677 -0.0302552 4.76459 0.00389589 5.05758C0.0423159 5.37791 0.302718 5.60839 0.644229 5.62793C0.712532 5.63183 0.780834 5.63183 0.853405 5.63183C4.71248 5.63183 8.57583 5.63183 12.4349 5.63183C12.4989 5.63183 12.5587 5.63183 12.6654 5.63183C12.5971 5.69824 12.5587 5.73731 12.516 5.77637C11.3805 6.8194 10.2407 7.86243 9.10517 8.90546C8.82342 9.16329 8.79354 9.51878 9.0326 9.77661C9.27166 10.0383 9.68574 10.0774 9.98029 9.86646C10.0272 9.8352 10.0657 9.79614 10.1084 9.75707C11.6494 8.34684 13.1905 6.93269 14.7273 5.51855C15.0987 5.17868 15.0987 4.83882 14.7273 4.49895C13.1777 3.077 11.6238 1.65504 10.0742 0.229172C9.8693 0.0416615 9.63878 -0.0481874 9.35276 0.0260357C8.88319 0.147137 8.70389 0.670605 9.00698 1.01437C9.0454 1.06125 9.09236 1.10032 9.13932 1.14329C10.2663 2.1746 11.389 3.20982 12.5203 4.24113C12.563 4.28019 12.6185 4.29972 12.6654 4.33098C12.6483 4.34269 12.6355 4.36223 12.6227 4.38176Z"
                                                fill="#AE1C9A" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="blogs-wrapper product-wrapper" data-aos="fade-up" data-aos-duration="400">
                            <div class="wrapper-img">
                                <img src="assets/images/homepage-one/about/cursos_robotica.jpeg" alt="">
                            </div>
                            <div class="wrapper-info">
                                <div class="wrapper-data">
                                    <div class="admin wrapper-item">
                                        <span class="icon">
                                            <svg width="12" height="15" viewBox="0 0 12 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M1.761 14.9996C1.55973 14.9336 1.35152 14.8896 1.16065 14.7978C0.397206 14.4272 -0.02963 13.6273 0.00160193 12.743C0.0397743 11.6936 0.275749 10.7103 0.765049 9.7966C1.42439 8.56373 2.36829 7.65741 3.59327 7.07767C3.67309 7.04098 3.7529 7.00428 3.85007 6.95658C2.68061 5.9512 2.17396 4.67062 2.43422 3.10017C2.58691 2.18285 3.03804 1.42698 3.72514 0.847238C5.24163 -0.42967 7.34458 -0.216852 8.60773 1.1738C9.36424 2.00673 9.70779 3.01211 9.61757 4.16426C9.52734 5.31642 9.01375 6.23374 8.14619 6.94924C8.33359 7.04098 8.50363 7.11436 8.6702 7.20609C10.1485 8.006 11.1618 9.24254 11.6997 10.9011C11.9253 11.5945 12.0328 12.3137 11.9912 13.0476C11.9357 14.0163 11.2243 14.8235 10.3151 14.9703C10.2908 14.974 10.2665 14.9886 10.2387 14.9996C7.41051 14.9996 4.58575 14.9996 1.761 14.9996ZM6.00507 13.8475C7.30293 13.8475 8.60079 13.8401 9.89518 13.8512C10.5684 13.8548 10.9571 13.3338 10.9015 12.7577C10.8807 12.5486 10.8773 12.3394 10.846 12.1303C10.6309 10.6185 9.92294 9.41133 8.72225 8.5784C7.17106 7.50331 5.50883 7.3602 3.84313 8.23349C2.05944 9.16916 1.15718 10.7506 1.09125 12.8568C1.08778 13.0072 1.12595 13.1723 1.18494 13.3044C1.36193 13.6934 1.68466 13.8438 2.08026 13.8438C3.392 13.8475 4.70027 13.8475 6.00507 13.8475ZM5.99119 6.53462C7.38969 6.54196 8.53833 5.33843 8.54527 3.85238C8.55221 2.37733 7.41745 1.16647 6.00507 1.15179C4.62046 1.13344 3.45794 2.35531 3.45099 3.8377C3.44405 5.31275 4.58922 6.52728 5.99119 6.53462Z"
                                                    fill="#AE1C9A" />
                                            </svg>
                                        </span>
                                        <span class="text">
                                            By Admin
                                        </span>
                                    </div>
                                    <div class="comments wrapper-item">
                                        <span class="icon">
                                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.73587 12.2092C3.29657 12.1112 2.8914 11.9493 2.52887 11.698C1.55219 11.0206 1.02333 10.0834 1.01053 8.89479C0.989208 7.06292 0.993473 5.23105 1.00627 3.39919C1.02333 1.68235 2.23885 0.297797 3.94059 0.0379278C4.11119 0.0123668 4.29032 0.00384653 4.46518 0.00384653C7.1564 0.00384653 9.84761 -0.000413627 12.5388 0.00384653C14.2064 0.00810668 15.5712 1.10723 15.9167 2.73034C15.9679 2.97317 15.9892 3.22452 15.9892 3.47587C15.9935 5.25236 15.9977 7.0331 15.9935 8.80958C15.9892 10.5136 14.8632 11.8939 13.2042 12.2134C12.9696 12.2603 12.7307 12.2688 12.4919 12.2688C11.2934 12.2731 10.0992 12.2731 8.90078 12.2688C8.77283 12.2688 8.66621 12.2986 8.55958 12.3711C7.33126 13.1933 6.10294 14.0112 4.87462 14.8334C4.71682 14.9399 4.55048 15.0166 4.35429 14.9953C3.9875 14.957 3.7444 14.6843 3.74013 14.3009C3.73587 13.6747 3.74013 13.0442 3.74013 12.4179C3.73587 12.354 3.73587 12.2901 3.73587 12.2092ZM5.09214 13.0442C5.16891 12.9973 5.21582 12.9632 5.26274 12.9334C6.17971 12.3242 7.09669 11.715 8.0094 11.0973C8.20559 10.9652 8.40178 10.9098 8.63635 10.9098C9.94144 10.9141 11.2423 10.9141 12.5474 10.9098C13.7416 10.9056 14.6329 10.0109 14.6329 8.81384C14.6329 7.02458 14.6329 5.23531 14.6329 3.44605C14.6329 2.26173 13.7373 1.36284 12.5516 1.36284C9.85614 1.36284 7.1564 1.36284 4.46092 1.36284C3.27098 1.36284 2.37533 2.26173 2.37533 3.45457C2.37533 5.23957 2.37533 7.02032 2.37533 8.80532C2.37533 9.97261 3.20701 10.8459 4.37562 10.9056C4.84903 10.9311 5.09214 11.1825 5.0964 11.6554C5.09214 12.1069 5.09214 12.5543 5.09214 13.0442Z"
                                                    fill="#AE1C9A" />
                                                <path
                                                    d="M8.48293 5.45638C7.13519 5.45638 5.79171 5.45638 4.44397 5.45638C3.93644 5.45638 3.60377 4.99628 3.77437 4.54044C3.87673 4.26353 4.08998 4.12295 4.38 4.09313C4.43118 4.08887 4.48662 4.08887 4.5378 4.08887C7.17784 4.08887 9.81361 4.08887 12.4536 4.08887C12.5688 4.08887 12.6882 4.09739 12.7991 4.13147C13.1147 4.22945 13.2981 4.5447 13.2512 4.88552C13.2085 5.19651 12.9271 5.44786 12.5944 5.45212C12.2105 5.46064 11.8267 5.45212 11.4471 5.45212C10.4619 5.45638 9.47241 5.45638 8.48293 5.45638Z"
                                                    fill="#AE1C9A" />
                                                <path
                                                    d="M8.483 8.17895C7.58735 8.17895 6.69597 8.18321 5.80458 8.17895C5.3269 8.17469 5.01129 7.78701 5.11792 7.3397C5.18189 7.05853 5.42926 6.84552 5.71928 6.82848C5.76193 6.82422 5.80458 6.82422 5.84723 6.82422C7.61721 6.82422 9.39145 6.82422 11.1614 6.82422C11.5581 6.82422 11.8268 7.02871 11.895 7.37378C11.976 7.78275 11.6818 8.16617 11.2638 8.17895C10.8885 8.19173 10.5089 8.18321 10.1293 8.18321C9.57911 8.17895 9.03319 8.17895 8.483 8.17895Z"
                                                    fill="#AE1C9A" />
                                            </svg>
                                        </span>
                                        <span class="text">
                                            Comments
                                        </span>
                                    </div>
                                </div>
                                <a href="/blogs-details" class="about-details wrapper-details">
                                    Inauguramos nuevos talleres y cursos especializados en robótica
                                </a>
                                <div class="divider"></div>

                                <a href="/blogs-details" class="shop-btn">
                                    Learn More
                                    <span>
                                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.6227 4.38176C12.5587 4.38176 12.4989 4.38176 12.4349 4.38176C8.56302 4.38176 4.69114 4.38176 0.819254 4.38176C0.7168 4.38176 0.614347 4.37785 0.516163 4.40129C0.195996 4.4677 -0.0302552 4.76459 0.00389589 5.05758C0.0423159 5.37791 0.302718 5.60839 0.644229 5.62793C0.712532 5.63183 0.780834 5.63183 0.853405 5.63183C4.71248 5.63183 8.57583 5.63183 12.4349 5.63183C12.4989 5.63183 12.5587 5.63183 12.6654 5.63183C12.5971 5.69824 12.5587 5.73731 12.516 5.77637C11.3805 6.8194 10.2407 7.86243 9.10517 8.90546C8.82342 9.16329 8.79354 9.51878 9.0326 9.77661C9.27166 10.0383 9.68574 10.0774 9.98029 9.86646C10.0272 9.8352 10.0657 9.79614 10.1084 9.75707C11.6494 8.34684 13.1905 6.93269 14.7273 5.51855C15.0987 5.17868 15.0987 4.83882 14.7273 4.49895C13.1777 3.077 11.6238 1.65504 10.0742 0.229172C9.8693 0.0416615 9.63878 -0.0481874 9.35276 0.0260357C8.88319 0.147137 8.70389 0.670605 9.00698 1.01437C9.0454 1.06125 9.09236 1.10032 9.13932 1.14329C10.2663 2.1746 11.389 3.20982 12.5203 4.24113C12.563 4.28019 12.6185 4.29972 12.6654 4.33098C12.6483 4.34269 12.6355 4.36223 12.6227 4.38176Z"
                                                fill="#AE1C9A" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="blogs-wrapper product-wrapper" data-aos="fade-up" data-aos-duration="600">
                            <div class="wrapper-img">
                                <img src="assets/images/homepage-one/about/cut.jpeg" alt="">
                            </div>
                            <div class="wrapper-info">
                                <div class="wrapper-data">
                                    <div class="admin wrapper-item">
                                        <span class="icon">
                                            <svg width="12" height="15" viewBox="0 0 12 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M1.761 14.9996C1.55973 14.9336 1.35152 14.8896 1.16065 14.7978C0.397206 14.4272 -0.02963 13.6273 0.00160193 12.743C0.0397743 11.6936 0.275749 10.7103 0.765049 9.7966C1.42439 8.56373 2.36829 7.65741 3.59327 7.07767C3.67309 7.04098 3.7529 7.00428 3.85007 6.95658C2.68061 5.9512 2.17396 4.67062 2.43422 3.10017C2.58691 2.18285 3.03804 1.42698 3.72514 0.847238C5.24163 -0.42967 7.34458 -0.216852 8.60773 1.1738C9.36424 2.00673 9.70779 3.01211 9.61757 4.16426C9.52734 5.31642 9.01375 6.23374 8.14619 6.94924C8.33359 7.04098 8.50363 7.11436 8.6702 7.20609C10.1485 8.006 11.1618 9.24254 11.6997 10.9011C11.9253 11.5945 12.0328 12.3137 11.9912 13.0476C11.9357 14.0163 11.2243 14.8235 10.3151 14.9703C10.2908 14.974 10.2665 14.9886 10.2387 14.9996C7.41051 14.9996 4.58575 14.9996 1.761 14.9996ZM6.00507 13.8475C7.30293 13.8475 8.60079 13.8401 9.89518 13.8512C10.5684 13.8548 10.9571 13.3338 10.9015 12.7577C10.8807 12.5486 10.8773 12.3394 10.846 12.1303C10.6309 10.6185 9.92294 9.41133 8.72225 8.5784C7.17106 7.50331 5.50883 7.3602 3.84313 8.23349C2.05944 9.16916 1.15718 10.7506 1.09125 12.8568C1.08778 13.0072 1.12595 13.1723 1.18494 13.3044C1.36193 13.6934 1.68466 13.8438 2.08026 13.8438C3.392 13.8475 4.70027 13.8475 6.00507 13.8475ZM5.99119 6.53462C7.38969 6.54196 8.53833 5.33843 8.54527 3.85238C8.55221 2.37733 7.41745 1.16647 6.00507 1.15179C4.62046 1.13344 3.45794 2.35531 3.45099 3.8377C3.44405 5.31275 4.58922 6.52728 5.99119 6.53462Z"
                                                    fill="#AE1C9A" />
                                            </svg>
                                        </span>
                                        <span class="text">
                                            By Admin
                                        </span>
                                    </div>
                                    <div class="comments wrapper-item">
                                        <span class="icon">
                                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.73587 12.2092C3.29657 12.1112 2.8914 11.9493 2.52887 11.698C1.55219 11.0206 1.02333 10.0834 1.01053 8.89479C0.989208 7.06292 0.993473 5.23105 1.00627 3.39919C1.02333 1.68235 2.23885 0.297797 3.94059 0.0379278C4.11119 0.0123668 4.29032 0.00384653 4.46518 0.00384653C7.1564 0.00384653 9.84761 -0.000413627 12.5388 0.00384653C14.2064 0.00810668 15.5712 1.10723 15.9167 2.73034C15.9679 2.97317 15.9892 3.22452 15.9892 3.47587C15.9935 5.25236 15.9977 7.0331 15.9935 8.80958C15.9892 10.5136 14.8632 11.8939 13.2042 12.2134C12.9696 12.2603 12.7307 12.2688 12.4919 12.2688C11.2934 12.2731 10.0992 12.2731 8.90078 12.2688C8.77283 12.2688 8.66621 12.2986 8.55958 12.3711C7.33126 13.1933 6.10294 14.0112 4.87462 14.8334C4.71682 14.9399 4.55048 15.0166 4.35429 14.9953C3.9875 14.957 3.7444 14.6843 3.74013 14.3009C3.73587 13.6747 3.74013 13.0442 3.74013 12.4179C3.73587 12.354 3.73587 12.2901 3.73587 12.2092ZM5.09214 13.0442C5.16891 12.9973 5.21582 12.9632 5.26274 12.9334C6.17971 12.3242 7.09669 11.715 8.0094 11.0973C8.20559 10.9652 8.40178 10.9098 8.63635 10.9098C9.94144 10.9141 11.2423 10.9141 12.5474 10.9098C13.7416 10.9056 14.6329 10.0109 14.6329 8.81384C14.6329 7.02458 14.6329 5.23531 14.6329 3.44605C14.6329 2.26173 13.7373 1.36284 12.5516 1.36284C9.85614 1.36284 7.1564 1.36284 4.46092 1.36284C3.27098 1.36284 2.37533 2.26173 2.37533 3.45457C2.37533 5.23957 2.37533 7.02032 2.37533 8.80532C2.37533 9.97261 3.20701 10.8459 4.37562 10.9056C4.84903 10.9311 5.09214 11.1825 5.0964 11.6554C5.09214 12.1069 5.09214 12.5543 5.09214 13.0442Z"
                                                    fill="#AE1C9A" />
                                                <path
                                                    d="M8.48293 5.45638C7.13519 5.45638 5.79171 5.45638 4.44397 5.45638C3.93644 5.45638 3.60377 4.99628 3.77437 4.54044C3.87673 4.26353 4.08998 4.12295 4.38 4.09313C4.43118 4.08887 4.48662 4.08887 4.5378 4.08887C7.17784 4.08887 9.81361 4.08887 12.4536 4.08887C12.5688 4.08887 12.6882 4.09739 12.7991 4.13147C13.1147 4.22945 13.2981 4.5447 13.2512 4.88552C13.2085 5.19651 12.9271 5.44786 12.5944 5.45212C12.2105 5.46064 11.8267 5.45212 11.4471 5.45212C10.4619 5.45638 9.47241 5.45638 8.48293 5.45638Z"
                                                    fill="#AE1C9A" />
                                                <path
                                                    d="M8.483 8.17895C7.58735 8.17895 6.69597 8.18321 5.80458 8.17895C5.3269 8.17469 5.01129 7.78701 5.11792 7.3397C5.18189 7.05853 5.42926 6.84552 5.71928 6.82848C5.76193 6.82422 5.80458 6.82422 5.84723 6.82422C7.61721 6.82422 9.39145 6.82422 11.1614 6.82422C11.5581 6.82422 11.8268 7.02871 11.895 7.37378C11.976 7.78275 11.6818 8.16617 11.2638 8.17895C10.8885 8.19173 10.5089 8.18321 10.1293 8.18321C9.57911 8.17895 9.03319 8.17895 8.483 8.17895Z"
                                                    fill="#AE1C9A" />
                                            </svg>
                                        </span>
                                        <span class="text">
                                            Comments
                                        </span>
                                    </div>
                                </div>
                                <a href="/blogs-details" class="about-details wrapper-details">
                                    Nuevos servicios de prototipado rápido con corte láser
                                </a>
                                <div class="divider"></div>

                                <a href="/blogs-details" class="shop-btn">
                                    Learn More
                                    <span>
                                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.6227 4.38176C12.5587 4.38176 12.4989 4.38176 12.4349 4.38176C8.56302 4.38176 4.69114 4.38176 0.819254 4.38176C0.7168 4.38176 0.614347 4.37785 0.516163 4.40129C0.195996 4.4677 -0.0302552 4.76459 0.00389589 5.05758C0.0423159 5.37791 0.302718 5.60839 0.644229 5.62793C0.712532 5.63183 0.780834 5.63183 0.853405 5.63183C4.71248 5.63183 8.57583 5.63183 12.4349 5.63183C12.4989 5.63183 12.5587 5.63183 12.6654 5.63183C12.5971 5.69824 12.5587 5.73731 12.516 5.77637C11.3805 6.8194 10.2407 7.86243 9.10517 8.90546C8.82342 9.16329 8.79354 9.51878 9.0326 9.77661C9.27166 10.0383 9.68574 10.0774 9.98029 9.86646C10.0272 9.8352 10.0657 9.79614 10.1084 9.75707C11.6494 8.34684 13.1905 6.93269 14.7273 5.51855C15.0987 5.17868 15.0987 4.83882 14.7273 4.49895C13.1777 3.077 11.6238 1.65504 10.0742 0.229172C9.8693 0.0416615 9.63878 -0.0481874 9.35276 0.0260357C8.88319 0.147137 8.70389 0.670605 9.00698 1.01437C9.0454 1.06125 9.09236 1.10032 9.13932 1.14329C10.2663 2.1746 11.389 3.20982 12.5203 4.24113C12.563 4.28019 12.6185 4.29972 12.6654 4.33098C12.6483 4.34269 12.6355 4.36223 12.6227 4.38176Z"
                                                fill="#AE1C9A" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--------------- latest-news-section-end---------------->