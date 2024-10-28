<?php

use App\Http\Controllers\FollowsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts/{post}/notification', [PostsController::class, 'renderNotification']);
//    Route::get('/posts/create', [PostsController::class, 'create']);
    Route::put('/posts', [PostsController::class, 'store']);
    Route::get('/posts/{post}', [PostsController::class, 'show']);
    Route::delete('/posts/{post}', [PostsController::class, 'destroy']);

    Route::post('/authors/{author}/follows', [FollowsController::class, 'store']);
    Route::delete('/authors/{author}/follows', [FollowsController::class, 'destroy']);
});

require __DIR__.'/auth.php';
