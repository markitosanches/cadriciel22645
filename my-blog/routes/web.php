<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\LocalizationController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show');
Route::get('/blog-create', [BlogPostController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('/blog-create', [BlogPostController::class, 'store'])->name('blog.store')->middleware('auth');
Route::get('/blog-edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit')->middleware('auth');
Route::put('/blog-edit/{blogPost}', [BlogPostController::class, 'update'])->middleware('auth');
Route::delete('/blog/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.delete')->middleware('auth');
Route::get('/query', [BlogPostController::class, 'query']);
Route::get('/blog-page', [BlogPostController::class, 'pagination']);
Route::get('/blog-pdf/{blogPost}', [BlogPostController::class, 'showPdf'])->name('blog.showPdf');

Route::get('/registration',[CustomAuthController::class, 'create'])->name('registration')->middleware('can:create-users');
Route::post('/registration',[CustomAuthController::class, 'store']);
Route::get('/login',[CustomAuthController::class, 'index'])->name('login');
Route::post('/authentication',[CustomAuthController::class, 'authentication'])->name('authentication');
Route::get('/logout',[CustomAuthController::class, 'logout'])->name('logout');
Route::get('/user-list',[CustomAuthController::class, 'userList'])->name('user.list')->middleware('auth');
Route::get('/forgot-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [CustomAuthController::class, 'tempPassword'])->name('temp.password');
Route::get('/new-password/{user}/{tempPassword}', [CustomAuthController::class, 'newPassword'])->name('new.password');
Route::post('/new-password/{user}/{tempPassword}', [CustomAuthController::class, 'storeNewPassword']);
Route::get('/lang/{locale}', [LocalizationController::class, 'index'])->name('lang');



// https://kinsta.com/blog/laravel-performance/
