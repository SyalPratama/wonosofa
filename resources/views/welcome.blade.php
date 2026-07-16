@extends('layouts.home')

@section('title', $title ?? 'Wonosofa — Sofa yang Dibuat untuk Ditinggali')

@push('styles')
    <style>
        .marquee-track {
            animation: marquee-scroll 25s linear infinite alternate;
        }

        @keyframes marquee-scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(calc(-50% - 1.25rem));
            }
        }
    </style>
@endpush
@section('content')

    <!-- HERO -->
    <section id="home" class="pt-32 md:pt-40 pb-16 px-6 md:px-10">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-6">Sofa custom · Dibuat di
                    Indonesia</p>
                <h1 class="font-display text-5xl md:text-6xl leading-[1.05] tracking-tight">
                    Ruang duduk<br>
                    yang <em class="not-italic text-olive-700">terasa</em><br>
                    seperti rumah.
                </h1>
                <p class="mt-6 text-charcoal-900/70 text-lg max-w-md leading-relaxed">
                    Setiap sofa dijahit tangan dan dilapisi kain pilihan Anda sendiri —
                    dari boucle hangat sampai linen sejuk. Datang tanpa bentuk baku, pulang sesuai ruangmu.
                </p>
                <div class="mt-9 flex items-center gap-5">
                    <a href="#koleksi"
                        class="inline-flex items-center gap-2 bg-charcoal-900 text-stone-50 px-7 py-3.5 rounded-full text-sm font-medium hover:bg-olive-700 transition-colors">
                        Mulai Rancang Sofa
                    </a>
                    <a href="#kain"
                        class="text-sm font-medium border-b border-charcoal-900/30 hover:border-charcoal-900 pb-0.5 transition-colors">Lihat
                        pilihan kain</a>
                </div>
                <div class="mt-12 flex items-center gap-8 text-sm text-charcoal-900/60">
                    <div><span class="font-display text-2xl text-charcoal-900">12</span> pilihan kain</div>
                    <div class="w-px h-8 bg-line"></div>
                    <div><span class="font-display text-2xl text-charcoal-900">7 thn</span> garansi rangka</div>
                    <div class="w-px h-8 bg-line"></div>
                    <div><span class="font-display text-2xl text-charcoal-900">30 hr</span> uji coba</div>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-3xl overflow-hidden bg-stone-200 aspect-[4/5] md:aspect-[5/6]">
                    <img id="hero-sofa-image" src="{{ $fabrics[0]['image'] ?? asset('assets/img/home/sofa_white.webp') }}"
                        alt="Sofa {{ $fabrics[0]['name'] ?? 'linen krem' }} di ruang tamu minimalis"
                        class="w-full h-full object-cover opacity-100 transition-opacity duration-300">
                </div>

                <!-- badge: nama produk -->
                <div class="absolute top-5 right-5 bg-stone-50/90 backdrop-blur border border-line rounded-full px-4 py-2">
                    <p id="hero-product-name" class="text-sm font-medium text-charcoal-900">
                        {{ $product->name ?? '' }}
                    </p>
                </div>

                <!-- signature: fabric swatch picker -->
                <div
                    class="absolute -bottom-8 left-6 right-6 md:left-8 md:right-auto md:w-64 bg-stone-50 border border-line rounded-2xl p-5 shadow-[0_12px_40px_-12px_rgba(34,31,27,0.25)]">
                    <p class="text-xs uppercase tracking-widest text-charcoal-900/50 mb-1">Sedang dilihat</p>
                    <div class="flex gap-2.5" id="swatch-group">
                        @forelse (($fabrics ?? []) as $i => $fabric)
                            <button data-name="{{ $fabric['name'] }}" data-image="{{ $fabric['image'] }}"
                                class="swatch w-12 h-12 rounded-lg bg-cover bg-center border-2 @if ($i === 0) active border-charcoal-900 @else border-transparent @endif"
                                style="background-image:url('{{ $fabric['image'] }}')"
                                aria-label="Pilih tampilan {{ $fabric['name'] }}"></button>
                        @empty
                            <button data-name="Linen Krem Alami" data-image="{{ asset('assets/img/home/sofa_white.webp') }}"
                                class="swatch active w-12 h-12 rounded-lg bg-cover bg-center border-2 border-charcoal-900"
                                style="background-image:url('{{ asset('assets/img/home/sofa_white.webp') }}')"
                                aria-label="Pilih tampilan Linen Krem Alami"></button>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MATERIAL MARQUEE DIVIDER -->
    <div class="mt-16 border-y border-line bg-stone-100 overflow-hidden">
        <div
            class="marquee-track flex whitespace-nowrap py-4 text-2xl md:text-3xl font-display text-charcoal-900/25 gap-10 w-max">
            <span class="flex gap-10">
                <span>Boucle</span><span>·</span><span>Linen</span><span>·</span><span>Beludru</span><span>·</span><span>Wol</span><span>·</span><span>Kulit
                    Nabati</span><span>·</span><span>Chenille</span><span>·</span>
            </span>
            <span class="flex gap-10" aria-hidden="true">
                <span>Boucle</span><span>·</span><span>Linen</span><span>·</span><span>Beludru</span><span>·</span><span>Wol</span><span>·</span><span>Kulit
                    Nabati</span><span>·</span><span>Chenille</span><span>·</span>
            </span>
        </div>
    </div>

    <!-- KOLEKSI -->
    <section id="koleksi" class="py-24 md:py-28 px-6 md:px-10">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14 reveal">
                <div>
                    <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-4">Koleksi</p>
                    <h2 class="font-display text-4xl md:text-5xl tracking-tight max-w-lg">Empat bentuk dasar, ratusan
                        cara mendiami ruang.</h2>
                </div>
                <p class="text-charcoal-900/60 max-w-sm">Pilih rangka, lalu sesuaikan kain, kaki, dan ukuran lewat
                    konsultasi gratis dengan tim kami.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($products ?? [] as $product)
                    @php
                        $productPhoto = $product->primaryPhoto ?? $product->photos->first();
                    @endphp
                    <a href="{{ route('produk.show', $product) }}" class="group block reveal">
                        <div class="rounded-2xl overflow-hidden bg-stone-200 aspect-[4/5]">
                            <img src="{{ $productPhoto?->url ?? asset('assets/img/home/sofa_white.webp') }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="mt-4 flex items-start justify-between">
                            <div>
                                <h3 class="font-display text-lg">{{ $product->name }}</h3>
                                @if ($product->material)
                                    <p class="text-sm text-charcoal-900/50 mt-0.5">{{ $product->material }}</p>
                                @endif
                            </div>
                            <p class="font-display text-lg whitespace-nowrap">
                                Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-charcoal-900/60">Belum ada produk untuk ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- KENAPA Wonosofa -->
    <section id="kenapa" class="py-24 md:py-28 px-6 md:px-10 bg-charcoal-900 text-stone-50">
        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-12">
            <div class="reveal">
                <p class="uppercase tracking-[0.2em] text-xs text-stone-50/50 font-medium mb-4">Kenapa Wonosofa</p>
                <h2 class="font-display text-4xl tracking-tight leading-tight">Dibuat pelan-pelan, supaya awet lama.
                </h2>
                <p class="mt-5 text-stone-50/60 leading-relaxed">Kami hanya mengerjakan satu batch kecil per minggu,
                    bukan karena lambat — tapi supaya setiap jahitan diperiksa oleh tangan yang sama dari awal sampai
                    akhir.</p>
            </div>
            <div class="grid gap-10 md:col-span-2 sm:grid-cols-3">
                <div class="reveal border-t border-stone-50/15 pt-6">
                    <h3 class="font-display text-lg mb-2">Rangka kayu solid</h3>
                    <p class="text-sm text-stone-50/55 leading-relaxed">Jati dan mahoni kering oven, disambung tanpa
                        paku tembak agar tidak berderit setelah bertahun-tahun.</p>
                </div>
                <div class="reveal border-t border-stone-50/15 pt-6">
                    <h3 class="font-display text-lg mb-2">Busa berlapis</h3>
                    <p class="text-sm text-stone-50/55 leading-relaxed">Kombinasi busa padat dan dacron di atasnya,
                        supaya empuk di awal tetap menopang setelah pemakaian harian.</p>
                </div>
                <div class="reveal border-t border-stone-50/15 pt-6">
                    <h3 class="font-display text-lg mb-2">Kain bisa diganti</h3>
                    <p class="text-sm text-stone-50/55 leading-relaxed">Sarung dudukan dan sandaran bisa dilepas,
                        dicuci, atau diganti kain tanpa perlu beli sofa baru.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KAIN -->
    <section id="kain" class="py-24 md:py-28 px-6 md:px-10">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-14 items-center">
            <div class="reveal">
                <div class="rounded-3xl overflow-hidden bg-stone-200 aspect-[5/4]">
                    <img src="https://images.unsplash.com/photo-1540574163026-643ea20ade25?q=80&w=1200&auto=format&fit=crop"
                        alt="Detail tekstur kain sofa" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="reveal">
                <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-4">Pilihan Kain</p>
                <h2 class="font-display text-4xl tracking-tight mb-5">Satu rangka, dua belas nuansa ruang.</h2>
                <p class="text-charcoal-900/65 leading-relaxed mb-8 max-w-md">Setiap kain punya karakter berbeda —
                    boucle terasa hangat dan kasual, linen sejuk dan rapi, beludru lebih formal. Konsultan kami bisa
                    kirim sampel fisik sebelum kamu memutuskan.</p>
                <div class="space-y-4 max-w-sm">
                    @foreach ($fabrics ?? [] as $fabric)
                        <div class="flex items-center gap-4 py-3 border-b border-line last:border-b-0">
                            <span class="w-9 h-9 rounded-full shrink-0" style="background:{{ $fabric['hex'] }}"></span>
                            <div>
                                <p class="font-medium text-sm">{{ $fabric['name'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONI -->
    <section id="cerita" class="py-24 md:py-28 px-6 md:px-10 bg-stone-100 border-y border-line">
        <div class="max-w-3xl mx-auto text-center reveal">
            <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-8">Cerita Pelanggan</p>
            <p class="font-display text-3xl md:text-4xl leading-snug tracking-tight">
                "Butuh waktu tiga minggu dari pesan sampai diantar, tapi begitu sofa ini duduk di ruang tamu, rasanya
                seperti memang sudah ada di sana dari dulu."
            </p>
            <p class="mt-8 text-sm text-charcoal-900/60">Amelia R. — Bandung, pengguna Beringin Sudut L</p>
        </div>
    </section>

    <!-- CTA -->
    <section id="kontak" class="py-24 md:py-28 px-6 md:px-10">
        <div class="max-w-5xl mx-auto text-center reveal">
            <h2 class="font-display text-4xl md:text-5xl tracking-tight mb-6">Ceritakan ruanganmu,<br>kami bantu isi
                dengan tepat.</h2>
            <p class="text-charcoal-900/60 max-w-lg mx-auto mb-9">Konsultasi ukuran, kain, dan pengiriman — gratis,
                tanpa kewajiban beli.</p>
            <a href="#"
                class="inline-flex items-center gap-2 bg-charcoal-900 text-stone-50 px-8 py-4 rounded-full text-sm font-medium hover:bg-olive-700 transition-colors">
                Jadwalkan Konsultasi Gratis
            </a>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swatchGroup = document.getElementById('swatch-group');
            const heroImage = document.getElementById('hero-sofa-image');
            const fabricName = document.getElementById('fabric-name'); // opsional, boleh tidak ada

            if (!swatchGroup || !heroImage) return;

            swatchGroup.addEventListener('click', function(e) {
                const btn = e.target.closest('.swatch');
                if (!btn) return;

                const newImage = btn.dataset.image;
                const newName = btn.dataset.name;

                if (newImage) {
                    heroImage.style.opacity = 0;
                    setTimeout(() => {
                        heroImage.src = newImage;
                        heroImage.alt = `Sofa ${newName} di ruang tamu minimalis`;
                        heroImage.style.opacity = 1;
                    }, 150);
                }

                if (fabricName && newName) {
                    fabricName.textContent = newName;
                }

                // update state active (border)
                swatchGroup.querySelectorAll('.swatch').forEach(s => {
                    s.classList.remove('active', 'border-charcoal-900');
                    s.classList.add('border-transparent');
                });
                btn.classList.remove('border-transparent');
                btn.classList.add('active', 'border-charcoal-900');
            });
        });
    </script>
@endpush
