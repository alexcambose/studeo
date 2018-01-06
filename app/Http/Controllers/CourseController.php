<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Course;
use App\Lesson;
use App\Media;
use App\Notifications\FirstCourseJoined;
use App\Notifications\FirstCoursePosted;
use App\Question;
use App\Recommendation;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Validator;


class CourseController extends Controller
{
    function one($slug) {
        $course = Course::where('slug', $slug)->first();
        if(!$course) abort(404);
        if(!isset($_COOKIE['viewed-' . $course->id])){ // Cookie::get() returns null because of some kind of encryption shit
            $course->views++;
            $course->save();
        }
        Recommendation::add($course->category);

        return response()->json([
            'success' => true,
            'course' => $course,
        ])->cookie('viewed-'.$course->id);
    }
    public function oneById($id) {
        $course = Course::find($id);
        return response()->json([
            'success' => true,
            'course' => $course,
        ]);
    }
    function all($userId = null, Request $request) {
        if($request->sort) {
            $field = explode('-', $request->sort)[0];
            $order = explode('-', $request->sort)[1];

            if($field === 'alph') $field = 'title';
            else if($field === 'date') $field = 'created_at';
            else if($field === 'views') $field = 'views';

            $courses = Course::orderBy($field, ($order === 'desc' ? 'DESC' : 'ASC'));
        } else {
            $courses = Course::orderBy('created_at', 'DESC');
        }
        if($request->search) $courses->where('title', 'LIKE', '%'.$request->search.'%');
        if($userId) $courses = $courses->where('user_id', $userId);
        if($request->start !== null && $request->amount !== null) $courses->skip((int)$request->start)->take((int)$request->amount);
        if($request->difficulty) $courses = $courses->whereIn('difficulty', $request->difficulty);
        if($request->category) $courses = $courses->where('category', $request->category);
        if($request->author) {
            $courses->whereHas('user', function ($query) use ($request) {
                $query->where('first_name', 'LIKE', '%' . $request->author . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request->author . '%');
            });
        }
        $coursesArray = $courses->get();

        if($request->tags) {
            $coursesArray = $coursesArray->filter(function($course)use($request){
                $tags = is_array($request->tags) ? $request->tags : [$request->tags];
                foreach ($tags as $tag){
                    if($course->hasTag(Tag::find($tag))) return true;
                }
                return false;
            });
        }
        if($request->onlyRegistered === "true") {
            $coursesArray = $coursesArray->filter(function($course)use($request){
                return $course->isUserJoined(Auth::user());
            });
        }
        return response()->json([
            'success' => true,
            'courses' => $coursesArray->values(),
        ]);
    }
    public function bestSlug($title){
        $title = strtolower($title);
        $slug = str_replace(' ', '-', $title);
        $someNumber = 0;
        while(Course::where('slug', $slug)->count()){ //while there is a database course with the same slug
            $slug .= ++$someNumber;
        }
        return response()->json([
            'success' => true,
            'slug' => $slug,
        ]);
    }

