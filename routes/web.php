<?php

use App\Http\Controllers\PostsController;
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

Route::get('/', [PostsController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // render create page
    Route::get('/posts/create', [PostsController::class, 'create'])->name('home.create');

    // Post user's post
    Route::post('/posts', [PostsController::class, 'store'])->name('home.create.a.post');

    // Show edit post
    Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('home.edit');

    // PUT user's post
    Route::put('/posts/{post}', [PostsController::class, 'update'])->name('edit.update');

    // DELETE user's post
    Route::delete('/posts/{post}', [PostsController::class, 'delete']);

    // render manage posts
    Route::get('/posts/manage', [PostsController::class, 'manage'])->name('mangage');

    // render listing page
});

Route::get('/posts/{post}', [PostsController::class, 'show']);
