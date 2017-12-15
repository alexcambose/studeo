<?php
//Auth::routes();

Route::post('user/{id?}', 'UserController@user');

// region Autentificare

Route::post('login', 'AuthenticationController@login');
Route::post('register', 'AuthenticationController@register');
Route::post('logout', 'AuthenticationController@logout');

// endregion

// region Notification
Route::post('notification', 'NotificationController@notifications');
Route::post('notification/toggle', 'NotificationController@toggle');
Route::post('notification/toggleReadAll', 'NotificationController@toggleReadAll');
// endregion

// region Settings
Route::post('user/update', 'UserController@updateData');
Route::post('user/update/password', 'UserController@updatePassword');
Route::post('user/update/profile', 'UserController@updateProfile');
Route::post('user/update/profileImage', 'UserController@updateProfileImage');
// endregion

// region Mentor stuff
Route::post('user/mentor/register', 'UserController@becomeMentor');
// endregion

// region Course
Route::get('course/all/{userId?}', 'CourseController@all');
Route::get('course/slug/{slug}', 'CourseController@one');
Route::get('course/slug/best/{slug}', 'CourseController@bestSlug');
Route::post('course/add', 'CourseController@add');
Route::post('course/user/join/', 'CourseController@userJoin');
Route::post('course/user/note/add/{course}', 'NoteController@add');
Route::post('course/user/note/update/{note}', 'NoteController@update');
Route::delete('course/user/note/delete/{note}', 'NoteController@delete');
Route::post('course/user/lesson/watched/{lesson}', 'LessonController@watched');

Route::get('lesson/all/{course}', 'LessonController@all');
// endregion


// region Playlist
Route::post('playlists', 'PlaylistController@getAllPlaylists');
Route::post('playlists/create', 'PlaylistController@createPlaylist');
//endregion


Route::get('/', function(){
    return view('index');
});