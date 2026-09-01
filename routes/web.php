<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/products/{id}/seller', [ProductController::class, 'sellerShow']);
    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
    Route::post('/products/{id}/update', [ProductController::class, 'update']);
    Route::get('/products/{id}/purchase', [ProductController::class, 'purchaseForm']);
    Route::post('/products/{id}/purchase', [ProductController::class, 'purchase']);
    Route::post('/products/{id}/like', [ProductController::class, 'like']);

});

Route::get('/mypage', [ProductController::class, 'mypage'])
    ->middleware('auth');

Route::get('/account/edit', [ProductController::class, 'accountEdit'])
    ->middleware('auth');

    Route::post('/account/update', [ProductController::class, 'accountUpdate'])
    ->middleware('auth');

Route::get('/inquiry', [ProductController::class, 'inquiry'])
    ->middleware('auth');

    Route::post('/inquiry', [ProductController::class, 'inquirySend'])
    ->middleware('auth');

require __DIR__.'/auth.php';