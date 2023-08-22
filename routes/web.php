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
Auth::routes(['verify' => true]);
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);


    Route::get('/', \App\Http\Controllers\Main\IndexController::class)->name('main.index');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::prefix('personal')->group(function () {
        Route::get('/', \App\Http\Controllers\Personal\Main\IndexController::class)->name('personal.main.index');

        Route::prefix('liked')->group(function () {
            Route::get('/', \App\Http\Controllers\Personal\Liked\IndexController::class)->name('personal.liked.index');
            Route::delete('/{post}', \App\Http\Controllers\Personal\Liked\DeleteController::class)->name('personal.liked.delete');
        });
        Route::prefix('comment')->group(function () {
            Route::get('/', \App\Http\Controllers\Personal\Comment\IndexController::class)->name('personal.comment.index');
            Route::get('/{comment}/edit', \App\Http\Controllers\Personal\Comment\EditController::class)->name('personal.comment.edit');
            Route::patch('/{comment}', \App\Http\Controllers\Personal\Comment\UpdateController::class)->name('personal.comment.update');
            Route::delete('/{comment}', \App\Http\Controllers\Personal\Comment\DeleteController::class)->name('personal.comment.delete');
        });
    });
});


Route::group(['middleware' => ['auth', 'admin', 'verified']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\Main\IndexController::class)->name('admin.main.index');
        Route::prefix('post')->group(function () {
            Route::get('/', \App\Http\Controllers\Admin\Post\IndexController::class)->name('admin.post.index');
            Route::get('/create', \App\Http\Controllers\Admin\Post\CreateController::class)->name('admin.post.create');
            Route::post('/', \App\Http\Controllers\Admin\Post\StoreController::class)->name('admin.post.store');
            Route::get('/{post}', \App\Http\Controllers\Admin\Post\ShowController::class)->name('admin.post.show');
            Route::get('/{post}/edit', \App\Http\Controllers\Admin\Post\EditController::class)->name('admin.post.edit');
            Route::patch('/{post}', \App\Http\Controllers\Admin\Post\UpdateController::class)->name('admin.post.update');
            Route::delete('/{post}', \App\Http\Controllers\Admin\Post\DeleteController::class)->name('admin.post.delete');
        });


        Route::prefix('category')->group(function () {
            Route::get('/', \App\Http\Controllers\Admin\Category\IndexController::class)->name('admin.category.index');
            Route::get('/create', \App\Http\Controllers\Admin\Category\CreateController::class)->name('admin.category.create');
            Route::post('/', \App\Http\Controllers\Admin\Category\StoreController::class)->name('admin.category.store');
            Route::get('/{category}', \App\Http\Controllers\Admin\Category\ShowController::class)->name('admin.category.show');
            Route::get('/{category}/edit', \App\Http\Controllers\Admin\Category\EditController::class)->name('admin.category.edit');
            Route::patch('/{category}', \App\Http\Controllers\Admin\Category\UpdateController::class)->name('admin.category.update');
            Route::delete('/{category}', \App\Http\Controllers\Admin\Category\DeleteController::class)->name('admin.category.delete');
        });

        Route::prefix('tag')->group(function () {
            Route::get('/', \App\Http\Controllers\Admin\Tag\IndexController::class)->name('admin.tag.index');
            Route::get('/create', \App\Http\Controllers\Admin\Tag\CreateController::class)->name('admin.tag.create');
            Route::post('/', \App\Http\Controllers\Admin\Tag\StoreController::class)->name('admin.tag.store');
            Route::get('/{tag}', \App\Http\Controllers\Admin\Tag\ShowController::class)->name('admin.tag.show');
            Route::get('/{tag}/edit', \App\Http\Controllers\Admin\Tag\EditController::class)->name('admin.tag.edit');
            Route::patch('/{tag}', \App\Http\Controllers\Admin\Tag\UpdateController::class)->name('admin.tag.update');
            Route::delete('/{tag}', \App\Http\Controllers\Admin\Tag\DeleteController::class)->name('admin.tag.delete');
        });

        Route::prefix('user')->group(function () {
            Route::get('/', \App\Http\Controllers\Admin\User\IndexController::class)->name('admin.user.index');
            Route::get('/create', \App\Http\Controllers\Admin\User\CreateController::class)->name('admin.user.create');
            Route::post('/', \App\Http\Controllers\Admin\User\StoreController::class)->name('admin.user.store');
            Route::get('/{user}', \App\Http\Controllers\Admin\User\ShowController::class)->name('admin.user.show');
            Route::get('/{user}/edit', \App\Http\Controllers\Admin\User\EditController::class)->name('admin.user.edit');
            Route::patch('/{user}', \App\Http\Controllers\Admin\User\UpdateController::class)->name('admin.user.update');
            Route::delete('/{user}', \App\Http\Controllers\Admin\User\DeleteController::class)->name('admin.user.delete');
        });
    });
});

