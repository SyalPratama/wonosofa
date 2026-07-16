<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan halaman katalog / daftar semua produk (dengan pencarian & pagination).
     */
    public function index(Request $request)
    {
        $search = $request->input('q');

        $products = Product::query()
            ->where('is_active', true)
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->with(['primaryPhoto', 'photos'])
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('products', 'search'));
    }

    /**
     * Tampilkan halaman detail satu produk.
     *
     * Route model binding memakai kolom `slug` (lihat routes/web.php:
     * '/produk/{product:slug}'), jadi $product di sini sudah otomatis
     * ter-resolve berdasarkan slug dari URL, bukan id.
     */
    public function show(Product $product)
    {
        $product->load(['photos', 'primaryPhoto', 'colors', 'dimension', 'shippingAndReturn']);

        return view('products.show', compact('product'));
    }
}