<?php
//Renuntam la pachetul standard de auth si il refacem manual
//Auth::routes();

// region Autentificare

Route::post('login', 'AuthenticationController@login');
Route::post('register', 'AuthenticationController@register');
Route::post('logout', 'AuthenticationController@logout');

// endregion

Route::post('user', 'UserController@user');


Route::get('/', function(){
    return view('index');
});