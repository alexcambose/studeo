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
    Route::post('update', 'UserController@updateData'); // actualizare informatii cont
    Route::post('update/password', 'UserController@updatePassword'); // actualizare  parola
    Route::post('update/profile', 'UserController@updateProfile'); // actualizare  informatii profil
    Route::post('update/profileImage', 'UserController@updateProfileImage'); // actualizare imagine profil
    Route::post('mentor/register', 'UserController@becomeMentor'); // inregistrare ca mentor
    Route::get('post/{username}', 'PostController@all'); // luare toate postarile de la un user
    Route::post('post', 'PostController@add'); // adaugare post nou
    Route::post('{id?}', 'UserController@user'); // luare date user todo refactor
});

Route::prefix('course')->group(function () {
    Route::post('add', 'CourseController@add'); // adaugare curs
    Route::get('tag', 'TagController@all');  // luare taguri disponibile
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
    Route::post('update/{id}', 'PlaylistController@updatePlaylist');
    Route::delete('delete/{playlistId}', 'PlaylistController@deletePlaylist');
    Route::put('{playlist}/addCourse/{course}', 'PlaylistController@addCourse'); // adaugare curs in playlist
    Route::delete('{playlist}/addCourse/{course}', 'PlaylistController@deleteCourse'); // stergere curs din playlist
});
Route::prefix('achievement')->group(function () {
    Route::get('', 'AchievementController@all');  // luare achievement-uri disponibile
});

Route::get('/', function(){
    return view('index');
});