<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/post/{post}', [PublicController::class, 'post'])->name('post');
Route::get('/admin/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/admin/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/admin/posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/secure', function () {
    return view('secure');
})->middleware(['auth', 'verified', 'password.confirm'])->name('secure');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';