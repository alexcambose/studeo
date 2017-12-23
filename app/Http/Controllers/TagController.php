<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function all() {
        return response()->json([
            'success' => true,
            'tags' => Tag::all(),
        ]);
    }
}
