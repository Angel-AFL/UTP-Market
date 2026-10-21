<!--------------- blog-tittle-section---------------->
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="/">Home</a></span>
                <span class="devider">/</span>
                <span><a href="#">Dashboard</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">User Dashboard</h1>
            </div>
        </div>
    </section>
    <!--------------- blog-tittle-section-end---------------->

    <!---------------user-profile-section---------------->
    <section class="user-profile footer-padding">
        <div class="container">
            <div class="user-profile-section">
                <div class="dashboard-heading ">
                    <h5 class="dashboard-title">Change Password</h5>
                    <div class="dashboard-switch">
                        <span class="text">Switch Dashboard</span>
                        <span onclick="switchDashboard()" class="switch-icon"></span>
                    </div>
                </div>
                <div class="user-dashboard">
                    <div class="nav nav-item nav-pills  me-3" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">

                        <!-- nav-buttons -->
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">
                            <span>
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.21258 4.98254C9.21258 6.17687 9.20926 7.37119 9.21391 8.56552C9.21723 9.41928 9.69987 9.9079 10.5483 9.90989C12.2512 9.91454 13.9547 9.91454 15.6576 9.90989C16.5007 9.9079 16.9966 9.40799 16.9979 8.56751C16.9999 6.16757 16.9999 3.76763 16.9979 1.36835C16.9973 0.508624 16.4961 0.00340804 15.6423 0.00274416C13.9613 0.000752505 12.2804 0.00141639 10.5994 0.00274416C9.69722 0.00340804 9.2159 0.488044 9.21391 1.40022C9.21059 2.59388 9.21258 3.78821 9.21258 4.98254ZM7.78722 12.0522C7.78722 10.8579 7.78921 9.66359 7.78656 8.46926C7.78456 7.57036 7.31122 7.09104 6.42028 7.08971C4.73933 7.08639 3.05837 7.08705 1.37742 7.08971C0.489805 7.09104 0.00251398 7.57965 0.0018501 8.46395C0.000522332 10.8526 0.000522332 13.2413 0.0018501 15.6299C0.00251398 16.4896 0.503747 16.9969 1.35551 16.9982C3.04775 17.0002 4.73933 17.0002 6.43157 16.9982C7.2913 16.9969 7.78257 16.5036 7.78589 15.6359C7.78988 14.4409 7.78722 13.2466 7.78722 12.0522ZM3.89022 5.66236C4.75261 5.66236 5.61499 5.66767 6.47738 5.66103C7.28665 5.65439 7.77925 5.16444 7.78523 4.35782C7.79253 3.34075 7.79253 2.32302 7.78523 1.30595C7.77925 0.505968 7.27337 0.00473581 6.47339 0.00274416C4.75924 -0.00123915 3.04576 -0.000575264 1.33161 0.00274416C0.519016 0.00407193 0.00516952 0.516591 0.00251398 1.32719C-0.00146932 2.32236 -0.000141552 3.31752 0.00251398 4.31268C0.00450564 5.15648 0.49578 5.65638 1.33626 5.66169C2.18736 5.667 3.03846 5.66236 3.89022 5.66236ZM13.1083 11.3372C12.2459 11.3372 11.3835 11.3319 10.5211 11.3386C9.71248 11.3452 9.21988 11.8358 9.21457 12.6431C9.20793 13.6602 9.20727 14.6779 9.21457 15.695C9.22055 16.493 9.72908 16.9955 10.5271 16.9969C12.2412 17.0008 13.9547 17.0002 15.6689 16.9969C16.4801 16.9955 16.994 16.481 16.9973 15.6704C17.0013 14.6752 16.9999 13.6801 16.9973 12.6849C16.9953 11.8418 16.502 11.3425 15.6622 11.3379C14.8111 11.3333 13.9594 11.3372 13.1083 11.3372Z" />
                                    <path
                                        d="M9.21223 4.98269C9.21223 3.78837 9.21024 2.59404 9.2129 1.39971C9.21489 0.487533 9.69621 0.00289744 10.5984 0.00223355C12.2794 0.000905786 13.9603 0.000241902 15.6413 0.00223355C16.495 0.00356132 16.9963 0.508777 16.9969 1.36784C16.9983 3.76778 16.9989 6.16773 16.9969 8.567C16.9963 9.40748 16.5004 9.90739 15.6566 9.90938C13.9537 9.91402 12.2502 9.91402 10.5473 9.90938C9.69886 9.90672 9.21622 9.41877 9.2129 8.56501C9.20891 7.37135 9.21223 6.17702 9.21223 4.98269Z" />
                                    <path
                                        d="M7.78832 12.0524C7.78832 13.2467 7.79098 14.441 7.78699 15.6353C7.78434 16.503 7.2924 16.9963 6.43267 16.9976C4.74043 16.9996 3.04885 16.9996 1.35661 16.9976C0.504845 16.9963 0.00361284 16.4891 0.00294895 15.6294C0.00162118 13.2407 0.00162118 10.8521 0.00294895 8.4634C0.00361284 7.57911 0.490904 7.09115 1.37852 7.08916C3.05947 7.08651 4.74043 7.08584 6.42138 7.08916C7.31231 7.09115 7.785 7.56981 7.78766 8.46871C7.79031 9.6637 7.78832 10.858 7.78832 12.0524Z" />
                                    <path
                                        d="M3.89062 5.6621C3.03952 5.6621 2.18775 5.66609 1.33665 5.66077C0.496177 5.65613 0.00490302 5.15622 0.00224748 4.31243C-0.000408054 3.31726 -0.00107194 2.3221 0.00224748 1.32694C0.0055669 0.516336 0.519413 0.00381733 1.33201 0.00248957C3.04616 -0.000829855 4.75964 -0.000829855 6.47379 0.00248957C7.27311 0.00448122 7.77965 0.50505 7.78563 1.30569C7.79293 2.32276 7.79293 3.3405 7.78563 4.35757C7.77965 5.16485 7.28771 5.6548 6.47777 5.66077C5.61539 5.66741 4.753 5.6621 3.89062 5.6621Z" />
                                    <path
                                        d="M13.1081 11.3378C13.9592 11.3378 14.811 11.3338 15.6621 11.3391C16.5019 11.3444 16.9952 11.843 16.9972 12.6862C16.9998 13.6813 17.0005 14.6765 16.9972 15.6716C16.9939 16.4822 16.48 16.9968 15.6687 16.9981C13.9546 17.0014 12.2411 17.0014 10.527 16.9981C9.72831 16.9961 9.21977 16.4935 9.21446 15.6962C9.20716 14.6791 9.20716 13.6614 9.21446 12.6443C9.21977 11.837 9.71237 11.3464 10.521 11.3398C11.3834 11.3325 12.2458 11.3378 13.1081 11.3378Z" />
                                </svg>
                            </span>
                            <span class="text">Dashboard</span>
                        </button>

                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                            aria-selected="false">
                            <span>
                                <svg width="14" height="19" viewBox="0 0 14 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.96898 10.7061H3.78814C1.6967 10.7061 0.00346265 12.4028 0 14.4942V18.3481H13.7606V14.4942C13.7571 12.4028 12.0604 10.7061 9.96898 10.7061Z" />
                                    <path
                                        d="M6.88098 9.17603C9.41488 9.17603 11.469 7.12191 11.469 4.58802C11.469 2.05412 9.41488 0 6.88098 0C4.34709 0 2.29297 2.05412 2.29297 4.58802C2.29297 7.12191 4.34709 9.17603 6.88098 9.17603Z" />
                                </svg>
                            </span>
                            <span class="text">
                                Parsonal Info
                            </span>
                        </button>

                        <button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment"
                            aria-selected="false">
                            <span>
                                <svg width="17" height="12" viewBox="0 0 17 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.7405 0.0107422H3.61054C1.81171 0.0136959 0.352563 1.46989 0.349609 3.27167H15.9985C15.9985 1.47284 14.5394 0.0136959 12.7405 0.0107422Z" />
                                    <path
                                        d="M0.349609 8.48814C0.352563 10.287 1.80876 11.7461 3.61054 11.7491H12.7405C14.5394 11.7461 15.9985 10.2899 16.0015 8.48814V4.57739H0.349609V8.48814ZM4.91314 8.16323C4.91314 8.70377 4.47598 9.14092 3.93545 9.14092C3.39492 9.14092 2.95776 8.70377 2.95776 8.16323C2.95776 7.6227 3.39492 7.18554 3.93545 7.18554C4.47598 7.18554 4.91314 7.6227 4.91314 8.16323Z" />
                                </svg>

                            </span>
                            <span class="text">
                                Payment Method
                            </span>
                        </button>

                        <!-- NUEVO APARTADO: Product CRUD -->
                        <button class="nav-link" id="v-pills-products-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-products" type="button" role="tab" aria-controls="v-pills-products"
                            aria-selected="false">
                            <span>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 4.5V13.5C14 14.0523 13.5523 14.5 13 14.5H3C2.44772 14.5 2 14.0523 2 13.5V4.5C2 3.94772 2.44772 3.5 3 3.5H13C13.5523 3.5 14 3.94772 14 4.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 3.5V2.5C5 1.94772 5.44772 1.5 6 1.5H10C10.5523 1.5 11 1.94772 11 2.5V3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text">
                                Manage Products
                            </span>
                        </button>

                        <button class="nav-link" id="v-pills-order-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-order" type="button" role="tab" aria-controls="v-pills-order"
                            aria-selected="false">
                            <span>
                                <svg width="15" height="18" viewBox="0 0 15 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.9643 15.8454C10.8728 15.8399 10.8054 15.8331 10.7381 15.8331C9.37517 15.8324 8.01229 15.8324 6.60539 15.8324C6.85294 16.5145 6.77799 17.099 6.11648 17.4676C5.68672 17.7076 5.24457 17.6615 4.86018 17.3562C4.36027 16.9594 4.3087 16.4409 4.56175 15.8317C3.82667 15.8317 3.13285 15.8406 2.43903 15.8296C1.53136 15.8152 0.910425 14.8958 1.25974 14.0638C1.34845 13.852 1.51898 13.6581 1.69295 13.502C2.43628 12.8384 3.19199 12.1872 3.95182 11.5429C4.11204 11.4075 4.16499 11.2816 4.11479 11.074C3.36389 7.96037 2.61506 4.8454 1.87999 1.72768C1.82085 1.476 1.71564 1.42512 1.48597 1.432C0.997754 1.44712 0.507472 1.43681 0 1.43681C0 1.06824 0 0.741614 0 0.390921C0.782525 0.390921 1.54786 0.377856 2.31182 0.397798C2.58825 0.405362 2.70308 0.630905 2.76772 0.885329C3.01389 1.86177 3.27725 2.83339 3.5138 3.81189C3.57775 4.07732 3.68846 4.22034 3.96901 4.19971C3.98001 4.19903 3.9917 4.20315 4.00339 4.20315C4.60369 4.21003 4.95026 4.4507 5.25488 5.03863C6.60195 7.64613 10.1907 7.96587 12.0686 5.68981C12.2206 5.50622 12.3512 5.44639 12.585 5.4904C13.0911 5.58529 13.6027 5.64855 14.1136 5.71801C14.333 5.74826 14.4306 5.85416 14.4251 6.08314C14.3839 7.93906 14.3461 9.79498 14.3144 11.6509C14.3089 11.9816 14.0937 11.9665 13.8661 11.9665C11.0819 11.9651 8.29697 11.9693 5.51274 11.9596C5.2425 11.959 5.03897 12.0291 4.8368 12.2072C4.05428 12.8962 3.25525 13.5659 2.47135 14.2536C2.37095 14.3416 2.32488 14.4908 2.25337 14.6111C2.38264 14.6552 2.51192 14.737 2.64119 14.737C6.60608 14.7439 10.571 14.7425 14.5358 14.7425C14.6823 14.7425 14.8288 14.7425 15 14.7425C15 15.1152 15 15.4514 15 15.8193C14.3426 15.8193 13.6935 15.8193 13.0127 15.8193C13.25 16.4568 13.2156 17.0055 12.6442 17.4064C12.2536 17.68 11.7406 17.6814 11.3521 17.4091C10.78 17.011 10.7339 16.4636 10.9643 15.8454Z" />
                                    <path
                                        d="M8.8449 6.1337C7.15883 6.12476 5.787 4.74744 5.78906 3.06549C5.79113 1.37254 7.18564 -0.00685072 8.88753 2.55979e-05C10.5702 0.00690192 11.9413 1.38835 11.9392 3.07374C11.9372 4.77563 10.555 6.14264 8.8449 6.1337ZM9.94924 1.61802C9.38194 2.22039 8.85178 2.78287 8.31199 3.35636C8.11326 3.12806 7.94342 2.93278 7.76394 2.72786C7.48201 2.96853 7.22553 3.1872 6.95735 3.41618C7.28191 3.80125 7.57484 4.16708 7.8884 4.51502C8.10157 4.75225 8.43232 4.77082 8.65236 4.54458C9.33656 3.83907 10.0042 3.11775 10.6382 2.44593C10.4031 2.16332 10.1858 1.9027 9.94924 1.61802Z" />
                                </svg>
                            </span>
                            <span class="text">
                                Order
                            </span>
                        </button>

                        <button class="nav-link" id="v-pills-wishlist-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-wishlist" type="button" role="tab" aria-controls="v-pills-wishlist"
                            aria-selected="false">
                            <span>
                                <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_113_3017)">
                                        <path
                                            d="M8.00893 1.94252C8.25673 1.67321 8.45526 1.43486 8.67664 1.22099C10.387 -0.427293 13.0628 -0.40281 14.7246 1.2714C16.3985 2.95785 16.4356 5.687 14.7674 7.39721C12.6907 9.52652 10.5848 11.6263 8.48882 13.7369C8.13819 14.0897 7.85825 14.0876 7.50619 13.7326C5.4188 11.6306 3.32426 9.53588 1.25187 7.41953C-0.424185 5.70788 -0.410617 2.98738 1.25258 1.293C2.92721 -0.413611 5.62304 -0.434494 7.35265 1.24836C7.56475 1.4543 7.76042 1.67825 8.00893 1.94252Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_113_3017">
                                            <rect width="16" height="14" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            <span class="text">
                                Wishlist
                            </span>
                        </button>

                        <button class="nav-link" id="v-pills-address-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-address" type="button" role="tab" aria-controls="v-pills-address"
                            aria-selected="false">
                            <span>
                                <svg width="14" height="20" viewBox="0 0 14 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.864 15.9822C11.4632 12.6506 9.25877 11.1118 7.04363 11.0545C5.70166 11.0223 4.5422 11.5126 3.57598 12.4609C2.60976 13.4057 2.19465 14.5938 1.99067 16.0288C1.37873 15.7461 0.809733 15.5063 0.272945 15.2128C0.147695 15.1449 0.0582333 14.8944 0.0582333 14.7262C0.0439189 13.5631 -0.0849134 12.3822 0.0940158 11.2478C0.365988 9.54079 1.99067 8.23819 3.71555 8.05568C4.60661 7.96264 5.46547 7.9519 6.35296 8.1702C6.88617 8.3026 7.51243 8.19167 8.06711 8.05926C10.2357 7.52963 13.1559 8.64973 13.7571 10.9973C14.0577 12.1675 14.0577 13.3663 13.8751 14.5615C13.8107 14.9981 13.6068 15.3202 13.1737 15.4812C12.7336 15.6387 12.3042 15.8105 11.864 15.9822Z" />
                                    <path
                                        d="M10.6071 3.72194C10.5928 5.77962 8.96814 7.38999 6.93193 7.36494C4.8814 7.33989 3.24241 5.7009 3.26388 3.69331C3.28535 1.59984 4.90287 -0.0212607 6.94982 0.000210833C9.01824 0.0181038 10.6215 1.64994 10.6071 3.72194Z" />
                                    <path
                                        d="M10.9467 16.0178C10.9109 18.2795 9.07512 19.9972 6.74188 19.9507C4.58041 19.9077 2.77681 18.0719 2.80902 15.9498C2.8448 13.7454 4.69493 11.9776 6.9387 12.0062C9.17174 12.0384 10.9789 13.8492 10.9467 16.0178Z"
                                        fill="white" />
                                </svg>
                            </span>
                            <span class="text">
                                Address
                            </span>
                        </button>

                        <button class="nav-link" id="v-pills-review-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-review" type="button" role="tab" aria-controls="v-pills-review"
                            aria-selected="false">
                            <span>
                                <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_113_3028)">
                                        <path
                                            d="M9.2481 10.6955C9.42603 10.6955 9.5544 10.6955 9.68504 10.6955C10.8044 10.6955 11.9238 10.6933 13.0431 10.6955C14.2729 10.7 14.8224 11.6158 14.2413 12.6692C14.2008 12.7401 14.2053 12.8665 14.2413 12.9419C14.4801 13.4365 14.4328 13.8888 14.104 14.3301C14.0454 14.41 14.0274 14.563 14.0612 14.6606C14.2278 15.1462 14.1625 15.5764 13.8382 15.9822C13.7706 16.0665 13.7436 16.2328 13.7751 16.3392C14.0341 17.1974 13.4756 17.9825 12.5612 17.9869C10.4418 17.9958 8.32242 17.9913 6.20305 17.9891C5.67603 17.9891 5.63549 17.9403 5.63549 17.4325C5.63549 15.0752 5.63098 12.718 5.6445 10.3629C5.64675 10.1633 5.72783 9.92604 5.8517 9.76859C6.6445 8.78178 7.16251 7.68408 7.35396 6.43781C7.48459 5.58404 8.0026 5.35563 8.74585 5.82354C9.45305 6.26927 9.71206 6.9545 9.76161 7.7373C9.81792 8.60437 9.61747 9.43596 9.37422 10.2609C9.34044 10.3851 9.30441 10.507 9.2481 10.6955Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_113_3028">
                                            <rect width="16" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            <span class="text">
                                Reviews
                            </span>
                        </button>

                        <button class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password"
                            aria-selected="false">
                            <span>
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.9919 6.43707V5.3498C12.9919 2.39616 10.5957 0 7.64208 0C4.68844 0 2.29227 2.39616 2.29227 5.3498V6.43707C0.900288 7.04304 0 8.41771 0 9.93435V14.5224C0.00346265 16.6311 1.71054 18.3417 3.82276 18.3451H11.4683C13.5771 18.3417 15.2876 16.6346 15.2911 14.5224V9.93781C15.2807 8.41771 14.3804 7.0465 12.9919 6.43707ZM8.40386 12.9953C8.40386 13.4178 8.06106 13.7606 7.63861 13.7606C7.21617 13.7606 6.87337 13.4178 6.87337 12.9953V11.4648C6.87337 11.0424 7.21617 10.6996 7.63861 10.6996C8.06106 10.6996 8.40386 11.0424 8.40386 11.4648V12.9953ZM11.4614 6.11505H3.81584V5.3498C3.81584 3.23758 5.52639 1.52703 7.63861 1.52703C9.75083 1.52703 11.4614 3.23758 11.4614 5.3498V6.11505Z" />
                                </svg>
                            </span>
                            <span class="text">
                                Change Password
                            </span>
                        </button>

                        <button class="nav-link" id="v-pills-ticket-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-ticket" type="button" role="tab" aria-controls="v-pills-ticket"
                            aria-selected="false">
                            <span>
                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.25959 11.7769C4.29097 12.7964 3.80544 13.2903 2.96997 15.1301C2.40643 14.5916 1.85349 14.0636 1.28388 13.519C1.61565 12.979 1.93756 12.4548 2.25872 11.9299C2.47914 11.5686 2.211 10.8982 1.80349 10.7967C1.20511 10.6483 0.605962 10.5051 0 10.3574C0 9.20229 0 8.06763 0 6.88903C0.588541 6.74739 1.18466 6.6065 1.77926 6.46031C2.21555 6.35276 2.48672 5.68923 2.25342 5.30671C1.93832 4.79089 1.62095 4.27582 1.31645 3.77969C2.14359 2.95179 2.95331 2.14283 3.78499 1.31191C4.28491 1.61868 4.80982 1.94211 5.33701 2.26327C5.67787 2.47081 6.35276 2.20116 6.44819 1.81713C6.59741 1.21798 6.73981 0.616567 6.88979 0C8.04263 0 9.18639 0 10.3627 0C10.5013 0.579451 10.6407 1.16496 10.7831 1.74972C10.8967 2.21555 11.5489 2.48975 11.9526 2.24206C12.4677 1.9262 12.9812 1.61034 13.4698 1.31039C14.2962 2.13677 15.0983 2.93892 15.936 3.77742C15.6391 4.26294 15.318 4.78559 14.9983 5.30974C14.7658 5.69074 15.04 6.35048 15.4778 6.45804C16.0641 6.60196 16.6526 6.74057 17.2502 6.88449C17.2502 8.04718 17.2502 9.1932 17.2502 10.3627C16.6943 10.4945 16.1428 10.624 15.5922 10.7551C14.9923 10.8982 14.7362 11.508 15.0559 12.0283C15.3521 12.5108 15.6475 12.9941 15.955 13.4948C15.4286 14.0583 14.9165 14.606 14.3689 15.1915C13.7614 13.5281 12.6692 12.4101 11.0634 11.7935C13.1335 9.92414 12.6858 7.32608 11.2823 6.01266C9.77341 4.60001 7.41092 4.6394 5.95055 6.11037C4.57047 7.50105 4.29248 10.0234 6.25959 11.7769Z" />
                                </svg>
                            </span>
                            <span class="text">
                                Support Ticket
                            </span>
                        </button>

                        <div class="nav-link">
                            <a href="/login">
                                <span>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.50224 15.7537C7.50224 16.0247 7.50895 16.2465 7.5 16.4683C7.4597 17.5682 6.52164 18.2515 5.4806 17.9155C4.00075 17.4383 2.52761 16.9387 1.05448 16.4392C0.380597 16.2107 0 15.6641 0 14.9405C0 10.4892 0 6.03569 0.00223881 1.58218C0.00223881 0.627852 0.629104 0.00955666 1.59403 0.00731646C4.28731 0.00283606 6.98284 -0.00164434 9.67612 0.000595862C11.0104 0.00283606 11.9798 0.961641 12 2.29904C12.0112 2.99126 12.0067 3.68124 12 4.37347C11.9955 4.90439 11.6933 5.25162 11.2478 5.25162C10.8022 5.25386 10.4955 4.90663 10.491 4.37571C10.4843 3.69693 10.4933 3.0159 10.4888 2.33712C10.4843 1.79276 10.209 1.50153 9.67388 1.49705C8.72463 1.48585 7.77761 1.49481 6.82836 1.49481C6.72313 1.49481 6.61791 1.49481 6.46791 1.49481C6.51492 1.55081 6.53284 1.59114 6.56418 1.60682C7.24254 1.91597 7.51119 2.46481 7.51119 3.1884C7.50672 6.72791 7.50895 10.2674 7.50895 13.8069C7.50895 13.9436 7.50895 14.0802 7.50895 14.2415C8.32164 14.2415 9.09179 14.2662 9.8597 14.2303C10.2649 14.2124 10.4888 13.8898 10.491 13.4396C10.4978 12.5031 10.4955 11.5645 10.4933 10.6259C10.4933 10.2854 10.594 10.0008 10.9119 9.83507C11.3888 9.58865 11.9754 9.89332 11.9888 10.4511C12.0179 11.5511 12.0493 12.6577 11.9664 13.7532C11.8746 14.9494 10.9052 15.7447 9.69403 15.7514C8.97537 15.7559 8.26343 15.7537 7.50224 15.7537Z" />
                                    </svg>
                                </span>
                                <span class="text">
                                    Logout
                                </span>
                            </a>
                        </div>

                    </div>

                    <!-- nav-content -->
                    <div class="tab-content nav-content" id="v-pills-tabContent" style="flex: 1 0%;">

                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab" tabindex="0">
                            <!-- [Contenido de Home omitido por brevedad, se mantiene igual] -->
                        </div>

                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <!-- [Contenido de Profile omitido por brevedad, se mantiene igual] -->
                        </div>

                        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel"
                            aria-labelledby="v-pills-order-tab" tabindex="0">
                            <!-- [Contenido de Payment omitido por brevedad, se mantiene igual] -->
                        </div>

                        <!-- NUEVA VISTA / TAB-PANE PARA CRUD DE PRODUCTOS -->
                        <div class="tab-pane fade" id="v-pills-products" role="tabpanel"
    aria-labelledby="v-pills-products-tab" tabindex="0">
    <div class="cart-section">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="heading">Product Management </h5>
            <button type="button" class="shop-btn" data-ap-open>Add New Product</button>
        </div>
        <?php include __DIR__ . '/agregar_producto.php'; ?>


