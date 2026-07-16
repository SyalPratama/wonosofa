@extends('layouts.home')

@section('title', 'Tentang Kami — Selaras')

@section('content')

    <!-- HEADER HALAMAN -->
    <section class="pt-32 md:pt-40 pb-12 px-6 md:px-10">
        <div class="max-w-7xl mx-auto">
            <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-4">Tentang Kami</p>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <h1 class="font-display text-4xl md:text-5xl tracking-tight max-w-lg">
                    Furnitur yang dirancang untuk dipakai, bukan sekadar dipajang.
                </h1>
                <p class="text-charcoal-900/60 max-w-sm">
                    Selaras lahir dari keinginan sederhana: membuat sofa yang benar-benar cocok
                    dengan cara kamu tinggal, bukan sebaliknya.
                </p>
            </div>
        </div>
    </section>

    <!-- CERITA -->
    <section class="py-16 md:py-20 px-6 md:px-10">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <div class="rounded-2xl overflow-hidden bg-stone-200 aspect-[4/5]">
                <img src="https://placehold.co/800x1000?text=Selaras+Workshop" alt="Workshop Selaras"
                    class="w-full h-full object-cover">
            </div>
            <div>
                <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-4">Cerita Kami</p>
                <h2 class="font-display text-3xl md:text-4xl tracking-tight mb-6">Dibuat dengan tangan,
                    dirancang dengan pikiran.</h2>
                <p class="text-charcoal-900/70 leading-relaxed mb-4">
                    Sejak awal, kami percaya bahwa furnitur terbaik lahir dari kolaborasi antara
                    pengrajin berpengalaman dan pemilik rumah itu sendiri. Setiap rangka sofa kami
                    dibuat oleh tangan-tangan terampil, lalu disesuaikan kain, kaki, dan ukurannya
                    sesuai kebutuhan ruang kamu.
                </p>
                <p class="text-charcoal-900/70 leading-relaxed">
                    Tidak ada dua rumah yang sama, jadi kenapa harus ada sofa yang sama?
                </p>
            </div>
        </div>
    </section>

    <!-- NILAI-NILAI -->
    <section class="py-16 md:py-20 px-6 md:px-10 bg-stone-100">
        <div class="max-w-7xl mx-auto">
            <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-4">Kenapa Selaras</p>
            <h2 class="font-display text-3xl md:text-4xl tracking-tight mb-12 max-w-lg">
                Tiga hal yang selalu kami jaga di setiap produk.
            </h2>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <div class="w-12 h-12 rounded-full bg-charcoal-900 text-stone-50 flex items-center justify-center mb-5">
                        <i class="fa-solid fa-hammer text-sm"></i>
                    </div>
                    <h3 class="font-display text-lg mb-2">Kerajinan Tangan</h3>
                    <p class="text-sm text-charcoal-900/60 leading-relaxed">
                        Setiap rangka dirakit manual oleh pengrajin dengan puluhan tahun pengalaman.
                    </p>
                </div>
                <div>
                    <div class="w-12 h-12 rounded-full bg-charcoal-900 text-stone-50 flex items-center justify-center mb-5">
                        <i class="fa-solid fa-leaf text-sm"></i>
                    </div>
                    <h3 class="font-display text-lg mb-2">Material Berkelanjutan</h3>
                    <p class="text-sm text-charcoal-900/60 leading-relaxed">
                        Kayu dan kain dipilih dari sumber yang bertanggung jawab terhadap lingkungan.
                    </p>
                </div>
                <div>
                    <div class="w-12 h-12 rounded-full bg-charcoal-900 text-stone-50 flex items-center justify-center mb-5">
                        <i class="fa-solid fa-ruler-combined text-sm"></i>
                    </div>
                    <h3 class="font-display text-lg mb-2">Disesuaikan untukmu</h3>
                    <p class="text-sm text-charcoal-900/60 leading-relaxed">
                        Ukuran, kain, dan kaki bisa disesuaikan lewat konsultasi gratis dengan tim kami.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 px-6 md:px-10">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="font-display text-3xl md:text-4xl tracking-tight mb-6">Siap merancang sofa impianmu?</h2>
            <a href="{{ route('produk.index') }}"
                class="inline-flex text-sm font-medium bg-charcoal-900 text-stone-50 px-6 py-3 rounded-full hover:bg-olive-700 transition-colors">
                Lihat Koleksi
            </a>
        </div>
    </section>

@endsection
