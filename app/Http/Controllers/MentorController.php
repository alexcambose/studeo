<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    function becomeMentor(){
        $user = Auth::user();

        $user->role = 1;
        $user->save();
        return response()->json([
            'success' => true,
        ]);
    }
}
