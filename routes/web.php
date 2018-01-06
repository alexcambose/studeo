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
    Route::get('get/{userId?}', 'UserController@user'); // luare date user, daca username este specificat atunci datele user-ului cu username-ul
    Route::get('get/username/{username}', 'UserController@userByUsername'); // luare date user, daca username este specificat atunci datele user-ului cu username-ul
    Route::get('recommended/{amount?}', 'UserController@recommended'); // luare date user, daca username este specificat atunci datele user-ului cu username-ul
    Route::get('activity/{user}', 'UserController@activity'); // luare activitate user
    Route::post('update', 'UserController@updateData'); // actualizare informatii cont
    Route::post('update/password', 'UserController@updatePassword'); // actualizare  parola
    Route::post('update/profile', 'UserController@updateProfile'); // actualizare  informatii profil
    Route::post('update/profileImage', 'UserController@updateProfileImage'); // actualizare imagine profil
    Route::post('mentor/register', 'UserController@becomeMentor'); // inregistrare ca mentor
    Route::get('post/{username}', 'PostController@all'); // luare toate postarile de la un user
    Route::post('post', 'PostController@add'); // adaugare post nou
    Route::put('post/{post}', 'PostController@update'); // actualizare post
    Route::delete('post/{post}', 'PostController@delete'); // stergere post
    Route::post('post/{post}/like', 'PostController@toggleLike'); // like/unlike post
    Route::get('share/{user}', 'UserController@shareAll'); // luate toate cursurile distribuite de un user
    Route::post('share/{course}', 'UserController@shareAdd'); // adaugare distribuire curs
    Route::delete('share/{id}', 'UserController@shareRemove'); // stargere distribuire curs
    Route::put('report', 'UserController@report'); // adaugare raport user
});

Route::prefix('course')->group(function () {
    Route::post('add', 'CourseController@add'); // adaugare curs
    Route::get('tag', 'TagController@all');  // luare taguri disponibile
    Route::get('all/{userId?}', 'CourseController@all'); //toate cursurile unui user, daca userId nu e specificat, toate cursurile
    Route::get('slug/{slug}', 'CourseController@one'); // luare curs dupa slug
    Route::get('id/{id}', 'CourseController@oneById'); // luare curs dupa id
    Route::get('slug/best/{slug}', 'CourseController@bestSlug'); // determinare cel mai bun slug pentru curs, luandu-ne dupa un slug existent (un pic bullshit si useless)
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
    Route::get('/all', 'AchievementController@all');  // luare achievement-uri disponibile
    Route::get('user/{user}', 'AchievementController@user');  // luare achievement-urile unui user
});

Route::prefix('avatar')->group(function () {
    Route::get('/all', 'AvatarController@all');  // luare avatar-uri disponibile
//    Route::get('user/{user}', 'AvatarController@user');  // luare avatar-urile unui user
    Route::post('buy/{avatar}', 'AvatarController@buy');  // cumparare avatar
    Route::post('activate/{avatar}', 'AvatarController@activate');  // activare avatar
});

Route::prefix('path')->group(function () {
   Route::get('/all', 'PathController@all'); //luare toate path-urile
   Route::get('/get/{path}', 'PathController@pathById'); //luare date unui singur path
});

Route::get('/', function(){
    return view('index');
});