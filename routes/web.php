<?php

use App\Exports\ProductsExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorySearchController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSearchController;
use App\Http\Controllers\SettingsController;
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
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'rest' => false,
    'verify' => false,
]);

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::controller(AdminController::class)->prefix('admin')->middleware('auth')->group(function(){
    Route::get('/category','category')->name('admin.category');
    Route::get('/product','product')->name('admin.product');
});

Route::controller(SettingsController::class)->prefix('settings')->middleware('auth')->group(function(){
    Route::get('/', [SettingsController::class, 'index'])->name('settings');
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