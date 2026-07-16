@extends('layouts.home')

@section('title', 'Koleksi Produk — Selaras')

@section('content')

    <!-- HEADER HALAMAN -->
    <section class="pt-32 md:pt-40 pb-12 px-6 md:px-10">
        <div class="max-w-7xl mx-auto">
            <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-4">Koleksi</p>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <h1 class="font-display text-4xl md:text-5xl tracking-tight max-w-lg">Semua sofa yang bisa
                    dirancang sesuai ruangmu.</h1>
                <p class="text-charcoal-900/60 max-w-sm">Pilih rangka, lalu sesuaikan kain, kaki, dan ukuran lewat
                    konsultasi gratis dengan tim kami.</p>
            </div>

            {{-- Pencarian --}}
            <form method="GET" action="{{ route('produk.index') }}" class="mt-8 max-w-sm">
                <div class="relative">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama produk…"
                        class="w-full rounded-full border border-line pl-5 pr-12 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                    <button type="submit"
                        class="absolute right-1.5 top-1.5 w-9 h-9 rounded-full bg-charcoal-900 text-stone-50 flex items-center justify-center hover:bg-olive-700 transition-colors">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- GRID PRODUK -->
    <section class="py-16 md:py-20 px-6 md:px-10">
        <div class="max-w-7xl mx-auto">

            @if ($search)
                <p class="text-sm text-charcoal-900/60 mb-8">
                    Menampilkan hasil pencarian untuk "<span
                        class="font-medium text-charcoal-900">{{ $search }}</span>"
                    — {{ $products->total() }} produk ditemukan.
                    <a href="{{ route('produk.index') }}" class="underline hover:text-charcoal-900 ml-1">Hapus
                        pencarian</a>
                </p>
            @endif

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    @php
                        $productPhoto = $product->primaryPhoto ?? $product->photos->first();
                    @endphp
                    <a href="{{ route('produk.show', $product) }}" class="group block">
                        <div class="rounded-2xl overflow-hidden bg-stone-200 aspect-[4/5]">
                            <img src="{{ $productPhoto ? asset($productPhoto->file_name) : 'https://placehold.co/600x750?text=No+Photo' }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="mt-4 flex items-start justify-between">
                            <div>
                                <h3 class="font-display text-lg">{{ $product->name }}</h3>
                                <p class="text-sm text-charcoal-900/50 mt-0.5">
                                    {{ $product->material ?? \Illuminate\Support\Str::limit($product->description, 40) }}
                                </p>
                            </div>
                            <p class="font-display text-lg whitespace-nowrap">
                                Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-20">
                        <p class="text-charcoal-900/60">
                            @if ($search)
                                Tidak ada produk yang cocok dengan pencarian "{{ $search }}".
                            @else
                                Belum ada produk untuk ditampilkan.
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($products->hasPages())
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>

@endsection
