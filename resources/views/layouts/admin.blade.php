<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Wonosofa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,400;0,500;0,600;1,400&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
        body {
            font-family: 'Inter', sans-serif;
            background: #F3EEE6;
        }

        .font-display {
            font-family: 'Fraunces', serif;
        }

        :focus-visible {
            outline: 2px solid #454C31;
            outline-offset: 3px;
        }

        #sidebar {
            transition: transform .25s ease;
        }

        #sidebar-overlay {
            transition: opacity .25s ease;
        }

        .status-pill {
            font-size: .7rem;
            font-weight: 600;
            padding: .2rem .6rem;
            border-radius: 999px;
            white-space: nowrap;
        }
    </style>

    @stack('styles')
</head>

<body class="min-h-screen antialiased text-charcoal-900">

    <div class="min-h-screen lg:flex">

        {{-- Overlay untuk mobile, muncul saat sidebar terbuka --}}
        <div id="sidebar-overlay" class="fixed inset-0 bg-charcoal-900/50 z-30 opacity-0 pointer-events-none lg:hidden"
            onclick="toggleSidebar(false)"></div>

        {{-- Sidebar --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-40 w-72 bg-charcoal-900 text-stone-50 flex flex-col
                   -translate-x-full lg:translate-x-0 lg:static lg:z-0">
            <div class="flex items-center gap-3 px-6 h-20 border-b border-white/10">
                <div class="w-9 h-9 rounded-full bg-clay-400 flex items-center justify-center shrink-0">
                    <span class="font-display italic text-charcoal-900">S</span>
                </div>
                <span class="font-display text-lg tracking-wide">Wonosofa</span>

                <button type="button" onclick="toggleSidebar(false)"
                    class="ml-auto lg:hidden text-stone-50/60 hover:text-stone-50 p-2" aria-label="Tutup menu">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <p class="px-3 mb-2 text-xs uppercase tracking-[0.2em] text-stone-200/40">Menu Utama</p>

                <a href="{{ route('admin.dashboard') }}" @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition',
                    'bg-white/10 text-stone-50 font-medium' => request()->routeIs(
                        'admin.dashboard'),
                    'text-stone-200/70 hover:bg-white/5 hover:text-stone-50' => !request()->routeIs(
                        'admin.dashboard'),
                ])>
                    <i class="fa-solid fa-gauge w-5 text-clay-400"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.produk.index') }}" @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition',
                    'bg-white/10 text-stone-50 font-medium' => request()->routeIs(
                        'admin.produk.*'),
                    'text-stone-200/70 hover:bg-white/5 hover:text-stone-50' => !request()->routeIs(
                        'admin.produk.*'),
                ])>
                    <i class="fa-solid fa-couch w-5"></i>
                    Produk Sofa
                </a>

                {{-- <a href="#" @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition',
                    'bg-white/10 text-stone-50 font-medium' => request()->routeIs(
                        'admin.pesanan.*'),
                    'text-stone-200/70 hover:bg-white/5 hover:text-stone-50' => !request()->routeIs(
                        'admin.pesanan.*'),
                ])>
                    <i class="fa-solid fa-bag-shopping w-5"></i>
                    Pesanan
                </a>

                <a href="#" @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition',
                    'bg-white/10 text-stone-50 font-medium' => request()->routeIs(
                        'admin.pelanggan.*'),
                    'text-stone-200/70 hover:bg-white/5 hover:text-stone-50' => !request()->routeIs(
                        'admin.pelanggan.*'),
                ])>
                    <i class="fa-solid fa-users w-5"></i>
                    Pelanggan
                </a>

                <a href="#" @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition',
                    'bg-white/10 text-stone-50 font-medium' => request()->routeIs(
                        'admin.kategori.*'),
                    'text-stone-200/70 hover:bg-white/5 hover:text-stone-50' => !request()->routeIs(
                        'admin.kategori.*'),
                ])>
                    <i class="fa-solid fa-tags w-5"></i>
                    Kategori &amp; Bahan
                </a>

                <a href="#" @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition',
                    'bg-white/10 text-stone-50 font-medium' => request()->routeIs(
                        'admin.ulasan.*'),
                    'text-stone-200/70 hover:bg-white/5 hover:text-stone-50' => !request()->routeIs(
                        'admin.ulasan.*'),
                ])>
                    <i class="fa-solid fa-star w-5"></i>
                    Ulasan
                </a> --}}

                <p class="px-3 mt-6 mb-2 text-xs uppercase tracking-[0.2em] text-stone-200/40">Pengaturan</p>

                <a href="#" @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition',
                    'bg-white/10 text-stone-50 font-medium' => request()->routeIs(
                        'admin.pengaturan-toko.*'),
                    'text-stone-200/70 hover:bg-white/5 hover:text-stone-50' => !request()->routeIs(
                        'admin.pengaturan-toko.*'),
                ])>
                    <i class="fa-solid fa-gear w-5"></i>
                    Pengaturan Toko
                </a>

                <a href="{{ route('admin.users.index') }}" @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition',
                    'bg-white/10 text-stone-50 font-medium' => request()->routeIs(
                        'admin.users.*'),
                    'text-stone-200/70 hover:bg-white/5 hover:text-stone-50' => !request()->routeIs(
                        'admin.users.*'),
                ])>
                    <i class="fa-solid fa-user-shield w-5"></i>
                    Kelola Akun
                </a>
            </nav>

            <div class="p-4 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-stone-200/70 hover:bg-white/5 hover:text-stone-50 text-sm transition">
                        <i class="fa-solid fa-right-from-bracket w-5"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Konten utama --}}
        <div class="flex-1 min-w-0 flex flex-col">

            {{-- Topbar --}}
            <header
                class="sticky top-0 z-20 flex items-center gap-4 bg-stone-50/90 backdrop-blur border-b border-line px-4 sm:px-8 h-20">
                <button type="button" onclick="toggleSidebar(true)"
                    class="lg:hidden w-10 h-10 rounded-xl border border-line flex items-center justify-center text-charcoal-900"
                    aria-label="Buka menu">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="min-w-0">
                    <p class="text-xs uppercase tracking-[0.2em] text-olive-700">Admin</p>
                    <h1 class="font-display text-xl sm:text-2xl text-charcoal-900 truncate">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="ml-auto flex items-center gap-3 sm:gap-5">
                    <button
                        class="relative w-10 h-10 rounded-xl border border-line flex items-center justify-center text-charcoal-900/70 hover:text-charcoal-900">
                        <i class="fa-regular fa-bell"></i>
                        <span
                            class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-clay-400 text-[10px] text-charcoal-900 flex items-center justify-center font-semibold">3</span>
                    </button>

                    <div class="hidden sm:flex items-center gap-3 pl-4 border-l border-line">
                        <div
                            class="w-9 h-9 rounded-full bg-olive-600 text-stone-50 flex items-center justify-center font-display italic">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="leading-tight">
                            <p class="text-sm font-medium text-charcoal-900">{{ auth()->user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-charcoal-900/50">Administrator</p>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Isi konten halaman --}}
            <main class="flex-1 p-4 sm:p-8 space-y-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar(open) {
            if (open) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0', 'pointer-events-none');
            }
        }

        // Tutup sidebar otomatis saat layar diperbesar ke ukuran desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                overlay.classList.add('opacity-0', 'pointer-events-none');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
