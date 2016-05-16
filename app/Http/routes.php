<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Home page and authentication
Route::get('login', 'HomeController@login')->name('login');
Route::get('logout', 'HomeController@logout')->name('logout');
Route::get('register', 'HomeController@redirectToProvider')->name('register');
Route::get('callback', 'HomeController@handleProviderCallback')->name('callback');
Route::get('/', 'HomeController@home')->name('home');

// Articles management
Route::get('article/create', 'ArticleController@create')->name('create-article');
Route::post('article/store', 'ArticleController@store')->name('store-article');
Route::get('article/{id}/edit', 'ArticleController@edit')->name('edit-article');
Route::post('article/{id}/update', 'ArticleController@update')->name('update-article');
Route::post('article/delete', 'ArticleController@delete')->name('delete-article');
Route::get('articles', 'ArticleController@index')->name('articles');
