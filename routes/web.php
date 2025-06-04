<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/', [PublicController::class, 'index'])->name('home');

Route::get('/produk', [PublicController::class, 'showProduct'])->name('product');

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


// RUTE BAWAAN LARAVEL ( HAPUS SAJA KALAU TIDAK DIPERLUKAN )
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
