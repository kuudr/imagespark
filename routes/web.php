<?php

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

Route::get('/', \App\Http\Controllers\MainController::class . '@show' );
Route::get('/essence', \App\Http\Controllers\EssenceController::class . '@show' );
Route::resource('/users', \App\Http\Controllers\UsersController::class);
Route::resource('/articles', \App\Http\Controllers\ArticlesController::class);
Route::post('/articles/{article}/rating', \App\Http\Controllers\ArticlesController::class . '@rating')->name('articles.rating');
