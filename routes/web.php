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
Route::get('/panel/transaksi', [AdminController::class, 'ManageTransaksi'])->name('panel.transactions');

// ROUTE UNTUK MANAGE TRANSAKSI
Route::get('/panel/transaksi/kirim/{id}', [AdminController::class, 'kirimPesanan'])->name('panel.transaction.send');
Route::get('/panel/transaksi/batalkan/{id}', [AdminController::class, 'cancelPesanan'])->name('panel.transaction.batal');
Route::get('/panel/transaksi/detail/{id}', [AdminController::class, 'showTransactionDetail'])->name('panel.transaction.detail');

// ROUTE FOR CART
Route::get('/cart', [ManajemenKeranjang::class, 'showCart'])->name('cart.index');
Route::post('/cart/add', [ManajemenKeranjang::class, 'addToCart'])->name('cart.add');
Route::post('/checkout', [ManajemenKeranjang::class, 'processCheckout'])->name('checkout.process');

// ROUTE UNTUK MANAGE PESANAN
Route::get('/pesanan', [ManajemenPesanan::class, 'index'])->name('pesanan.index');
Route::get('/pesanan/detail/{id}', [ManajemenPesanan::class, 'showOrderDetail'])->name('pesanan.detail');
Route::post('/pesanan/kirim/{id}', [ManajemenPesanan::class, 'submitOrder'])->name('pesanan.submit');
Route::get('/pesanan/lacak_pesanan/{id}', [ManajemenPesanan::class, 'trackOrder'])->name('pesanan.track');
Route::get('/pesanan/selesai/{$id}', [ManajemenPesanan::class, 'completeOrder'])->name('pesanan.complete');
Route::get('/pesanan/batal/{id}', [ManajemenPesanan::class, 'cancelOrder'])->name('pesanan.cancel');

// CRUD PANEL
Route::get('/panel/produk', [\App\Http\Controllers\CRUD\ProdukCRUD::class, 'index'])->name('panel.produk');
Route::get('/panel/produk/tambah', [\App\Http\Controllers\CRUD\ProdukCRUD::class, 'create'])->name('panel.produk.create');
Route::post('/panel/produk/store', [\App\Http\Controllers\CRUD\ProdukCRUD::class, 'store'])->name('panel.produk.store');
Route::get('/panel/produk/edit/{id}', [\App\Http\Controllers\CRUD\ProdukCRUD::class, 'edit'])->name('panel.produk.edit');
Route::post('/panel/produk/update/{id}', [\App\Http\Controllers\CRUD\ProdukCRUD::class, 'update'])->name('panel.produk.update');

Route::get('/panel/kategori', [\App\Http\Controllers\CRUD\KategoriCRUD::class, 'index'])->name('panel.kategori');
Route::get('/panel/kategori/tambah', [\App\Http\Controllers\CRUD\KategoriCRUD::class, 'create'])->name('panel.kategori.create');
Route::post('/panel/kategori/store', [\App\Http\Controllers\CRUD\KategoriCRUD::class, 'store'])->name('panel.kategori.store');
Route::get('/panel/kategori/edit/{id}', [\App\Http\Controllers\CRUD\KategoriCRUD::class, 'edit'])->name('panel.kategori.edit');
Route::post('/panel/kategori/update/{id}', [\App\Http\Controllers\CRUD\KategoriCRUD::class, 'update'])->name('panel.kategori.update');
// RUTE BAWAAN LARAVEL ( HAPUS SAJA KALAU TIDAK DIPERLUKAN )
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
