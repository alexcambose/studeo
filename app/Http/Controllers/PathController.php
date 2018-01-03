<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Path;

class PathController extends Controller
{
    //
    public function all() {
        return response()->json([
            'success' => true,
            'paths' => Path::all(),
        ]);
    }
}