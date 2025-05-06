<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Mail;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/filter', [ProductController::class, 'filter'])->name('products.filter');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/checkout', [CartController::class, 'cart'])->name('checkout.cart');
Route::post('/place-order', [CartController::class, 'placeOrder'])->name('checkout.place');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');




