<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OfferController;

Route::get('/', function () {
    $categories = \App\Models\Category::with('products')->get();
    $offers = \App\Models\Offer::all();
    return view('welcome', compact('categories', 'offers'));
})->name('welcome');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
Route::put('/admin/categories/{category}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
Route::delete('/admin/categories/{category}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');

Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
Route::put('/admin/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
Route::delete('/admin/products/{product}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');

Route::post('/admin/offers', [AdminController::class, 'storeOffer'])->name('admin.offers.store');
Route::delete('/admin/offers/{offer}', [AdminController::class, 'destroyOffer'])->name('admin.offers.destroy');