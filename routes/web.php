<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customer\ManajemenKeranjang;
use App\Http\Controllers\Customer\ManajemenPesanan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CRUD\AkunAdminCRUD;
use App\Http\Controllers\CRUD\AkunUserCRUD;
use App\Http\Controllers\Customer\ManajemenKomentar;

Route::get('/', [PublicController::class, 'index'])->name('home');

Route::get('/produk', [PublicController::class, 'showProduct'])->name('product.index');
Route::get('/produk/detail/{id}', [PublicController::class, 'showProductDetail'])->name('product.productDetail');

Route::middleware(['auth', 'forUser'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/add-address', [ProfileController::class, 'addAddress'])->name('profile.addAddress');
    Route::delete('/profile/delete-address/{id}', [ProfileController::class, 'deleteAddress'])->name('profile.deleteAddress');
});


// ROUTE UNTUK CHATBOT
Route::get('/chatbot', [ChatbotController::class, 'index']);
Route::post('/chatbot/message', [ChatbotController::class, 'chat']);


// ROUTE FOR ADMIN & MANAGER
Route::get('/panel', [AdminController::class, 'index'])->name('panel')->middleware('forAdmin');
Route::get('/panel/transaksi', [AdminController::class, 'ManageTransaksi'])->name('panel.transactions')->middleware('forAdmin');
Route::get('/panel/report', [AdminController::class, 'showfullreport'])->name('panel.report')->middleware('forManager');

// ROUTE UNTUK MANAGE TRANSAKSI
Route::middleware(['auth', 'forUser'])->group(function () {
    Route::get('/panel/transaksi/kirim/{id}', [AdminController::class, 'kirimPesanan'])->name('panel.transaction.send')->middleware('forAdmin');
    Route::get('/panel/transaksi/batalkan/{id}', [AdminController::class, 'cancelPesanan'])->name('panel.transaction.batal')->middleware('forAdmin');
    Route::get('/panel/transaksi/detail/{id}', [AdminController::class, 'showTransactionDetail'])->name('panel.transaction.detail')->middleware('forAdmin');
});

// ROUTE FOR CART
Route::middleware(['auth', 'forUser'])->group(function () {
    Route::get('/cart', [ManajemenKeranjang::class, 'showCart'])->name('cart.index');
    Route::post('/cart/add', [ManajemenKeranjang::class, 'addToCart'])->name('cart.add');
    Route::post('/checkout', [ManajemenKeranjang::class, 'processCheckout'])->name('checkout.process');
    Route::put('/keranjang/update/{id_jamu}', [ManajemenKeranjang::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/delete/{id_jamu}', [ManajemenKeranjang::class, 'delete'])->name('keranjang.delete');
    // Ganti route checkout
    Route::post('/checkout', [ManajemenKeranjang::class, 'processCheckout'])->name('checkout.process');
    Route::post('/pesanan/create', [ManajemenPesanan::class, 'createOrder'])->name('pesanan.create');
    Route::get('/payment/{id}', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::post('/payment/callback', [PaymentController::class, 'paymentCallback']);
});



// ROUTE UNTUK MANAGE PESANAN
Route::middleware(['auth', 'forUser'])->group(function () {
    Route::get('/pesanan', [ManajemenPesanan::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/detail/{id}', [ManajemenPesanan::class, 'showOrderDetail'])->name('pesanan.detail');
    Route::post('/pesanan/kirim/{id}', [ManajemenPesanan::class, 'submitOrder'])->name('pesanan.submit');
    Route::get('/pesanan/lacak_pesanan/{id}', [ManajemenPesanan::class, 'trackOrder'])->name('pesanan.track');
    Route::get('/pesanan/selesai/{id}', [ManajemenPesanan::class, 'completeOrder'])->name('pesanan.complete');
    Route::get('/pesanan/batal/{id}', [ManajemenPesanan::class, 'cancelOrder'])->name('pesanan.cancel');
});

// ROUTE UNTUK RATING
Route::middleware(['auth', 'forUser'])->group(function () {
    Route::get('/pesanan/rating/{id}', [ManajemenKomentar::class, 'showRatingForm'])->name('pesanan.rating');
    Route::post('/pesanan/rating/store', [ManajemenKomentar::class, 'storeRating'])->name('pesanan.rating.store');
});

// CRUD PANEL
Route::middleware(['auth', 'forAdmin'])->group(function () {
    Route::get('/panel/produk', [\App\Http\Controllers\CRUD\ProdukCRUD::class, 'index'])->name('panel.produk');
    Route::post('/panel/produk/store', [\App\Http\Controllers\CRUD\ProdukCRUD::class, 'store'])->name('panel.produk.store');
    Route::put('/panel/produk/update/{id}', [\App\Http\Controllers\CRUD\ProdukCRUD::class, 'update'])->name('panel.produk.update');
    Route::delete('/panel/produk/{id}', [\App\Http\Controllers\CRUD\ProdukCRUD::class, 'destroy'])->name('panel.produk.destroy');
});

Route::middleware(['auth', 'forAdmin'])->group(function () {
    Route::get('/panel/kategori', [\App\Http\Controllers\CRUD\KategoriCRUD::class, 'index'])->name('panel.kategori');
    Route::post('/panel/kategori/store', [\App\Http\Controllers\CRUD\KategoriCRUD::class, 'store'])->name('panel.kategori.store');
    Route::put('/panel/kategori/update/{id}', [\App\Http\Controllers\CRUD\KategoriCRUD::class, 'update'])->name('panel.kategori.update');
    Route::delete('/panel/kategori/{id}', [\App\Http\Controllers\CRUD\KategoriCRUD::class, 'destroy'])->name('panel.kategori.destroy');
});

Route::middleware(['auth', 'Manager'])->group(function () {
    Route::get('/panel/akun-admin', [AkunAdminCRUD::class, 'index'])->name('panel.akunadmin');
    Route::get('/panel/akun-admin/tambah', [AkunAdminCRUD::class, 'create'])->name('panel.akunadmin.create');
    Route::post('/panel/akun-admin/store', [AkunAdminCRUD::class, 'store'])->name('panel.akunadmin.store');
    Route::get('/panel/akun-admin/edit/{id}', [AkunAdminCRUD::class, 'edit'])->name('panel.akunadmin.edit');
    Route::post('/panel/akun-admin/update/{id}', [AkunAdminCRUD::class, 'update'])->name('panel.akunadmin.update');
    Route::delete('/panel/akun-admin/{id}', [AkunAdminCRUD::class, 'destroy'])->name('panel.akunadmin.destroy');
});

Route::middleware(['auth', 'forAdmin'])->group(function () {
    Route::get('/panel/pengguna', [AkunUserCRUD::class, 'index'])->name('panel.akunuser');
    Route::delete('/panel/pengguna/{id}', [AkunUserCRUD::class, 'destroy'])->name('panel.akunuser.destroy');
});


// RUTE BAWAAN LARAVEL ( HAPUS SAJA KALAU TIDAK DIPERLUKAN )
Route::get('/dashboard', [PublicController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__ . '/auth.php';
