<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function user() {
        return response()->json([
            'success' => !!Auth::user(),
            'user' => Auth::user()
        ]);
    }
}
