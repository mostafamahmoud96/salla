<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('layouts.app');
});
Route::get('dashboard', function () {
    return view('dashboard')->name('dashboard');
});

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('list', 'getProducts')->name('products.list');
    Route::get('pull', 'pullProducts')->name('pull-products');
    Route::get('create', 'create')->name('create-view');
    Route::post('insert', 'createProduct')->name('create');
    Route::get('update/{product}', 'editProduct')->name('update-product');
    Route::put('edit/{product}', 'update')->name('edit-product');
    Route::get('pull/data', 'pullButton')->name('pull-data');
});
