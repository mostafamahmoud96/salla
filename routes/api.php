<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SyncProduct;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::prefix('sync')->group(function () {
    Route::get('products', [SyncProduct::class]);
});

Route::post('insert/product', [ProductController::class, 'createProduct'])->name('create-product');
//Route::put('edit/{product}', [ProductController::class, 'update'])->name('edit-product');
