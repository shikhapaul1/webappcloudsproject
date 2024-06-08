<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('product-list', [ProductController::class, 'product_list'])->middleware(['auth', 'verified'])->name('product_list');
Route::get('add-cart/{id}', [ProductController::class, 'add_cart'])->name('add_cart');
Route::any('view-cart', [ProductController::class, 'view_cart'])->name('view_cart');
Route::any('add-moreqty', [ProductController::class, 'add_moreqty'])->name('add_moreqty');
Route::any('/remove-from-cart', [ProductController::class, 'removeFromCart']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
