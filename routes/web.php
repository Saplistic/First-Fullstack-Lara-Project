<?php

use App\Http\Controllers\FAQCategoryController;
use App\Http\Controllers\FAQQuestionController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// user
Route::get('/users/{username}', [UserController::class, 'profile'])->name('profile');
Route::get('/settings/profile', [UserController::class, 'edit'])->name('user.edit');
Route::put('/settings/profile/update', [UserController::class, 'update'])->name('user.update');
Route::get('/users/{id}/grant-admin-permissions', [UserController::class, 'grantAdmin'])->name('grantAdminPermissions');

// post
Route::resource('/posts', PostController::class);

// like
Route::get('like/{postid}', [LikeController::class, 'like'])->name('like');
Route::get('like/destroy/{postid}', [LikeController::class, 'destroy'])->name('like.destroy');

// FAQ
Route::get('FAQ',   [FAQCategoryController::class, 'index'])->name('FAQs');
Route::post('FAQ/category/store',   [FAQCategoryController::class, 'store'])->name('FAQs.category.store');
Route::put('FAQ/category/update/{id}',   [FAQCategoryController::class, 'update'])->name('FAQs.category.update');
Route::get('FAQ/category/destroy/{id}',   [FAQCategoryController::class, 'destroy'])->name('FAQs.category.destroy');

Route::get('FAQ/create/{category}', [FAQQuestionController::class, 'create'])->name('FAQ.create');
Route::post('FAQ/store/{category}', [FAQQuestionController::class, 'store'])->name('FAQ.store');
Route::get('FAQ/edit/{id}', [FAQQuestionController::class, 'edit'])->name('FAQ.edit');
Route::put('FAQ/update/{id}', [FAQQuestionController::class, 'update'])->name('FAQ.update');
Route::get('FAQ/destroy/{id}', [FAQQuestionController::class, 'destroy'])->name('FAQ.destroy');

// about
Route::get('/about', function () {
    return view('about');
})->name('about');

// contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Auth::routes();