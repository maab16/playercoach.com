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

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');

Route::group(['domain' => 'facility.playercoach.com'], function(){
	Route::get('register', 'Facility\AuthController@showTenantRegisterForm');
	Route::post('register', 'Facility\AuthController@register');
});