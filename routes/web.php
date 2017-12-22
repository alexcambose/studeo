<?php
//Auth::routes();


Route::post('login', 'AuthenticationController@login');
Route::post('register', 'AuthenticationController@register');
Route::post('logout', 'AuthenticationController@logout');

Route::prefix('notification')->group(function () {
    Route::post('/', 'NotificationController@notifications'); // luate toate notificarile
    Route::post('toggle', 'NotificationController@toggle'); // marcheaza o notificare ca vazuta/nevazuta
    Route::post('toggleReadAll', 'NotificationController@toggleReadAll'); // marcheaza toate notificarile ca vazute/nevazute
});

Route::prefix('user')->group(function () {
    Route::post('{id?}', 'UserController@user'); // luare date user
    Route::post('update', 'UserController@updateData'); // actualizare informatii cont
    Route::post('update/password', 'UserController@updatePassword'); // actualizare  parola
    Route::post('update/profile', 'UserController@updateProfile'); // actualizare  informatii profil
    Route::post('update/profileImage', 'UserController@updateProfileImage'); // actualizare imagine profil
    Route::post('mentor/register', 'UserController@becomeMentor'); // inregistrare ca mentor
});


Route::prefix('course')->group(function () {
    Route::post('add', 'CourseController@add'); // adaugare curs
    Route::get('tags', 'TagController@all');  // luare taguri disponibile
    Route::get('find/{query?}', 'CourseController@find'); // cautare cursuri
    Route::get('all/{userId?}', 'CourseController@all'); //toate cursurile unui user, daca userId nu e specificat, toate cursurile
    Route::get('slug/{slug}', 'CourseController@one'); // luare curs dupa slug
    Route::get('slug/best/{slug}', 'CourseController@bestSlug'); // determinare cel mai bun slug pentru curs, luindu-ne dupa un slug existent (un pic bullshit si useless)
    Route::post('user/join/', 'CourseController@userJoin'); // course user join
    Route::post('user/note/add/{course}', 'NoteController@add'); // adaugare notita curs
    Route::post('user/note/update/{note}', 'NoteController@update'); // actulizare notita curs
    Route::delete('user/note/delete/{note}', 'NoteController@delete'); // stergere notita curs
    Route::post('user/lesson/watched/{lesson}', 'LessonController@watched'); // marcare lectie ca vazuta
});
Route::prefix('lesson')->group(function () {
    Route::get('all/{course}', 'LessonController@all'); // luare toate lectiile de la un curs
});

Route::prefix('playlist')->group(function () {
    Route::post('/', 'PlaylistController@getAllPlaylists'); // luare toate playlist-urile
    Route::post('create', 'PlaylistController@createPlaylist'); // creare playlist
});
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
Route::post('playlist/update/{id}', 'PlaylistController@updatePlaylist');
Route::delete('playlists/delete/{playlistId}', 'PlaylistController@deletePlaylist');
//endregion


Route::get('/', function(){
    return view('index');
});