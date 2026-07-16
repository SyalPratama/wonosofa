<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelolaProductController;
use App\Http\Controllers\Admin\KelolaUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('produk.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('produk.show');
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('kontak');


Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
});


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Products
        Route::get('/products', [KelolaProductController::class, 'index'])->name('produk.index');
        Route::post('/products', [KelolaProductController::class, 'store'])->name('produk.store');
        Route::put('/products/{product}', [KelolaProductController::class, 'update'])->name('produk.update');
        Route::delete('/products/{product}', [KelolaProductController::class, 'destroy'])->name('produk.destroy');

        // Kelola user
        Route::get('/users', [KelolaUserController::class, 'index'])->name('users.index');
        Route::post('/users', [KelolaUserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [KelolaUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [KelolaUserController::class, 'destroy'])->name('users.destroy');
    });

    // Tanpa prefix nama route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});