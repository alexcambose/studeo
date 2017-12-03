<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function all($courseId) {
        return response()->json([
            'success' => true,
            'lessons' => Course::find($courseId)->lessons,
        ]);
    }
}
