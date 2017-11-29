<?php
//Auth::routes();

// region Autentificare

Route::post('login', 'AuthenticationController@login');
Route::post('register', 'AuthenticationController@register');
Route::post('logout', 'AuthenticationController@logout');

// endregion

// region Notification
Route::post('notification/get', 'NotificationController@notifications');
Route::post('notification', 'NotificationController@toggle');
Route::post('notification/toggleReadAll', 'NotificationController@toggleReadAll');
// endregion

// region Setttings
Route::post('user/update', 'UserController@updateData');
Route::post('user/update/password', 'UserController@updatePassword');
Route::post('user/update/profile', 'UserController@updateProfile');
Route::post('user/update/profileImage', 'UserController@updateProfileImage');
// endregion

// region Mentor stuff
Route::post('user/mentor/register', 'UserController@becomeMentor');
// endregion

Route::post('user', 'UserController@user');

// region Course
Route::post('course/add', 'CourseController@add');
// endregion



Route::get('/', function(){
    return view('index');
});