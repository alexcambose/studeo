<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    function add(Request $request) {
        return response()->json($request);
    }
}
