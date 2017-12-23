<?php

namespace App\Http\Controllers;

use App\Course;
use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function add(Course $course, Request $request) {
        $validation = Validator::make($request->all(), [
            'title' => Note::$rules['title'],
            'content' => Note::$rules['content'],
        ]);
        if ($validation->fails()) return response()->json(['success' => false]);
        if(!$course->isUserJoined(Auth::user())) return response()->json(['success' => false]);
        $note = new Note();
        $note->title = $request->title;
        $note->content = $request->content;
        $note->user_id = Auth::id();
        $note->course_id = $course->id;
        $note->save();

        return response()->json([
            'success' => true,
            'note' => $note,
        ]);
    }

    public function update(Note $note, Request $request) {
        $validation = Validator::make($request->all(), [
            'title' => Note::$rules['title'],
            'content' => Note::$rules['content'],
        ]);
        if ($validation->fails()) return response()->json(['success' => false]);
        if($note->user_id !== Auth::id()) return response()->json(['success' => false]);

        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();
        return response()->json([
            'success' => true,
            'note' => $note,
        ]);
    }

    public function delete(Note $note) {
        $note->delete();
        return response()->json([ 'success' => true ]);
    }
}
