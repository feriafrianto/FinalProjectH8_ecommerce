<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController ;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('category', \App\Http\Controllers\CategoryController::class)
    ->middleware('auth');
Route::resource('subcategory', \App\Http\Controllers\SubCategoryController::class)
    ->middleware('auth');
Route::resource('product', \App\Http\Controllers\ProductController::class)
    ->middleware('auth');
Route::resource('transaction', \App\Http\Controllers\TransactionController::class)
    ->middleware('auth');
Route::resource('cart', \App\Http\Controllers\CartController::class)
    ->middleware('auth');
Route::get('/export', [App\Http\Controllers\TransactionController::class, 'export'])->name('transaction.export');

