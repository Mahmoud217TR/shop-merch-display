<?php

use App\Exports\ProductsExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorySearchController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSearchController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

Auth::routes([
    'register' => false,
    'rest' => false,
    'verify' => false,
]);

Route::controller(WelcomeController::class)->group(function(){
    Route::get('/','index')->name('welcome');
    Route::get('/welcome/products','products')->name('welcome.products');
    Route::get('/welcome/search','search')->name('welcome.search');
});

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::controller(AdminController::class)->prefix('admin')->middleware('auth')->group(function(){
    Route::get('/category','category')->name('admin.category');
    Route::get('/product','product')->name('admin.product');
});

Route::controller(SettingsController::class)->prefix('settings')->middleware('auth')->group(function(){
    Route::get('/', 'index')->name('settings');
});

Route::controller(UserController::class)->prefix('user')->middleware('auth')->group(function(){
    Route::patch('/','update')->name('user.update');
});


Route::controller(CategoryController::class)->prefix('category')->middleware('auth')->group(function(){
    Route::get('/','index')->name('category.index');
    Route::post('/','store')->name('category.store');
    Route::patch('/','update')->name('category.update');
    Route::delete('/','destroy')->name('category.destroy');
});

Route::controller(CategorySearchController::class)->prefix('search/category')->middleware('auth')->group(function(){
    Route::get('/','search')->name('category.search');
});

Route::controller(ProductController::class)->prefix('product')->middleware('auth')->group(function(){
    Route::get('/','index')->name('product.index');
    Route::post('/','store')->name('product.store');
    Route::patch('/','update')->name('product.update');
    Route::delete('/','destroy')->name('product.destroy');
});

Route::controller(ProductSearchController::class)->prefix('search/product')->middleware('auth')->group(function(){
    Route::get('/','search')->name('product.search');
});

Route::get('/export', [ExportController::class, 'export'])->name('product.export');
Route::post('/image/{product}', [ImageUploadController::class, 'store'])->middleware('auth')->name('product.image.store');