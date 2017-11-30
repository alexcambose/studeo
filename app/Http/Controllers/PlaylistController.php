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
        $playlists = Playlist::all();
        return response()->json([
           'playlists' => $playlists,
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

        $playlist->save();

        return response()->json([
           'success' => true,
           'playlist' => $playlist,
        ]);
    }
}
