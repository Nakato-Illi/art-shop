<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\MessagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/session', [StripeController::class, 'session'])->name('session');
Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');

Route::get('products', [ProductsController::class, 'index']);
Route::get('messages', [MessagesController::class, 'index']);
Route::get('cart', [ProductsController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductsController::class, 'addToCart'])->name('add_to_cart');
Route::patch('update-cart', [ProductsController::class, 'updateCart'])->name('update_cart');
Route::delete('remove-from-cart', [ProductsController::class, 'remove'])->name('remove_from_cart');
Route::resource('products', 'App\Http\Controllers\ProductsController');
Route::resource('messages', 'App\Http\Controllers\MessagesController');

Route::get('/', [PagesController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
