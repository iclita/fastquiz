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

Route::get('login', 'HomeController@login')->name('login');
Route::get('logout', 'HomeController@logout')->name('logout');
Route::get('redirect', 'HomeController@redirectToProvider')->name('redirect');
Route::get('callback', 'HomeController@handleProviderCallback')->name('callback');
Route::get('/', 'HomeController@home')->name('home');
