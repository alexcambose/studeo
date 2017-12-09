<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function all($courseSlug) {
        $course = Course::where('slug', $courseSlug)->first();
        if(!$course) abort(404);
        return response()->json([
            'success' => true,
            'lessons' => $course->lessons,
            'userJoined' => $course->isUserJoined(Auth::user()),
        ]);
    }
}
