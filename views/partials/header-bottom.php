<div class="header-bottom d-lg-block d-none">
    <div class="container">
        <div class="header-nav">

            <!-- Menú de empresas -->
            <div class="category-menu-section position-relative">
                <div class="empty position-fixed" onclick="tooglmenu()"></div>

                <button class="dropdown-btn" onclick="tooglmenu()">
                    <span class="dropdown-icon">
                        <svg width="14" height="9" viewBox="0 0 14 9"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="14" height="1" />
                            <rect y="8" width="14" height="1" />
                            <rect y="4" width="10" height="1" />
                        </svg>
                    </span>

                    <span class="list-text">Empresas</span>
                </button>

                <div class="category-dropdown position-absolute" id="subMenu">
                    <ul class="category-list">

                        <li class="category-list-item">
                            <a href="<?= url('aerial-studio') ?>">
                                <div class="dropdown-item">
                                    <div class="dropdown-list-item">
                                        <span class="dropdown-text">Aerial Studio</span>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="category-list-item">
                            <a href="<?= url('novacut') ?>">
                                <div class="dropdown-item">
                                    <div class="dropdown-list-item">
                                        <span class="dropdown-text">NovaCut</span>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="category-list-item">
                            <a href="<?= url('dopeprints') ?>">
                                <div class="dropdown-item">
                                    <div class="dropdown-list-item">
                                        <span class="dropdown-text">DopePrints</span>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="category-list-item">
                            <a href="<?= url('creatics') ?>">
                                <div class="dropdown-item">
                                    <div class="dropdown-list-item">
                                        <span class="dropdown-text">Creatics</span>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="category-list-item">
                            <a href="<?= url('innovabot') ?>">
                                <div class="dropdown-item">
                                    <div class="dropdown-list-item">
                                        <span class="dropdown-text">Innovabot</span>
                                    </div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- Menú principal -->
            <div class="header-nav-menu">
                <ul class="menu-list">

                    <li>
                        <a href="/">
                            <span class="list-text">Home</span>
                        </a>
                    </li>

                    <li class="mega-menu">
                        <a href="/product-sidebar">
                            <span class="list-text">Servicios</span>
                            <span>
                                <svg width="10" height="10" viewBox="0 0 10 10"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.37811 5.89491C1.88356 5.89491 1.38862 5.90351 0.894066 5.89218C0.443267 5.88202 0.108098 5.59451 0.0178597 5.17027C-0.0641747 4.7851 0.137786 4.36204 0.508895 4.20305C0.659291 4.13859 0.83586 4.11008 1.00071 4.10851C1.93786 4.09992 2.87539 4.10461 3.81254 4.10422C4.07075 4.10422 4.10357 4.07062 4.10396 3.80889C4.10474 2.85847 4.102 1.90843 4.10513 0.958001C4.10669 0.513061 4.336 0.177111 4.71218 0.0501527C5.30752 -0.151027 5.88567 0.278287 5.89387 0.937687C5.90168 1.56232 5.89582 2.18735 5.89582 2.81237C5.89582 3.14441 5.89504 3.47646 5.89621 3.80811C5.897 4.07023 5.92942 4.10422 6.18685 4.10422C7.13728 4.105 8.08732 4.10265 9.03774 4.10539C9.48503 4.10656 9.81941 4.33235 9.94872 4.70776C10.1534 5.30192 9.72605 5.88437 9.06782 5.89413C8.50803 5.90233 7.94825 5.89608 7.38846 5.89608C6.97829 5.89608 6.56851 5.89491 6.15833 5.89687C5.93918 5.89804 5.897 5.94023 5.8966 6.1625C5.89543 7.11918 5.89778 8.07625 5.89543 9.03293C5.89426 9.48216 5.67238 9.81577 5.29736 9.94741C4.70437 10.1552 4.11841 9.72983 4.10669 9.07316C4.09771 8.57861 4.10474 8.08367 4.10474 7.58912C4.10474 7.12035 4.10552 6.65197 4.10435 6.1832C4.10396 5.93398 4.06841 5.89726 3.82387 5.89687C3.34221 5.89569 2.86055 5.89647 2.37889 5.89647Z"
                                        fill="white" />
                                </svg>
                            </span>
                        </a>

                        <div class="shop-menu">
                            <div class="menu-wrapper">

                                <div class="menu-list">
                                    <h5 class="menu-title">Impresión 3D</h5>
                                    <ul>
                                        <li><a href="/product-sidebar">Prototipado Rápido</a></li>
                                        <li><a href="/product-sidebar">Figuras y Coleccionables</a></li>
                                        <li><a href="/product-sidebar">Refacciones y Piezas</a></li>
                                        <li><a href="/product-sidebar">Filamentos y Resinas</a></li>
                                    </ul>
                                </div>

                                <div class="menu-list">
                                    <h5 class="menu-title">Cortadora Láser</h5>
                                    <ul>
                                        <li><a href="/product-sidebar">Grabado en Madera</a></li>
                                        <li><a href="/product-sidebar">Corte en Acrílico</a></li>
                                        <li><a href="/product-sidebar">Letreros y Señalética</a></li>
                                        <li><a href="/product-sidebar">Reconocimientos y Trofeos</a></li>
                                    </ul>
                                </div>

                                <div class="menu-list">
                                    <h5 class="menu-title">Playeras Personalizadas</h5>
                                    <ul>
                                        <li><a href="/product-sidebar">Estampado DTF</a></li>
                                        <li><a href="/product-sidebar">Sublimación</a></li>
                                        <li><a href="/product-sidebar">Vinil Textil</a></li>
                                        <li><a href="/product-sidebar">Playeras para Eventos</a></li>
                                    </ul>
                                </div>

                                <div class="menu-list">
                                    <h5 class="menu-title">Fotografías</h5>
                                    <ul>
                                        <li><a href="/product-sidebar">Fotografía de Producto</a></li>
                                        <li><a href="/product-sidebar">Sesiones de Estudio</a></li>
                                        <li><a href="/product-sidebar">Impresión en Cuadros</a></li>
                                        <li><a href="/product-sidebar">Restauración Digital</a></li>
                                    </ul>
                                </div>

                                <div class="menu-list">
                                    <h5 class="menu-title">Cursos</h5>
                                    <ul>
                                        <li><a href="/product-sidebar">Modelado 3D</a></li>
                                        <li><a href="/product-sidebar">Manejo de Corte Láser</a></li>
                                        <li><a href="/product-sidebar">Técnicas de Estampado</a></li>
                                        <li><a href="/product-sidebar">Fotografía Básica</a></li>
                                    </ul>
                                </div>

                            </div>

                            <div class="shop-menu-img">
                                <img
                                    src="<?= asset('assets/images/homepage-one/empty-wishlist.webp') ?>"
                                    alt="Servicios">
                            </div>
                        </div>
                    </li>

                    <li>
                        <a href="/about">
                            <span class="list-text">Conócenos</span>
                        </a>
                    </li>

                    <li>
                        <a href="/contact-us">
                            <span class="list-text">Contacto</span>
                        </a>
                    </li>

                </ul>
            </div>

            <!-- Botón de proveedores -->
            <div class="header-vendor-btn">
            </div>

        </div>
    </div>
</div>
