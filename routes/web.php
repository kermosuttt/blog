<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/post/{post:slug}', [PublicController::class, 'post'])->name('post');
Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');
Route::get('/user/{user}', [PublicController::class, 'user'])->name('user');
Route::get('/category/{category}', [PublicController::class, 'category'])->name('category');

Route::resource('posts', PostController::class);

Route::middleware(['auth', 'verified'])->group(function (){
    Route::post('/post/{post}/like', [PublicController::class, 'like'])->name('like');
    Route::post('/user/{user}/follow', [PublicController::class, 'follow'])->name('follow');
    Route::post('/post/{post}/comment', [PublicController::class, 'comment'])->name('comment');

    // Route::get('/admin/posts', [PostController::class, 'index'])->name('posts.index');
    // Route::get('/admin/posts/create', [PostController::class, 'create'])->name('posts.create');
    // Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');
    // Route::get('/admin/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    // Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    // Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    // Route::delete('/admin/posts{title}/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    // Route::resource('posts', PostController::class);
});


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
