<?php

use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

// Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::resource('/posts', PostController::class);

Route::get('like/{postid}', [LikeController::class, 'like'])->name('like');

Route::get('/users/{username}', [UserController::class, 'profile'])->name('profile');
Route::get('/users/{id}/grant-admin-permissions', [UserController::class, 'grantAdmin'])->name('grantAdminPermissions');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
