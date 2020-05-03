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

Route::get('/', function () {
    return view('top');
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/logout', 'HomeController@logout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'corporate'], function() {
    Route::get('/login', 'Auth\CorporateLoginController@showLoginForm')->name('corporate.login');
    Route::post('/login', 'Auth\CorporateLoginController@login')->name('corporate.login.submit');
    Route::get('/register', 'Auth\CorporateRegisterController@showRegistrationForm')->name('corporate.register');
    Route::post('/register', 'Auth\CorporateRegisterController@register')->name('corporate.register.submit');
    Route::get('/', 'CorporateController@index')->name('corporate.dashboard');
});