    public function userJoin(Request $request) {
        if(!Auth::user()->joinedCourses()->count()) Auth::user()->notify(new FirstCourseJoined());
        Course::find($request->courseId)->lessons()->where('order_index', 0)->first()->joinedUsers()->attach(Auth::user()->id);
        return response()->json([ 'success' => true ]);
    }
    /**
     * Cancer pe paine
     */
    function add(Request $request) {
        $course = json_decode($request->input('content'), true); // tot cursul in forma []

        /*
         * Scurtă introducere
         *
         *  - prima data se face validarea, nu incepe niciun INSERT sau upload fara sa fim siguri pe datele care vin
         *
         *  - se incepe upload-ul, in cazul in care userul inchide browserul ramane doar in db->media
         *      si pe disk fisierul. (daca se intampla asta, nu vede nimeni ca sunt fisiere ampulea si nefolosite,
         *      si se poate face o chestie automata sa verifice care sunt folosite si care nu si sa le stearga pe alea care nu sunt)
         *
         *  - se insereaza partea de continut... sperand ca nu o sa inchida browserul in momentul ala.
         *      Teoretic ar trebui sa dureze putin deci sunt mai mici sansele.(daca se intampla asta e cam nasol ca o sa apara o bucata de curs pe site...)
         */

        // region Validare
        $errors = [];
        // region Imaginea cursului
        $courseImage = $request->file('image'); // imaginea cursului
        if($courseImage) {
            $validation = Validator::make([
                'image' => $courseImage,
            ], [
                'image' => Course::$rules['image'],
            ]);
            if ($validation->fails()) $errors[] = 'Imaginea cursului nu este validă!';
        } else {
            $errors[] = 'Nu există imagine pentru acest curs!';
        }

        // endregion
        // region Miniaturi si Videoclipuri
        if (count($request->file('thumbnails')) < count($course['lessons'])) {
            $errors[] = 'Nu există miniaturi pentru toate lecțiile!';
        } else if (count($request->file('videos')) < count($course['lessons'])) {
            $errors[] = 'Nu există videoclipuri pentru toate lecțiile!';
        } else {
            foreach ($request->file('thumbnails') as $key => $thumbnail) {
                $validation = Validator::make([
                    'thumbnail' => $thumbnail,
                ], [
                    'thumbnail' => Lesson::$rules['thumbnail'],
                ]);
                if ($validation->fails()) $errors[] = 'Miniatura de la lecția <b>' . $course['lessons'][$key]['title'] . '</b> nu este validă!';
            }
            foreach ($request->file('videos') as $key => $video) {
                $validation = Validator::make([
                    'video' => $video,
                ], [
                    'video' => Lesson::$rules['video'],
                ]);
                if ($validation->fails()) $errors[] = 'Videoclipul de la lectia <b>' . $course['lessons'][$key]['title'] . '</b> nu este valid!' . $validation->errors()->first('video');
            }
        }

        // endregion
        // region Continut curs
        if(Course::where('slug', $course['slug'])->count()) $errors[] = 'Legătura permanentă <b>' . $course['slug'] . '</b> există deja!';
        $validation = Validator::make($course, [
            'title' => Course::$rules['title'],
            'slug' => Course::$rules['slug'],
            'short_description' => Course::$rules['short_description'],
            'description' => Course::$rules['description'],
            'difficulty' => Course::$rules['difficulty'],
            'category' => Course::$rules['category'],
            'prerequisites' => Course::$rules['prerequisites'],
            'purpose' => Course::$rules['purpose'],
            'purposeWhatWillLearn' => Course::$rules['purpose_what_will_learn'],
            'targetClassLevel' => Course::$rules['target_class_level'],
        ]);
        if ($validation->fails()) $errors[] = 'Cursul conține date invalide sau câmpuri necompletate!';
        // endregion

        // region Continut course->lessons
        foreach ($course['lessons'] as $key => $lesson) {
            $validation = Validator::make($lesson, [
                'title' => Lesson::$rules['title'],
                'short_description' => Lesson::$rules['short_description'],
                'content' => Lesson::$rules['content'],
                'order_index' => Lesson::$rules['order_index'],
            ]);
            if ($validation->fails()) $errors[] = 'Lecția <b><em>' . $lesson['title'] . '</em></b> conține date invalide sau câmpuri necompletate!';
            // region Continut course->lessons->questions
            foreach($course['lessons'][$key]['questions'] as $questionKey => $question) {
                $validation = Validator::make($question, [
                    'content' => Question::$rules['content'],
                ]);
                if ($validation->fails()) $errors[] = 'Întrebarea <b><em>' . $question['content'] . '</em></b> de la lecția <b><em>' . $lesson['title'] . '</em></b> conține date invalide!';

                $questionHasAnswer = false;
                // region Continut course->lessons->questions->answers
                foreach($course['lessons'][$key]['questions'][$questionKey]['answers'] as $answerKey => $answer) {
                    if ($answer['is_true']) $questionHasAnswer = true;
                    $validation = Validator::make($answer, [
                        'content' => Answer::$rules['content'],
                        'is_true' => Answer::$rules['is_true'],
                    ]);
                    if ($validation->fails()) $errors[] = 'Răspunsul la întrebarea <b><em>' . $question['content'] . '</em></b> de la lecția <b><em>' . $lesson['title'] . '</em></b> conține date invalide sau câmpuri necompletate!';
                }
                if(!$questionHasAnswer) $errors[] = 'Lecția <b>' . $lesson['title'] . '</b> conține o întrebare care nu are răspuns!';
                // endregion
            }
            // endregion
        }
        // afiseaza errorile daca sunt
        if(count($errors)) return response()->json([
            'success' => false,
            'messages' => $errors,
        ]);
        // endregion


        // endregion

        // punem id-ul din baza de date aici ca o sa trebuiasca mai tarziu, cand adaugam lectia
        $thumbnailsId = [];
        $videosId = [];
        $courseImageId = -1;
        // region Upload
        foreach ($request->file('thumbnails') as $key => $thumbnail) { // miniaturile de la lectii
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('userdata/courses/thumbnails'), $filename);
            $thumbnailsId[$key] = Media::add('userdata/courses/thumbnails/' . $filename);
        }

