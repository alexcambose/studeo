<?php
//Renuntam la pachetul standard de auth si il refacem manual
//Auth::routes();

// region Autentificare

Route::post('login', 'AuthenticationController@login');
Route::post('register', 'AuthenticationController@register');
Route::post('logout', 'AuthenticationController@logout');

// endregion

/* region Notification */

Route::post('notification', 'NotificationController@toggle');

/* endregion */

Route::post('user', 'UserController@user');
Route::post('user/update', 'UserController@updateData');
Route::post('user/update/password', 'UserController@updatePassword');


Route::get('/', function(){
    return view('index');
});