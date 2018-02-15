<?php

namespace App\Http\Controllers;

use App\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function all() {
        return response()->json([
            'success' => true,
            'avatars' => Avatar::orderBy('price', 'ASC')->get(),
        ]);
    }

    public function buy(Avatar $avatar) {
        if(Auth::user()->coins < $avatar->price) return response()->json([ 'success' => false ]);

        Auth::user()->decrement('coins', $avatar->price);
        Auth::user()->avatars()->attach($avatar);
        return response()->json([
            'success' => true,
            'avatars' => Avatar::orderBy('price', 'ASC')->get(),
        ]);
    }

    public function activate(Avatar $avatar) {
        if(!Auth::user()->avatars()->where('active', 1)->first()) return response()->json([ 'success' => false ]);
        Auth::user()->avatars()->updateExistingPivot(Auth::user()->avatars()->where('active', 1)->first()->type, ['active' => 0]);
        Auth::user()->avatars()->updateExistingPivot($avatar->type, ['active' => 1]);
        return response()->json([
            'success' => true,
            'avatar' => $avatar,
        ]);
    }
}
