<?php

namespace App\Http\Controllers;

use App\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function all() {
        return response()->json([
            'success' => true,
            'achievements' => Achievement::all(),
        ]);
    }
}
