<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return redirect('/home');
})->name('home');
Route::get('/home', 'App\Http\Controllers\GuestController@index')->name('guest.home');
Route::get('/home/articles/{id}', 'App\Http\Controllers\GuestController@show')->name('guest.articles.show');

Auth::routes();

Route::resource('articles', 'App\Http\Controllers\ArticleController')->middleware('auth');
Route::resource('categories', 'App\Http\Controllers\CategoryController')->middleware('auth');

Route::post('/article_config', 'App\Http\Controllers\ServiceController@getConfigAjax')->name('article.config')->middleware('auth');