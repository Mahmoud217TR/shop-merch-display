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
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'rest' => false,
    'verify' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::controller(ProductController::class)->prefix('product')->middleware('auth')->group(function(){
    Route::get('/','index')->name('product.index');
    Route::post('/','store')->name('product.store');
    Route::patch('/','update')->name('product.update');
    Route::delete('/','destroy')->name('product.destroy');
});