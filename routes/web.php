<?php

use App\Http\Controllers\KriyaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Kriya.Lokal — storefront (pitch, frontend-first)
|--------------------------------------------------------------------------
*/

Route::get('/', [KriyaController::class, 'home'])->name('kriya.home');
Route::get('/koleksi', [KriyaController::class, 'collection'])->name('kriya.collection');
Route::get('/koleksi/{slug}', [KriyaController::class, 'product'])->name('kriya.product');
Route::get('/tentang', [KriyaController::class, 'about'])->name('kriya.about');
Route::get('/keranjang', [KriyaController::class, 'cart'])->name('kriya.cart');
Route::get('/checkout', [KriyaController::class, 'checkout'])->name('kriya.checkout');
Route::get('/pesanan-berhasil', [KriyaController::class, 'orderSuccess'])->name('kriya.order-success');
Route::get('/penjual', [KriyaController::class, 'seller'])->name('kriya.seller');
