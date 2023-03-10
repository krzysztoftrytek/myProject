<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
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

Route::get('/',[WelcomeController::class, 'index']);


Route::get('/products',[ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::post('/products',[ProductController::class,'store'])->name('products.store')->middleware('auth');
Route::get('/products/create',[ProductController::class, 'create'])->name('products.create')->middleware('auth');
Route::get('/products/edit/{product}',[ProductController::class,'edit'])->name('products.edit')->middleware('auth');
Route::post('/products/{product}',[ProductController::class,'update'])->name('products.update')->middleware('auth');
Route::get('/products/show/{product}',[ProductController::class,'show'])->name('products.show')->middleware('auth');
Route::delete('/products/{product}',[ProductController::class,'destroy'])->name('products.destroy')->middleware('auth');
Route::get('/products/trashed-products', [ProductController::class, 'trashedProducts'])->name('products.trash')->middleware('auth');
Route::get('/products/restored-product/{product}', [ProductController::class, 'restore'])->name('products.restore')->middleware('auth');
Route::delete('/products/delete-permanently/{id}', [ProductController::class, 'destroyPermanently'])->name('products.destroyPermanently')->middleware('auth');


//Route::resource('products', ProductController::class);


Route::get('/users', [UserController::class, 'index'])->middleware('auth');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
