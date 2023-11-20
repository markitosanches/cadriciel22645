<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;


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


Route::get('/home', [BlogController::class, 'index'])->name('home');
Route::get('/about', [BlogController::class, 'about'])->name('about');
Route::get('/article', [BlogController::class, 'article'])->name('article');
Route::get('/contact', [BlogController::class, 'contact'])->name('contact');
Route::post('/contact', [BlogController::class, 'message'])->name('contact');

