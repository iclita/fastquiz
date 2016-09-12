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
Route::get('change-language', 'HomeController@changeLanguage')->name('change-language');
Route::get('/', 'HomeController@home')->name('home');

// Articles management
Route::group(['prefix' => 'articles'], function () {
	Route::get('/create', 'ArticleController@create')->name('create-article');
	Route::post('/store', 'ArticleController@store')->name('store-article');
	Route::get('/{id}/edit', 'ArticleController@edit')->name('edit-article');
	Route::post('/{id}/update', 'ArticleController@update')->name('update-article');
	Route::post('/delete', 'ArticleController@delete')->name('delete-article');
	Route::get('/', 'ArticleController@index')->name('articles');
});

// Questions management
Route::group(['prefix' => 'questions'], function () {
	Route::get('/create', 'QuestionController@create')->name('create-question');
	Route::post('/store', 'QuestionController@store')->name('store-question');
	Route::get('/{id}/edit', 'QuestionController@edit')->name('edit-question');
	Route::post('/{id}/update', 'QuestionController@update')->name('update-question');
	Route::post('/delete', 'QuestionController@delete')->name('delete-question');
	Route::get('/', 'QuestionController@index')->name('questions');
});

// Admin area (Security measures need to be taken)
Route::group(['prefix' => env('ADMIN_ROUTE')], function () {
    // Auth
    Route::get('login', 'AdminController@getLogin')->name('admin.get.login');
    Route::post('login', 'AdminController@postLogin')->name('admin.post.login');
    Route::get('logout', 'AdminController@getLogout')->name('admin.get.logout');
    // Dashboard
    Route::get('dashboard', 'AdminController@dashboard')->name('admin.get.dashboard');
    // Articles
    Route::get('articles', 'AdminController@getArticles')->name('admin.get.articles');
    Route::get('article-status/{id}', 'AdminController@changeArticleStatus')->name('admin.article.status');
    Route::get('questions', 'AdminController@getQuestions')->name('admin.get.questions');
});