<!-- Filtros independientes: búsqueda por nombre y categoría visual -->
<section class="filtros-productos" id="filtros-busqueda-productos">

    <div class="filtro-campo filtro-busqueda">
        <label for="buscar-producto">
            <span aria-hidden="true">⌕</span>
            Buscar producto por nombre
        </label>

        <input
            type="search"
            id="buscar-producto"
            class="control-filtro"
            placeholder="Escribe el nombre del producto..."
            autocomplete="off"
        >
    </div>

    <div class="filtro-campo filtro-categoria">
        <label for="categoria-producto">
            <span aria-hidden="true">◇</span>
            Categoría
        </label>

        <select id="categoria-producto" class="control-filtro">
            <option value="">Todas las categorías</option>
        </select>
    </div>

    <p id="mensaje-busqueda-productos"
       class="mensaje-filtro"
       role="status"
       aria-live="polite">
        Escribe un nombre para buscar productos.
    </p>

</section>

<style>
    .filtros-productos {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(220px, 1fr);
        gap: 22px;
        padding: 24px;
        margin: 22px 0;
        background: #f8f9ff;
        border: 1px solid #e5e9fb;
        border-radius: 18px;
        box-sizing: border-box;
    }

    .filtro-campo {
        display: flex;
        flex-direction: column;
        gap: 10px;
        min-width: 0;
    }

    .filtro-campo label {
        color: #564d24;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: .1px;
    }

    .filtro-campo label span {
        color: #b67f1a;
        margin-right: 7px;
        font-size: 19px;
    }

    .control-filtro {
        width: 100%;
        min-height: 49px;
        padding: 12px 15px;
        background: #fff;
        border: 1px solid #dce2f2;
        border-radius: 12px;
        color: #615724;
        font: inherit;
        font-size: 14px;
        outline: none;
        box-sizing: border-box;
        transition: border-color .2s, box-shadow .2s;
    }

    .control-filtro::placeholder {
        color: #929bb0;
    }

    .control-filtro:focus {
        border-color: #f1bb63;
        box-shadow: 0 0 0 4px rgba(154, 112, 45, 0.12);
    }

    .mensaje-filtro {
        grid-column: 1 / -1;
        margin: 0;
        padding: 12px 15px;
        border-radius: 10px;
        background: #edf2ff;
        color: #8d7b52;
        font-size: 13px;
        line-height: 1.5;
    }

    @media (max-width: 650px) {
        .filtros-productos {
            grid-template-columns: 1fr;
            padding: 16px;
            gap: 16px;
        }

        .mensaje-filtro {
            grid-column: auto;
        }
    }
