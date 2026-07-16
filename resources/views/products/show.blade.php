@extends('layouts.home')

@section('title', $product->name . ' — Selaras')

@section('content')

    @php
        $mainPhoto = $product->primaryPhoto ?? $product->photos->first();
    @endphp

    <section class="pt-32 md:pt-40 pb-24 px-6 md:px-10">
        <div class="max-w-7xl mx-auto">

            {{-- Breadcrumb --}}
            <div class="text-sm text-charcoal-900/50 mb-8">
                <a href="{{ route('home') }}" class="hover:text-charcoal-900">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('produk.index') }}" class="hover:text-charcoal-900">Products</a>
                <span class="mx-2">/</span>
                <span class="text-charcoal-900">{{ $product->name }}</span>
            </div>

            <div class="grid md:grid-cols-2 gap-12 md:gap-16">

                {{-- GALERI FOTO --}}
                <div>
                    <div class="rounded-3xl overflow-hidden bg-stone-200 aspect-[4/5]">
                        <img id="main-product-image"
                            src="{{ $mainPhoto ? asset($mainPhoto->file_name) : 'https://placehold.co/800x1000?text=No+Photo' }}"
                            alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>

                    @if ($product->photos->count() > 1)
                        <div class="grid grid-cols-5 gap-3 mt-4">
                            @foreach ($product->photos as $photo)
                                <button type="button"
                                    onclick="document.getElementById('main-product-image').src = '{{ asset($photo->file_name) }}'"
                                    class="rounded-xl overflow-hidden aspect-square border-2 @if ($photo->is_primary) border-charcoal-900 @else border-transparent @endif hover:border-charcoal-900/50 transition">
                                    <img src="{{ asset($photo->file_name) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- INFO PRODUK --}}
                <div>
                    @if ($product->sku)
                        <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-3">{{ $product->sku }}
                        </p>
                    @endif

                    <h1 class="font-display text-4xl md:text-5xl tracking-tight">{{ $product->name }}</h1>

                    <p class="font-display text-2xl mt-4">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

                    @if ($product->description)
                        <p class="mt-6 text-charcoal-900/70 leading-relaxed">{{ $product->description }}</p>
                    @endif

                    {{-- Warna --}}
                    @if ($product->colors->isNotEmpty())
                        <div class="mt-8">
                            <p class="text-sm font-medium text-charcoal-900 mb-3">Pilihan Warna</p>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($product->colors as $color)
                                    <div class="flex items-center gap-2 border border-line rounded-full pl-1.5 pr-4 py-1.5"
                                        title="{{ $color->name }}">
                                        <span class="w-6 h-6 rounded-full border border-line shrink-0"
                                            style="background-color: {{ $color->hex_code ?? '#D9D0C1' }}"></span>
                                        <span class="text-sm text-charcoal-900">{{ $color->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Material --}}
                    @if ($product->material)
                        <div class="mt-6">
                            <p class="text-sm font-medium text-charcoal-900 mb-1">Material</p>
                            <p class="text-sm text-charcoal-900/70">{{ $product->material }}</p>
                        </div>
                    @endif

                    <div class="mt-9 flex items-center gap-5">
                        <a href="#kontak-produk"
                            class="inline-flex items-center gap-2 bg-charcoal-900 text-stone-50 px-7 py-3.5 rounded-full text-sm font-medium hover:bg-olive-700 transition-colors">
                            Konsultasi Produk Ini
                        </a>
                        @if ($product->stock > 0)
                            <span class="text-sm text-charcoal-900/60">Stok tersedia: {{ $product->stock }}</span>
                        @else
                            <span class="text-sm text-clay-400">Stok habis</span>
                        @endif
                    </div>

                    {{-- Dimensi --}}
                    @if ($product->dimension)
                        <div class="mt-12 border-t border-line pt-8">
                            <p class="text-sm font-medium text-charcoal-900 mb-4">Dimensi Produk</p>
                            <dl class="grid grid-cols-2 gap-y-4 gap-x-6 text-sm">
                                @if ($product->dimension->general_dimensions)
                                    <div>
                                        <dt class="text-charcoal-900/50">General Dimensions</dt>
                                        <dd class="text-charcoal-900 mt-0.5">{{ $product->dimension->general_dimensions }}
                                        </dd>
                                    </div>
                                @endif
                                @if ($product->dimension->seat_height)
                                    <div>
                                        <dt class="text-charcoal-900/50">Seat Height</dt>
                                        <dd class="text-charcoal-900 mt-0.5">{{ $product->dimension->seat_height }}</dd>
                                    </div>
                                @endif
                                @if ($product->dimension->seat_depth)
                                    <div>
                                        <dt class="text-charcoal-900/50">Seat Depth</dt>
                                        <dd class="text-charcoal-900 mt-0.5">{{ $product->dimension->seat_depth }}</dd>
                                    </div>
                                @endif
                                @if ($product->dimension->arm_height)
                                    <div>
                                        <dt class="text-charcoal-900/50">Arm Height</dt>
                                        <dd class="text-charcoal-900 mt-0.5">{{ $product->dimension->arm_height }}</dd>
                                    </div>
                                @endif
                                @if ($product->dimension->total_weight_lbs)
                                    <div>
                                        <dt class="text-charcoal-900/50">Total Weight</dt>
                                        <dd class="text-charcoal-900 mt-0.5">{{ $product->dimension->total_weight_lbs }}
                                            lbs</dd>
                                    </div>
                                @endif
                                @if ($product->dimension->box_dimensions)
                                    <div>
                                        <dt class="text-charcoal-900/50">Box Dimensions</dt>
                                        <dd class="text-charcoal-900 mt-0.5">{{ $product->dimension->box_dimensions }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    @endif

                    {{-- Shipping & Return --}}
                    @if (
                        $product->shippingAndReturn &&
                            ($product->shippingAndReturn->shipping_info || $product->shippingAndReturn->return_policy))
                        <div class="mt-8 border-t border-line pt-8 space-y-6">
                            @if ($product->shippingAndReturn->shipping_info)
                                <div>
                                    <p class="text-sm font-medium text-charcoal-900 mb-1.5">Pengiriman</p>
                                    <p class="text-sm text-charcoal-900/70 leading-relaxed">
                                        {{ $product->shippingAndReturn->shipping_info }}</p>
                                </div>
                            @endif
                            @if ($product->shippingAndReturn->return_policy)
                                <div>
                                    <p class="text-sm font-medium text-charcoal-900 mb-1.5">Kebijakan Pengembalian</p>
                                    <p class="text-sm text-charcoal-900/70 leading-relaxed">
                                        {{ $product->shippingAndReturn->return_policy }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- CTA konsultasi --}}
    <section id="kontak-produk" class="py-24 px-6 md:px-10 bg-stone-100 border-t border-line">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="font-display text-3xl md:text-4xl tracking-tight mb-5">Tertarik dengan {{ $product->name }}?</h2>
            <p class="text-charcoal-900/60 max-w-lg mx-auto mb-8">Konsultasi ukuran, kain, dan pengiriman untuk
                produk ini — gratis, tanpa kewajiban beli.</p>
            <a href="{{ route('home') }}#kontak"
                class="inline-flex items-center gap-2 bg-charcoal-900 text-stone-50 px-8 py-4 rounded-full text-sm font-medium hover:bg-olive-700 transition-colors">
                Jadwalkan Konsultasi Gratis
            </a>
        </div>
    </section>

@endsection
