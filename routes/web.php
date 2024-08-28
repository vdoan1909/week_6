<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::prefix('/')
    ->as('client.')
    ->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });

        Route::group(['middleware' => 'auth'], function () {
            Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
            Route::post('/post', [App\Http\Controllers\PostController::class, 'searchPostByTitle'])->name('searchPostByTitle');
            Route::post('/tag', [App\Http\Controllers\PostController::class, 'searchPostByTag'])->name('searchPostByTag');

            Route::prefix('tag')
                ->as('tag.')
                ->group(function () {
                    Route::get('/', [TagController::class, 'index'])->name('index');
                    Route::get('create', [TagController::class, 'create'])->name('create');
                    Route::post('store', [TagController::class, 'store'])->name('store');
                    Route::get('edit/{id}', [TagController::class, 'edit'])->name('edit');
                    Route::put('update/{id}', [TagController::class, 'update'])->name('update');
                    Route::delete('destroy/{id}', [TagController::class, 'destroy'])->name('destroy');
                });

            Route::prefix('post')
                ->as('post.')
                ->group(function () {
                    Route::get('create', [PostController::class, 'create'])->name('create');
                    Route::post('store', [PostController::class, 'store'])->name('store');
                    Route::get('show/{slug}', [PostController::class, 'show'])->name('show');
                    Route::get('edit/{slug}', [PostController::class, 'edit'])->name('edit');
                    Route::put('update/{slug}', [PostController::class, 'update'])->name('update');
                    Route::delete('destroy/{slug}', [PostController::class, 'destroy'])->name('destroy');
                });

            Route::prefix('profile')
                ->as('profile.')
                ->group(function () {
                    Route::get('/', [UserController::class, 'show'])->name('show');
                    Route::get('edit', [UserController::class, 'edit'])->name('edit');
                    Route::put('update', [UserController::class, 'update'])->name('update');
                });
        });
    });

