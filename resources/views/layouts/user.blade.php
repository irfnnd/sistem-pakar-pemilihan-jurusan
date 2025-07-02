<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Copyright" content="EduChoice" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="EduChoice System" />
    <meta name="rating" content="general" />
    <meta name="language" content="Indonesian" />
    <meta name="application-name" content="EduChoice" />
    <meta name="description"
        content="Sistem Pakar Pemilihan Jurusan Berdasarkan Minat dan Bakat dengan Forward & Backward Chaining" />
    <meta name="keywords"
        content="sistem pakar, pemilihan jurusan, minat, bakat, forward chaining, backward chaining" />
    <meta name="twitter:title" content="EduChoice | Sistem Pakar Pemilihan Jurusan" />
    <meta name="twitter:description"
        content="Sistem Pakar Pemilihan Jurusan Berdasarkan Minat dan Bakat dengan Forward & Backward Chaining" />
    <meta name="twitter:image" content="./assets/img/educhoice-cover.png" />
    <meta content="EduChoice | Sistem Pakar Pemilihan Jurusan" property="og:title" />
    <meta content="EduChoice" property="og:site_name" />
    <meta content="Sistem Pakar Pemilihan Jurusan Berdasarkan Minat dan Bakat dengan Forward & Backward Chaining"
        property="og:description" />

    <meta name="msapplication-TileColor" content="#3d63dd" />
    <meta name="msapplication-TileImage" content="./assets/favicon/mstile-144x144.png" />
    <meta name="theme-color" content="#3d63dd" />

    <!-- Page title -->
    <title>EduChoice | Sistem Pakar Pemilihan Jurusan</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="194x194" href="./assets/favicon/favicon-194x194.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="./assets/favicon/android-chrome-192x192.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png" />
    <link rel="manifest" href="./assets/favicon/site.webmanifest.json" />
    <link rel="mask-icon" href="./assets/favicon/safari-pinned-tab.svg" color="#3d63dd" />

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.min.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Page loading -->
    <div class="page-loading fixed top-0 bottom-0 left-0 right-0 z-[99999] flex items-center justify-center bg-primary-light-1 dark:bg-primary-dark-1 opacity-100 visible pointer-events-auto"
        role="status" aria-live="polite" aria-atomic="true" aria-label="Loading...">
        <div class="grid-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Navbar -->
    <header
        class="ic-navbar absolute left-0 top-0 z-40 flex w-full items-center  <?= request()->is('konsultasi/*') || request()->is('konsultasi') ? 'bg-primary' : 'bg-transparent' ?> transition-all duration-300 ease-in-out"
        role="banner" aria-label="Navigation bar">
        <div class="container">
            <div class="ic-navbar-container relative -mx-5 flex items-center justify-between">
                <div class="w-60 lg:w-56 max-w-full px-5">
                    <a href="." class="ic-navbar-logo block w-full py-5 text-primary-color">
                        <svg class="w-full fill-current" id="NavbarBrand" data-name="NavbarBrand"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 118.11">
                            <path d="M50,29.77h40v15h-20v30h20v15h-40v-60z" />
                            <path
                                d="M120,29.77h15v45c0,8,5,12,12,12s12-4,12-12v-45h15v45c0,15-10,25-27,25s-27-10-27-25v-45z" />
                            <path
                                d="M200,29.77h25c15,0,25,10,25,22.5s-10,22.5-25,22.5h-10v15h-15v-60zm15,30h10c7,0,10-3,10-7.5s-3-7.5-10-7.5h-10v15z" />
                            <text x="280" y="75" fill="currentColor" font-size="40" font-weight="bold">EduChoice</text>
                        </svg>
                    </a>
                </div>
                <div class="flex w-full items-center justify-between px-5">
                    <div>
                        <button type="button"
                            class="ic-navbar-toggler absolute right-4 top-1/2 block -translate-y-1/2 rounded-md px-3 py-[6px] text-[22px]/none text-primary-color ring-primary focus:ring-2 lg:hidden"
                            data-web-toggle="navbar-collapse" data-web-target="navbarMenu" aria-expanded="false"
                            aria-label="Toggle navigation menu">
                            <i class="lni lni-menu"></i>
                        </button>
                        @php
                            $isLandingPage = request()->routeIs('beranda');
                        @endphp
                        <nav id="navbarMenu"
                            class="ic-navbar-collapse absolute right-4 top-[80px] w-full max-w-[250px] rounded-lg hidden bg-primary-light-1 py-5 shadow-lg dark:bg-primary-dark-1 lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:py-0 lg:shadow-none dark:lg:bg-transparent xl:px-6">
                            <ul class="block lg:flex" role="menu" aria-label="Navigation menu">
                                <li class="group relative">
                                    <a href="{{ $isLandingPage ? '#beranda' : route('beranda') . '#beranda' }}"
                                        class="ic-page-scroll mx-8 flex py-2 {{ request()->routeIs('beranda') ? 'active' : '' }} text-base font-medium text-body-light-12 group-hover:text-primary dark:text-body-dark-12 lg:mx-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-primary-color lg:dark:text-primary-color lg:group-hover:text-primary-color lg:group-hover:opacity-70"
                                        role="menuitem">Beranda</a>
                                </li>

                                <li class="group relative">
                                    <a href="{{ $isLandingPage ? '#about' : route('beranda') . '#about' }}"
                                        class="ic-page-scroll mx-8 flex py-2 text-base font-medium text-body-light-12 group-hover:text-primary dark:text-body-dark-12 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-primary-color lg:dark:text-primary-color lg:group-hover:text-primary-color lg:group-hover:opacity-70"
                                        role="menuitem">Tentang</a>
                                </li>

                                <li class="group relative">
                                    <a href="{{ $isLandingPage ? '#metode' : route('beranda') . '#metode' }}"
                                        class="ic-page-scroll mx-8 flex py-2 text-base font-medium text-body-light-12 group-hover:text-primary dark:text-body-dark-12 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-primary-color lg:dark:text-primary-color lg:group-hover:text-primary-color lg:group-hover:opacity-70"
                                        role="menuitem">Metode</a>
                                </li>

                                <li class="group relative">
                                    <a href="{{ route('konsultasi.index') }}"
                                        class="ic-page-scroll mx-8 flex py-2 text-base {{ request()->routeIs('konsultasi.index') || request()->is('konsultasi/*') ? 'active' : '' }}  font-medium text-body-light-12 group-hover:text-primary dark:text-body-dark-12 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-primary-color lg:dark:text-primary-color lg:group-hover:text-primary-color lg:group-hover:opacity-70"
                                        role="menuitem">Konsultasi</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="flex items-center justify-end pr-[52px] lg:pr-0">
                        <button type="button" class="inline-flex items-center text-primary-color text-[24px]/none"
                            aria-label="Switch theme" data-web-trigger="web-theme"></button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="main relative">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary-dark-2 text-white">
        <div class="w-full border-t border-solid border-alpha-dark"></div>
        <div class="container py-8">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2">
                    <div class="my-1 flex justify-center md:justify-start">
                        <p class="text-body-dark-11">
                            &#169; 2025 EduChoice System. Semua hak dilindungi.
                        </p>
                    </div>
                </div>
            </div>
    </footer>

    <button type="button"
        class="inline-flex w-12 h-12 rounded-md items-center justify-center text-lg/none bg-primary text-primary-color hover:bg-primary-light-10 dark:hover:bg-primary-dark-10 focus:bg-primary-light-10 dark:focus:bg-primary-dark-10 fixed bottom-[117px] right-[20px] hover:-translate-y-1 opacity-100 visible z-50 is-hided"
        data-web-trigger="scroll-top" aria-label="Scroll to top">
        <i class="lni lni-chevron-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        // Scroll Reveal
        const sr = ScrollReveal({
            origin: "bottom",
            distance: "16px",
            duration: 1000,
            reset: false,
        });

        sr.reveal(`.scroll-revealed`, {
            cleanup: true,
        });

        // Testimonial
        const testimonialSwiper = new Swiper(".testimonial-carousel", {
            slidesPerView: 1,
            spaceBetween: 30,

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1280: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    </script>
    @yield('scripts')
</body>

</html>
