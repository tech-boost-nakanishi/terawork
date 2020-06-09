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

Route::get('/', 'RecruitController@top');

Route::get('/about', function(){
	return view('about');
});

Route::get('/profile/show/{id}', 'ApplyController@profile');

Route::group(['middleware' => 'auth:user'], function() {
	Route::get('/dashboard', 'ApplyController@index');
	Route::get('/profile/edit/{id}', 'ApplyController@profileedit');
	Route::post('/profile/edit/{id}', 'ApplyController@profileupdate');
	Route::get('/list/applies/{id}', 'ApplyController@applylist');
	Route::get('/list/views/{id}', 'ApplyController@viewlist');
	Route::get('/list/favorites/{id}', 'ApplyController@favoritelist');
	Route::get('changepassword', 'HomeController@showChangePasswordForm');
	Route::post('changepassword', 'HomeController@changePassword')->name('user.changepassword');
	Route::get('/logout', 'Auth\LoginController@logout');
});

Route::group(['prefix' => 'corporate'], function() {

	Route::group(['middleware' => 'auth:corporate'], function() {
		Route::get('/dashboard', 'CorporateController@index')->name('corporate.dashboard');
		Route::get('/recruit/create', 'RecruitController@add');
		Route::post('/recruit/create', 'RecruitController@create');
		Route::get('/recruit/edit/{id}', 'RecruitController@edit')->name('recruit.edit');
		Route::post('/recruit/edit/{id}', 'RecruitController@update');
		Route::get('/profile/edit/{id}', 'RecruitController@profileedit');
		Route::post('/profile/edit/{id}', 'RecruitController@profileupdate');
		Route::get('/recruit/delete/{id}', 'RecruitController@delete');
		Route::get('changepassword', 'HomeController@showChangePasswordForm');
		Route::post('changepassword', 'HomeController@changePassword')->name('corporate.changepassword');
		Route::get('/logout', 'CorporateController@logout');
	});

	Route::group(['middleware' => 'auth:user'], function() {
		Route::get('/recruit/favorite/{id}', 'ApplyController@favorite');
		Route::get('/recruit/apply/{id}', 'ApplyController@pre_apply');
		Route::post('/recruit/apply/{id}', 'ApplyController@apply');
	});

	Route::get('/login', 'Auth\CorporateLoginController@showLoginForm')->name('corporate.login');
    Route::post('/login', 'Auth\CorporateLoginController@login')->name('corporate.login.submit');
    Route::get('/register', 'Auth\CorporateRegisterController@showRegistrationForm')->name('corporate.register');
    Route::post('/register', 'Auth\CorporateRegisterController@register')->name('corporate.register.submit');

    Route::get('/recruit/show/{id}', 'RecruitController@show');
    Route::get('/recruit/language/{language}', 'RecruitController@languagelist');
    Route::get('/recruit/search', 'RecruitSearchController@search');
    Route::get('/profile/show/{id}', 'RecruitController@profile');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
