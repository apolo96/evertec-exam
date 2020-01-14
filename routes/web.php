<?php

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

use App\Http\Controllers\OrderController;

Route::get('/', function () {  return view('order.welcome'); })->name('order.new');

Route::prefix('order')->name('order.')->group(function(){
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::post('store', [OrderController::class, 'store'])->name('store');
    Route::get('summary/{order}', [OrderController::class, 'summary'])->name('summary');
    Route::get('{order}', [OrderController::class, 'show'])->name('show')->where('id', '[0-9]+');
});
