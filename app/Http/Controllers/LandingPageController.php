<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    /**
     * Tampilkan landing page utama Selaras.
     *
     * Produk & kain diambil langsung dari database, dan urutannya
     * diacak setiap kali halaman di-refresh (inRandomOrder()).
     */
    public function index(): View
    {
        $products = $this->products();

        return view('welcome', [
            'title'    => 'Selaras — Sofa yang Dibuat untuk Ditinggali',
            'products' => $products,
            'product'  => $products->first(),
            'fabrics'  => $this->fabrics($products->first()),
        ]);
    }

    /**
     * Ambil 4 produk aktif secara acak, lengkap dengan foto & warnanya.
     * Setiap refresh halaman, inRandomOrder() akan mengocok ulang query
     * di level database, jadi hasilnya berbeda-beda.
     */
    private function products()
    {
        return Product::query()
            ->where('is_active', true)
            ->with(['photos', 'primaryPhoto', 'colors'])
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    /**
     * Bangun daftar "fabrics" (kain) untuk hero swatch-picker,
     * diambil dari relasi colors() milik salah satu produk (produk pertama
     * dari hasil acak di atas). Kalau produk tidak punya warna sama sekali,
     * fallback ke 1 entri default supaya swatch picker tidak kosong.
     */
    private function fabrics(?Product $product): array
    {
        if (! $product || $product->colors->isEmpty()) {
            return [[
                'name'  => 'Linen Krem Alami',
                'hex'   => '#E4DAC6',
                'image' => asset('assets/img/home/sofa_white.webp'),
            ]];
        }

        $photos     = $product->photos;
        $fallback   = $product->primaryPhoto?->url ?? $photos->first()?->url ?? asset('assets/img/home/sofa_white.webp');
        $totalPhoto = $photos->count();

        return $product->colors->values()->map(function ($color, $i) use ($photos, $fallback, $totalPhoto) {
            // Pasangkan warna ke-i dengan foto ke-i (looping kalau foto lebih sedikit dari warna)
            $photo = $totalPhoto > 0
                ? $photos[$i % $totalPhoto]
                : null;

            return [
                'name'  => $color->name,
                'hex'   => $color->hex_code,
                'image' => $photo?->url ?? $fallback,
            ];
        })->all();
    }
}