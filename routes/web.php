<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    // Route::get('products/create', [ProductController::class, 'index'])->name('products.create');
    Route::post('products', [ProductController::class, 'index'])->name('products.store');
    Route::get('products/{id}', [ProductController::class, 'index'])->name('products.show');
});
