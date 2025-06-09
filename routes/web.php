<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customer\ManajemenKeranjang;
use App\Http\Controllers\Customer\ManajemenPesanan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/', [PublicController::class, 'index'])->name('home');

Route::get('/produk', [PublicController::class, 'showProduct'])->name('product.index');
Route::get('/produk/detail/{id}', [PublicController::class, 'showProductDetail'])->name('product.productDetail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ROUTE UNTUK CHATBOT
Route::get('/chatbot', [ChatbotController::class, 'index']);
Route::post('/chatbot/message', [ChatbotController::class, 'chat']);


// ROUTE FOR ADMIN & MANAGER
Route::get('/panel', [AdminController::class, 'index'])->name('panel');


// ROUTE FOR CART
Route::get('/cart', [ManajemenKeranjang::class, 'showCart'])->name('cart.index');
Route::post('/cart/add', [ManajemenKeranjang::class, 'addToCart'])->name('cart.add');
Route::post('/checkout', [ManajemenKeranjang::class, 'processCheckout'])->name('checkout.process');

// ROUTE UNTUK MANAGE PESANAN
Route::get('/pesanan', [ManajemenPesanan::class, 'index'])->name('pesanan.index');
Route::get('/pesanan/detail/{id}', [ManajemenPesanan::class, 'showOrderDetail'])->name('pesanan.detail');
Route::post('/pesanan/kirim/{id}', [ManajemenPesanan::class, 'submitOrder'])->name('pesanan.submit');
Route::get('/pesanan/lacak_pesanan/{id}', [ManajemenPesanan::class, 'trackOrder'])->name('pesanan.track');

// RUTE BAWAAN LARAVEL ( HAPUS SAJA KALAU TIDAK DIPERLUKAN )
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
