<?php

namespace App\Http\Controllers;

use App\Course;
use App\Playlist;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    //

    public function getAllPlaylists() {
        $userId = Auth::id();
        $playlists = Playlist::where('user_id', $userId)->get();
        return response()->json([
            'success' => true,
            'playlists' => $playlists,
        ]);
    }

    public function all($playlistId) {
        return response()->json([
            'success' => true,
            'playlists' => Course::find($playlistId)->courses,
        ]);
    }

    public function createPlaylist(Request $request) { // dafuq validation
        $playlist = new Playlist();
        $user = Auth::user();

        $validation = Validator::make($request->all(), [
            'title' => Playlist::$rules['title'],
            'description' => Playlist::$rules['description'],
        ]);
        if ($validation->fails()) return response()->json(['success' => false]);

        $playlist->title = $request->title;
        $playlist->description = $request->description;
        $playlist->user_id = $user->id;
        $playlist->color = $request->color;
        $playlist->image_id = 1; // ceva default

        $playlist->save();

        return response()->json([
            'success' => true,
            'playlist' => $playlist,
        ]);
    }

    public function updatePlaylist(Request $request, $id) {
        $playlist = Playlist::find($id);

        $validation = Validator::make($request->all(), [
            'title' => Playlist::$rules['title'],
            'description' => Playlist::$rules['description'],
        ]);

        if($validation->fails()) return response()->json(['success' => 'false']);

        $playlist->title = $request->title;
        $playlist->description = $request->description;
        $playlist->color = $request->color;

        $playlist->save();

        return response()->json(['success' => true]);
    }

    public function deletePlaylist($id) {
        $playlist = Playlist::find($id);

        $playlist->delete();
        $playlist->courses()->detach();

        return response()->json(['success' => true]);
    }

    public function addCourse(Playlist $playlist, Course $course) {
        if($playlist->user->id !== Auth::id()) abort(401);
        $playlist->courses()->attach($course->id);
        return response()->json(['success' => true]);
    }
    public function deleteCourse(Playlist $playlist, Course $course) {
        if($playlist->user->id !== Auth::id()) abort(401);
        $playlist->courses()->detach($course->id);
        return response()->json(['success' => true]);
    }
}
