<?php

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

Route::get('/', 'ArticleController@getHomePage')->name('home');
Route::get('/chi-tiet/{slug}', 'ArticleController@getDetailPage')->name('detail');
Route::get('/the-tag/{tag}', 'ArticleController@getTagPage')->name('tags');
Route::get('/tim-kiem', 'ArticleController@getSearchPage')->name('search');
