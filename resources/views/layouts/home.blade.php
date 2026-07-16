<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Wonosofa — Sofa yang Dibuat untuk Ditinggali')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        stone: {
                            50: '#F3EEE6',
                            100: '#EAE3D6',
                            200: '#D8CFBE'
                        },
                        charcoal: {
                            900: '#221F1B',
                            800: '#2E2A24'
                        },
                        olive: {
                            600: '#59613F',
                            700: '#454C31'
                        },
                        clay: {
                            300: '#D8B996',
                            400: '#C6A177'
                        },
                        line: '#D9D0C1',
                    },
                    fontFamily: {
                        display: ['Fraunces', 'serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #F3EEE6;
        }

        .font-display {
            font-family: 'Fraunces', serif;
        }

        .swatch {
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .swatch:hover {
            transform: translateY(-2px);
        }

        .swatch.active {
            box-shadow: 0 0 0 2px #F3EEE6, 0 0 0 4px #221F1B;
        }

        .marquee-track {
            animation: scroll 26s linear infinite;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(16px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .reveal.in {
            opacity: 1;
            transform: translateY(0);
        }

        @media (prefers-reduced-motion: reduce) {
            .marquee-track {
                animation: none;
            }

            .reveal {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }

        :focus-visible {
            outline: 2px solid #454C31;
            outline-offset: 3px;
        }
    </style>
    @stack('styles')
</head>

<body class="text-charcoal-900 antialiased">

    <!-- NAV -->
    <header class="fixed top-0 inset-x-0 z-50 backdrop-blur bg-stone-50/80 border-b border-line">
        <div class="max-w-7xl mx-auto px-6 md:px-10 h-18 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-display text-2xl tracking-tight">Wonosofa</a>

            <nav class="hidden md:flex items-center gap-9 text-sm text-charcoal-900/70">
                <a href="{{ route('home') }}"
                    class="transition-colors {{ request()->routeIs('home') ? 'text-charcoal-900 font-semibold' : 'hover:text-charcoal-900' }}">
                    Home
                </a>
                <a href="{{ route('produk.index') }}"
                    class="transition-colors {{ request()->routeIs('produk.*') ? 'text-charcoal-900 font-semibold' : 'hover:text-charcoal-900' }}">
                    Products
                </a>
                <a href="{{ route('about') }}"
                    class="transition-colors {{ request()->routeIs('about') ? 'text-charcoal-900 font-semibold' : 'hover:text-charcoal-900' }}">
                    About Us
                </a>
                <a href="{{ route('kontak') }}"
                    class="transition-colors {{ request()->routeIs('kontak') ? 'text-charcoal-900 font-semibold' : 'hover:text-charcoal-900' }}">
                    Contact Us
                </a>
            </nav>

            <a href="{{ route('produk.index') }}"
                class="hidden md:inline-flex text-sm font-medium bg-charcoal-900 text-stone-50 px-5 py-2.5 rounded-full hover:bg-olive-700 transition-colors">
                Lihat Koleksi
            </a>

            <!-- hamburger button (mobile only) -->
            <button id="menu-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu"
                class="md:hidden relative w-10 h-10 flex items-center justify-center">
                <span class="sr-only">Menu</span>
                <span class="hamburger-icon block relative w-5 h-4">
                    <span class="absolute left-0 top-0 w-5 h-px bg-charcoal-900 transition-all duration-300"></span>
                    <span
                        class="absolute left-0 top-1/2 -translate-y-1/2 w-5 h-px bg-charcoal-900 transition-all duration-300"></span>
                    <span class="absolute left-0 bottom-0 w-5 h-px bg-charcoal-900 transition-all duration-300"></span>
                </span>
            </button>
        </div>

        <!-- mobile menu panel -->
        <div id="mobile-menu"
            class="md:hidden max-h-0 overflow-hidden transition-[max-height] duration-300 ease-in-out border-t border-line bg-stone-50">
            <nav class="flex flex-col px-6 py-4 text-base">
                <a href="{{ route('home') }}"
                    class="py-3 border-b border-line {{ request()->routeIs('home') ? 'text-charcoal-900 font-semibold' : 'text-charcoal-900/80' }}">
                    Home
                </a>
                <a href="{{ route('produk.index') }}"
                    class="py-3 border-b border-line {{ request()->routeIs('produk.*') ? 'text-charcoal-900 font-semibold' : 'text-charcoal-900/80' }}">
                    Products
                </a>
                <a href="{{ route('about') }}"
                    class="py-3 border-b border-line {{ request()->routeIs('about') ? 'text-charcoal-900 font-semibold' : 'text-charcoal-900/80' }}">
                    About Us
                </a>
                <a href="{{ route('kontak') }}"
                    class="py-3 {{ request()->routeIs('kontak') ? 'text-charcoal-900 font-semibold' : 'text-charcoal-900/80' }}">
                    Contact Us
                </a>
                <a href="{{ route('produk.index') }}"
                    class="mt-4 mb-2 text-center text-sm font-medium bg-charcoal-900 text-stone-50 px-5 py-3 rounded-full">
                    Lihat Koleksi
                </a>
            </nav>
        </div>
    </header>

    @yield('content')

    <!-- FOOTER -->
    <footer class="px-6 md:px-10 py-12 border-t border-line">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-6">
            <a href="#" class="font-display text-xl">Wonosofa</a>
            <p class="text-sm text-charcoal-900/50">Studio &amp; showroom di Bandung · Pengiriman ke seluruh Indonesia
            </p>
            <div class="flex gap-6 text-sm text-charcoal-900/60">
                <a href="#" class="hover:text-charcoal-900">Instagram</a>
                <a href="#" class="hover:text-charcoal-900">WhatsApp</a>
                <a href="#" class="hover:text-charcoal-900">Email</a>
            </div>
        </div>
        <p class="max-w-7xl mx-auto mt-8 text-xs text-charcoal-900/40">© {{ date('Y') }} Wonosofa Furnitur. Semua
            hak
            dilindungi.
        </p>
    </footer>

    <script>
        // fabric swatch signature interaction
        const nameEl = document.getElementById('fabric-name');
        const heroImage = document.getElementById('hero-sofa-image');
        document.getElementById('swatch-group').addEventListener('click', (e) => {
            const btn = e.target.closest('button.swatch');
            if (!btn) return;
            document.querySelectorAll('.swatch').forEach(s => s.classList.remove('active'));
            btn.classList.add('active');
            nameEl.textContent = btn.dataset.name;

            if (heroImage && btn.dataset.image) {
                heroImage.style.opacity = '0';
                setTimeout(() => {
                    heroImage.src = btn.dataset.image;
                    heroImage.alt = `Sofa ${btn.dataset.name} di ruang tamu minimalis`;
                    heroImage.style.opacity = '1';
                }, 150);
            }
        });

        // mobile menu toggle
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const bars = menuBtn.querySelectorAll('.hamburger-icon span');
        let menuOpen = false;

        function setMenu(open) {
            menuOpen = open;
            menuBtn.setAttribute('aria-expanded', String(open));
            mobileMenu.style.maxHeight = open ? mobileMenu.scrollHeight + 'px' : '0px';
            bars[0].style.transform = open ? 'translateY(6.5px) rotate(45deg)' : '';
            bars[1].style.opacity = open ? '0' : '1';
            bars[2].style.transform = open ? 'translateY(-6.5px) rotate(-45deg)' : '';
        }

        menuBtn.addEventListener('click', () => setMenu(!menuOpen));
        mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => setMenu(false)));
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) setMenu(false);
        });

        // scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15
        });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
    @stack('scripts')
</body>

</html>
