<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
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

    public function watched(Lesson $lesson) {
        if($lesson->userWatched(Auth::user()))
            return response()->json([ 'success' => true ]);
        if($lesson->course->isUserJoined(Auth::user())){
            $lesson->joinedUsers()->attach(Auth::id());
            return response()->json([ 'success' => true ]);
        }
        return response()->json([ 'success' => false ]);
    }
}
