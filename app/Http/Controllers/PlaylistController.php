<?php

namespace App\Http\Controllers;

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
           'playlists' => $playlists,
        ]);
    }

    public function all($playlistId) {
        return response()->json([
           'playlists' => Course::find($playlistId)->courses,
        ]);
    }

    public function createPlaylist(Request $request){
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
        $playlist->image_id = 1; // ceva default

        $playlist->save();

        return response()->json([
           'success' => true,
           'playlist' => $playlist,
        ]);
    }
}
