<?php

namespace App\Http\Controllers;

use App\Achievement;
use App\User;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function all() {
        return response()->json([
            'success' => true,
            'achievements' => Achievement::all(),
        ]);
    }
    public function user(User $user) {
        return response()->json([
            'success' => true,
            'achievements' => $user->achievements()->orderBy('created_at', 'DESC')->get(),
        ]);
    }
}
