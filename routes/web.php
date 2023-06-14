<?php

use App\Http\Controllers\FAQCategory;
use App\Http\Controllers\FAQCategoryController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// user routes
Route::get('/users/{username}', [UserController::class, 'profile'])->name('profile');
Route::get('/settings/profile', [UserController::class, 'edit'])->name('user.edit');
Route::put('/settings/profile/update', [UserController::class, 'update'])->name('user.update');
Route::get('/users/{id}/grant-admin-permissions', [UserController::class, 'grantAdmin'])->name('grantAdminPermissions');

// post routes
Route::resource('/posts', PostController::class);

// like routes
Route::get('like/{postid}', [LikeController::class, 'like'])->name('like');

// FAQ routes
Route::get('FAQ',   [FAQCategoryController::class, 'index'])->name('FAQs');

Auth::routes();
