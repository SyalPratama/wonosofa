<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin.
     *
     * Catatan: query di bawah ini masih contoh (dummy).
     * Sesuaikan dengan model Product, Order, dan Customer milik Anda.
     */
    public function index(Request $request)
    {
        // Contoh statistik ringkas — ganti dengan query model asli, misalnya:
        // $totalProduk    = Product::count();
        // $pesananBaru    = Order::where('status', 'pending')->count();
        // $pendapatan     = Order::where('status', 'selesai')->whereMonth('created_at', now()->month)->sum('total');
        // $totalPelanggan = Customer::count();
 
        $stats = [
            'total_produk'    => 48,
            'pesanan_baru'    => 12,
            'pendapatan'      => 87500000,
            'total_pelanggan' => 356,
        ];
 
        // Contoh data pesanan terbaru — ganti dengan Order::latest()->take(6)->get()
        $pesananTerbaru = collect([
            (object) ['id' => 'INV-1042', 'pelanggan' => 'Dewi Anggraini', 'produk' => 'Sofa Chester Beige 3-Dudukan', 'total' => 8500000, 'status' => 'Menunggu Pembayaran', 'tanggal' => now()->subHours(2)],
            (object) ['id' => 'INV-1041', 'pelanggan' => 'Rangga Pratama', 'produk' => 'Sofa Bed Minimalis Abu', 'total' => 5200000, 'status' => 'Diproses', 'tanggal' => now()->subHours(6)],
            (object) ['id' => 'INV-1040', 'pelanggan' => 'Siti Rahma', 'produk' => 'Sofa L-Shape Olive Velvet', 'total' => 12750000, 'status' => 'Dikirim', 'tanggal' => now()->subDay()],
            (object) ['id' => 'INV-1039', 'pelanggan' => 'Budi Santoso', 'produk' => 'Sofa Single Recliner Clay', 'total' => 4300000, 'status' => 'Selesai', 'tanggal' => now()->subDays(2)],
            (object) ['id' => 'INV-1038', 'pelanggan' => 'Maya Kusuma', 'produk' => 'Sofa Tamu Klasik Kayu Jati', 'total' => 15900000, 'status' => 'Selesai', 'tanggal' => now()->subDays(3)],
        ]);
 
        // Contoh produk terlaris — ganti dengan query agregat pesanan
        $produkTerlaris = collect([
            (object) ['nama' => 'Sofa Chester Beige 3-Dudukan', 'terjual' => 34, 'stok' => 12],
            (object) ['nama' => 'Sofa L-Shape Olive Velvet', 'terjual' => 27, 'stok' => 8],
            (object) ['nama' => 'Sofa Bed Minimalis Abu', 'terjual' => 21, 'stok' => 15],
            (object) ['nama' => 'Sofa Single Recliner Clay', 'terjual' => 18, 'stok' => 6],
        ]);
 
        return view('admin.dashboard', compact('stats', 'pesananTerbaru', 'produkTerlaris'));
    }
}