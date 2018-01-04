<?php

namespace App\Http\Controllers;

use App\Course;
use App\Events\CourseFinished;
use App\Lesson;
use App\Notifications\AwardedXp;
use App\Notifications\CourseIsFinished;
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
            // check if this lesson is the last one
            $lesson->joinedUsers()->attach(Auth::id());

            if($lesson->id === $lesson->course->lessons->last()->id){
                event(new CourseFinished($lesson->course));
            }
            return response()->json([ 'success' => true ]);
        }
        return response()->json([ 'success' => false ]);
    }
}
