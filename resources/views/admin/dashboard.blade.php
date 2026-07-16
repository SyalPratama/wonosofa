@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    {{-- Kartu statistik --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-line p-5">
            <div class="w-10 h-10 rounded-xl bg-olive-600/10 flex items-center justify-center text-olive-700 mb-4">
                <i class="fa-solid fa-couch"></i>
            </div>
            <p class="text-xs text-charcoal-900/50 mb-1">Total Produk</p>
            <p class="font-display text-2xl text-charcoal-900">{{ number_format($stats['total_produk']) }}</p>
        </div>

        <div class="bg-white rounded-2xl border border-line p-5">
            <div class="w-10 h-10 rounded-xl bg-clay-400/20 flex items-center justify-center text-clay-400 mb-4">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <p class="text-xs text-charcoal-900/50 mb-1">Pesanan Baru</p>
            <p class="font-display text-2xl text-charcoal-900">{{ number_format($stats['pesanan_baru']) }}</p>
        </div>

        <div class="bg-white rounded-2xl border border-line p-5">
            <div class="w-10 h-10 rounded-xl bg-olive-600/10 flex items-center justify-center text-olive-700 mb-4">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <p class="text-xs text-charcoal-900/50 mb-1">Pendapatan Bulan Ini</p>
            <p class="font-display text-2xl text-charcoal-900">Rp{{ number_format($stats['pendapatan'], 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-2xl border border-line p-5">
            <div class="w-10 h-10 rounded-xl bg-clay-400/20 flex items-center justify-center text-clay-400 mb-4">
                <i class="fa-solid fa-users"></i>
            </div>
            <p class="text-xs text-charcoal-900/50 mb-1">Total Pelanggan</p>
            <p class="font-display text-2xl text-charcoal-900">{{ number_format($stats['total_pelanggan']) }}</p>
        </div>
    </div>

    {{-- Pesanan terbaru + Produk terlaris --}}
    <div class="grid lg:grid-cols-3 gap-6">

        {{-- Pesanan terbaru --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-line overflow-hidden">
            <div class="flex items-center justify-between px-5 sm:px-6 py-4 border-b border-line">
                <h2 class="font-display text-lg text-charcoal-900">Pesanan Terbaru</h2>
                <a href="#" class="text-xs font-medium text-olive-700 hover:text-olive-600">Lihat semua</a>
            </div>

            {{-- Tampilan tabel untuk desktop --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-charcoal-900/50 text-xs uppercase tracking-wide">
                            <th class="px-6 py-3 font-medium">Invoice</th>
                            <th class="px-6 py-3 font-medium">Pelanggan</th>
                            <th class="px-6 py-3 font-medium">Produk</th>
                            <th class="px-6 py-3 font-medium">Total</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($pesananTerbaru as $pesanan)
                            <tr class="hover:bg-stone-50">
                                <td class="px-6 py-4 font-medium text-charcoal-900">{{ $pesanan->id }}</td>
                                <td class="px-6 py-4 text-charcoal-900/80">{{ $pesanan->pelanggan }}</td>
                                <td class="px-6 py-4 text-charcoal-900/80">{{ $pesanan->produk }}</td>
                                <td class="px-6 py-4 text-charcoal-900/80">
                                    Rp{{ number_format($pesanan->total, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusStyle = match ($pesanan->status) {
                                            'Menunggu Pembayaran' => 'bg-clay-300/30 text-clay-400',
                                            'Diproses' => 'bg-olive-600/10 text-olive-700',
                                            'Dikirim' => 'bg-charcoal-900/10 text-charcoal-900',
                                            'Selesai' => 'bg-olive-600/20 text-olive-700',
                                            default => 'bg-line text-charcoal-900/60',
                                        };
                                    @endphp
                                    <span class="status-pill {{ $statusStyle }}">{{ $pesanan->status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Tampilan kartu untuk mobile --}}
            <div class="md:hidden divide-y divide-line">
                @foreach ($pesananTerbaru as $pesanan)
                    @php
                        $statusStyle = match ($pesanan->status) {
                            'Menunggu Pembayaran' => 'bg-clay-300/30 text-clay-400',
                            'Diproses' => 'bg-olive-600/10 text-olive-700',
                            'Dikirim' => 'bg-charcoal-900/10 text-charcoal-900',
                            'Selesai' => 'bg-olive-600/20 text-olive-700',
                            default => 'bg-line text-charcoal-900/60',
                        };
                    @endphp
                    <div class="px-5 py-4">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-medium text-sm text-charcoal-900">{{ $pesanan->id }}</span>
                            <span class="status-pill {{ $statusStyle }}">{{ $pesanan->status }}</span>
                        </div>
                        <p class="text-sm text-charcoal-900/80">{{ $pesanan->pelanggan }}</p>
                        <p class="text-xs text-charcoal-900/50 mb-2">{{ $pesanan->produk }}</p>
                        <p class="text-sm font-medium text-charcoal-900">
                            Rp{{ number_format($pesanan->total, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Produk terlaris --}}
        <div class="bg-white rounded-2xl border border-line overflow-hidden">
            <div class="px-5 sm:px-6 py-4 border-b border-line">
                <h2 class="font-display text-lg text-charcoal-900">Produk Terlaris</h2>
            </div>
            <div class="divide-y divide-line">
                @foreach ($produkTerlaris as $produk)
                    <div class="px-5 sm:px-6 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-charcoal-900 pr-2">{{ $produk->nama }}</p>
                            <span class="text-xs text-olive-700 font-semibold shrink-0">{{ $produk->terjual }}
                                terjual</span>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-stone-100 overflow-hidden">
                            <div class="h-full bg-olive-600 rounded-full"
                                style="width: {{ min(100, $produk->terjual * 2) }}%"></div>
                        </div>
                        <p class="text-xs text-charcoal-900/40 mt-1.5">Stok tersisa: {{ $produk->stok }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