</style>

                                <!-- Modal para Crear/Editar Producto -->
                                <div class="modal-wrapper product-modal">
                                    <div onclick="modalAction('.product-modal')" class="anywhere-away"></div>
                                    <div class="login-section account-section modal-main">
                                        <div class="review-form">
                                            <div class="review-content">
                                                <h5 class="comment-title">Product Details</h5>
                                                <div class="close-btn">
                                                    <img src="assets/images/homepage-one/close-btn.png"
                                                        onclick="modalAction('.product-modal')" alt="close-btn">
                                                </div>
                                            </div>
                                            <div class="review-form-name address-form">
                                                <label for="prodname" class="form-label">Product Name*</label>
                                                <input type="text" id="prodname" class="form-control" placeholder="Enter product name">
                                            </div>
                                            <div class="account-inner-form">
                                                <div class="review-form-name">
                                                    <label for="prodprice" class="form-label">Price ($)*</label>
                                                    <input type="number" id="prodprice" class="form-control" placeholder="0.00">
                                                </div>
                                                <div class="review-form-name">
                                                    <label for="prodstock" class="form-label">Stock*</label>
                                                    <input type="number" id="prodstock" class="form-control" placeholder="0">
                                                </div>
                                            </div>
                                            <div class="review-form-name address-form">
                                                <label for="proddesc" class="form-label">Description*</label>
                                                <textarea id="proddesc" cols="10" rows="3" class="form-control" placeholder="Write product description"></textarea>
                                            </div>
                                            <div class="login-btn text-center">
                                                <a href="#" onclick="modalAction('.product-modal')" class="shop-btn">Save Product</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tabla de Productos (CRUD List) -->
                                <table>
                                    <tbody>
                                        <tr class="table-row table-top-row">
                                            <td class="table-wrapper wrapper-product">
                                                <h5 class="table-heading">PRODUCT</h5>
                                            </td>
                                            <td class="table-wrapper">
                                                <div class="table-wrapper-center">
                                                    <h5 class="table-heading">PRICE</h5>
                                                </div>
                                            </td>
                                            <td class="table-wrapper">
                                                <div class="table-wrapper-center">
                                                    <h5 class="table-heading">STOCK</h5>
                                                </div>
                                            </td>
                                            <td class="table-wrapper wrapper-total">
                                                <div class="table-wrapper-center">
                                                    <h5 class="table-heading">STATUS</h5>
                                                </div>
                                            </td>
                                            <td class="table-wrapper">
                                                <div class="table-wrapper-center">
                                                    <h5 class="table-heading">ACTIONS</h5>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="table-row ticket-row">
                                            <td class="table-wrapper wrapper-product">
                                                <div class="wrapper">
                                                    <div class="wrapper-img">
                                                        <img src="assets/images/homepage-one/product-img/product-img-1.webp" alt="img">
                                                    </div>
                                                    <div class="wrapper-content">
                                                        <h5 class="heading">Classic Design Skirt</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="table-wrapper">
                                                <div class="table-wrapper-center">
                                                    <h5 class="heading">$20.00</h5>
                                                </div>
                                            </td>
                                            <td class="table-wrapper">
                                                <div class="table-wrapper-center">
                                                    <h5 class="heading">15</h5>
                                                </div>
                                            </td>
                                            <td class="table-wrapper wrapper-total">
                                                <div class="table-wrapper-center">
                                                    <h5 class="heading" style="color: #27AE60;">Active</h5>
                                                </div>
                                            </td>
                                            <td class="table-wrapper">
                                                <div class="table-wrapper-center" style="display: flex; gap: 10px; justify-content: center;">
                                                    <a href="#" onclick="modalAction('.product-modal')" title="Edit">
                                                        <svg width="14" height="14" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 2L16 7M2 16H7L16.5 6.5C17.3284 5.67157 17.3284 4.32843 16.5 3.5V3.5C15.6716 2.67157 14.3284 2.67157 13.5 3.5L4 13V16H2V14Z" stroke="#2D3748" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    </a>
                                                    <a href="#" title="Delete">
                                                        <svg width="14" height="14" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.7879 5.95508C14.7102 6.91333 14.6353 7.84896 14.5582 8.7853C14.3801 10.9315 14.2028 13.0776 14.0219 15.2238C13.9604 15.9503 13.9208 16.6802 13.8176 17.4018C13.7074 18.1756 13.0827 18.719 12.3039 18.7225C9.39528 18.7352 6.48733 18.7367 3.57867 18.7218C2.71582 18.7176 2.09748 18.0823 2.01904 17.158C1.79291 14.4959 1.58161 11.8332 1.36254 9.17114C1.28269 8.19735 1.19859 7.22426 1.11733 6.25117C1.10955 6.15931 1.10673 6.06744 1.10107 5.95578C5.66688 5.95508 10.2171 5.95508 14.7879 5.95508Z" fill="#EB5757"/></svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Demás pestañas existentes continúan aquí -->
                        <div class="tab-pane fade" id="v-pills-order" role="tabpanel">...</div>
                        <div class="tab-pane fade" id="v-pills-wishlist" role="tabpanel">...</div>
                        <div class="tab-pane fade" id="v-pills-address" role="tabpanel">...</div>
                        <div class="tab-pane fade" id="v-pills-review" role="tabpanel">...</div>
                        <div class="tab-pane fade" id="v-pills-password" role="tabpanel">...</div>
                        <div class="tab-pane fade" id="v-pills-ticket" role="tabpanel">...</div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--------------- user-profile-section-end --------------->