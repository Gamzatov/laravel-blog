<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Web\PostController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'posts');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', AdminMiddleware::class],
    'as' => 'admin.'
],

    function () {
        Route::get('/', [AdminController::class, 'index'])
            ->name('index');
        Route::resource('categories', CategoryController::class)
            ->except('show');
    });
Route::resource('posts', PostController::class);

require __DIR__ . '/auth.php';

