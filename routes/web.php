<?php

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
Auth::routes();
Route::name('main.')->group(function() {
    Route::get('/', \App\Http\Controllers\Main\IndexController::class);
});

Route::prefix('admin')->group(function (){
    Route::name('main')->group(function() {
        Route::get('/', \App\Http\Controllers\Admin\Main\IndexController::class)->name('main.index');
});
    Route::prefix('categories')->group(function (){
    Route::name('Category')->group(function() {
        Route::get('/', \App\Http\Controllers\Admin\Category\IndexController::class);
    });
        Route::get('/create', \App\Http\Controllers\Admin\Category\CreateController::class)->name('admin.category.create');
    });
});


