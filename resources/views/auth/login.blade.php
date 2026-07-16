<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Wonosofa</title>

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

        .bg-noise {
            background-image: radial-gradient(#221F1B 0.5px, transparent 0.5px);
            background-size: 18px 18px;
        }
    </style>
</head>

<body class="min-h-screen antialiased text-charcoal-900">

    <div class="min-h-screen grid lg:grid-cols-2">

        {{-- Sisi kiri: panel visual bertema (disembunyikan di layar kecil) --}}
        <div
            class="hidden lg:flex relative flex-col justify-between bg-charcoal-900 text-stone-50 p-12 overflow-hidden">
            <div class="absolute inset-0 bg-noise opacity-[0.06] pointer-events-none"></div>

            <div class="relative z-10 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-clay-400 flex items-center justify-center">
                    <span class="font-display italic text-charcoal-900 text-lg">S</span>
                </div>
                <span class="font-display text-xl tracking-wide">Wonosofa</span>
            </div>

            <div class="relative z-10 max-w-md reveal in">
                <p class="uppercase tracking-[0.25em] text-xs text-clay-300 mb-4">Panel Admin</p>
                <h1 class="font-display text-4xl leading-tight mb-6">
                    Kelola koleksi sofa,<br> pesanan, dan pelanggan<br> dari satu tempat.
                </h1>
                <p class="text-stone-200/70 text-sm leading-relaxed">
                    Masuk untuk mengelola katalog produk, memantau transaksi, dan menjaga pengalaman
                    belanja tetap rapi seperti tampilannya.
                </p>
            </div>

            <div class="relative z-10 flex items-center gap-4">
                <span class="swatch active w-6 h-6 rounded-full bg-clay-400 block"></span>
                <span class="swatch w-6 h-6 rounded-full bg-olive-600 block"></span>
                <span class="swatch w-6 h-6 rounded-full bg-stone-200 block"></span>
                <span class="text-xs text-stone-200/50 ml-2">&copy; {{ date('Y') }} Wonosofa</span>
            </div>
        </div>

        {{-- Sisi kanan: form login --}}
        <div class="flex items-center justify-center p-6 sm:p-12 bg-stone-50">
            <div class="w-full max-w-sm reveal in">

                {{-- Logo mobile --}}
                <div class="flex lg:hidden items-center gap-3 mb-10 justify-center">
                    <div class="w-9 h-9 rounded-full bg-clay-400 flex items-center justify-center">
                        <span class="font-display italic text-charcoal-900">S</span>
                    </div>
                    <span class="font-display text-lg tracking-wide text-charcoal-900">Wonosofa</span>
                </div>

                <p class="uppercase tracking-[0.25em] text-xs text-olive-700 mb-2">Admin</p>
                <h2 class="font-display text-3xl text-charcoal-900 mb-2">Selamat datang kembali</h2>
                <p class="text-sm text-charcoal-900/60 mb-8">Masuk untuk melanjutkan ke dasbor admin.</p>

                {{-- Notifikasi error --}}
                @if ($errors->any())
                    <div
                        class="mb-6 rounded-xl border border-clay-400/40 bg-clay-300/20 px-4 py-3 text-sm text-charcoal-900">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('status'))
                    <div
                        class="mb-6 rounded-xl border border-olive-600/30 bg-olive-600/10 px-4 py-3 text-sm text-olive-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email"
                            class="block text-xs font-medium tracking-wide uppercase text-charcoal-900/70 mb-2">
                            Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            autofocus placeholder="admin@sofahouse.com"
                            class="w-full rounded-xl border border-line bg-white px-4 py-3 text-sm text-charcoal-900 placeholder:text-charcoal-900/30 focus:border-olive-600 focus:ring-1 focus:ring-olive-600 transition">
                        @error('email')
                            <p class="mt-1.5 text-xs text-clay-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password"
                                class="block text-xs font-medium tracking-wide uppercase text-charcoal-900/70">
                                Kata Sandi
                            </label>
                            @if (Route::has('admin.password.request'))
                                <a href="{{ route('admin.password.request') }}"
                                    class="text-xs text-olive-700 hover:text-olive-600 underline underline-offset-2">
                                    Lupa sandi?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <input type="password" name="password" id="password" required placeholder="••••••••"
                                class="w-full rounded-xl border border-line bg-white px-4 py-3 text-sm text-charcoal-900 placeholder:text-charcoal-900/30 focus:border-olive-600 focus:ring-1 focus:ring-olive-600 transition">
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-charcoal-900/40 hover:text-charcoal-900 transition"
                                aria-label="Tampilkan kata sandi">
                                <i id="toggleIcon" class="fa-regular fa-eye text-sm"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-clay-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-center gap-2 text-sm text-charcoal-900/70 cursor-pointer select-none">
                        <input type="checkbox" name="remember"
                            class="rounded border-line text-olive-600 focus:ring-olive-600">
                        Ingat saya
                    </label>

                    <button type="submit"
                        class="w-full rounded-xl bg-charcoal-900 text-stone-50 py-3 text-sm font-medium tracking-wide hover:bg-charcoal-800 transition">
                        Masuk ke Dasbor
                    </button>
                </form>

                <p class="mt-8 text-center text-xs text-charcoal-900/40">
                    Halaman ini khusus untuk administrator Wonosofa.
                    <br>Hubungi tim IT jika Anda mengalami kendala akses.
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.classList.toggle('fa-eye', !isHidden);
            icon.classList.toggle('fa-eye-slash', isHidden);
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.reveal').forEach(el => el.classList.add('in'));
        });
    </script>
</body>

</html>