        foreach ($request->file('videos') as $key => $video) { // videoclipuri de la lectii
            $filename = time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('userdata/courses/videos'), $filename);
            $videosId[$key] = Media::add('userdata/courses/videos/' . $filename, 1);
        }

        //imaginea cursului
        $filename = time() . '.' . $courseImage->getClientOriginalExtension();
        $courseImage->move(public_path('userdata/courses/images'), $filename);
        $courseImageId = Media::add('userdata/courses/images/' . $filename);
        // endregion

        // region Continut
        $newCourse = new Course();
        $newCourse->title = $course['title'];
        $newCourse->slug = $course['slug'];
        $newCourse->short_description = $course['short_description'];
        $newCourse->description = $course['description'];
        $newCourse->difficulty = $course['difficulty'];
        $newCourse->category = $course['category'];
        $newCourse->prerequisites = json_encode($course['prerequisites']);
        $newCourse->purpose = $course['purpose'];
        $newCourse->purpose_what_will_learn = json_encode($course['purposeWhatWillLearn']);
        $newCourse->target_class_level = $course['targetClassLevel'];
        $newCourse->image_id = $courseImageId;
        Auth::user()->courses()->save($newCourse);
        $newCourse->tags()->sync($course['tags']);

        foreach ($course['lessons'] as $key => $lesson) {
            $newLesson = new Lesson();
            $newLesson->title = $lesson['title'];
            $newLesson->short_description = $lesson['short_description'];
            $newLesson->content = $lesson['content'];
            $newLesson->order_index = $lesson['order_index'];
            $newLesson->thumbnail_id = $thumbnailsId[$key];
            $newLesson->video_id = $videosId[$key];
            $newLesson->course_id = $newCourse->id;
            $newLesson->save();

            foreach ($course['lessons'][$key]['questions'] as $questionKey => $question) {
                $newQuestion = new Question();
                $newQuestion->content = $question['content'];
                $newQuestion->lesson_id = $newLesson->id;
                $newQuestion->save();

                foreach ($course['lessons'][$key]['questions'][$questionKey]['answers'] as $answerKey => $answer) {
                    $newAnswer = new Answer();
                    $newAnswer->content = $answer['content'];
                    $newAnswer->is_true = $answer['is_true'];
                    $newAnswer->question_id = $newQuestion->id;
                    $newAnswer->save();
                }
            }
        }
        if(!Auth::user()->courses()->count()) Auth::user()->notify(new FirstCoursePosted());

        return response()->json([
            'success' => true, // :D :D :D see ya'
        ]);
    }
}
