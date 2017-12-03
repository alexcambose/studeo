<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Course;
use App\Lesson;
use App\Media;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class CourseController extends Controller
{
    function one($slug) {
        $course = Course::where('slug', $slug)->first();
        return response()->json([
            'success' => true,
            'course' => $course,
        ]);
    }
    function all($userId = null, Request $r) {
        $courses = Course::orderBy('created_at', 'DESC');
        if($userId) $courses = $courses->where('user_id', $userId);

        if($r->start !== null && $r->end !== null) $courses->skip((int)$r->start)->take((int)$r->end);
        return response()->json([
            'success' => true,
            'courses' => $courses->get(),
        ]);
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
        if (!$request->file('thumbnails') || !$request->file('videos')) {
            $errors[] = 'Nu există imagini sau videoclipuri pentru toate lecțiile!';
        } else {
            foreach ($request->file('thumbnails') as $key => $thumbnail) {
                if ($thumbnail) {
                    $validation = Validator::make([
                        'thumbnail' => $thumbnail,
                    ], [
                        'thumbnail' => Lesson::$rules['thumbnail'],
                    ]);
                    if ($validation->fails()) $errors[] = 'Miniatura de la lecția numărul ' . $key . ' nu este validă!';
                } else $errors[] = 'Lectia numărul ' . $key . 'nu conține miniatură!';
            }
            foreach ($request->file('videos') as $key => $video) {
                if($video) {
                    $validation = Validator::make([
                        'video' => $video,
                    ], [
                        'video' => Lesson::$rules['video'],
                    ]);
                    if ($validation->fails()) $errors[] = 'Videoclipul de la lectia numărul ' . $key . ' nu este valid!';
                } else $errors[] = 'Lectia numărul ' . $key . 'nu conține videoclip!';
            }
        }

        // endregion
        // region Continut curs
        $validation = Validator::make($course, [
            'title' => Course::$rules['title'],
            'slug' => Course::$rules['slug'],
            'shortDescription' => Course::$rules['short_description'],
            'description' => Course::$rules['description'],
            'difficulty' => Course::$rules['difficulty'],
            'prerequisites' => Course::$rules['prerequisites'],
            'purpose' => Course::$rules['purpose'],
            'purposeWhatWillLearn' => Course::$rules['purpose_what_will_learn'],
            'targetClassLevel' => Course::$rules['target_class_level'],
        ]);
        if ($validation->fails()) $errors[] = 'Cursul conține date invalide!';
        // endregion
        // region Continut course->lessons
        foreach ($course['lessons'] as $key => $lesson) {
            $validation = Validator::make($course['lessons'][$key], [
                'title' => Lesson::$rules['title'],
                'shortDescription' => Lesson::$rules['short_description'],
                'content' => Lesson::$rules['content'],
                'order_index' => Lesson::$rules['order_index'],
            ]);
            if ($validation->fails()) $errors[] = 'Lecția <b><em>' . $lesson['title'] . '</em></b> conține date invalide!';
            // region Continut course->lessons->questions
            foreach($course['lessons'][$key]['questions'] as $questionKey => $question) {
                $validation = Validator::make($course['lessons'][$key]['questions'][$questionKey], [
                    'content' => Question::$rules['content'],
                ]);
                if ($validation->fails()) $errors[] = 'Întrebarea <b><em>' . $question['content'] . '</em></b> de la lecția <b><em>' . $lesson['title'] . '</em></b> conține date invalide!';

                // region Continut course->lessons->questions->answers
                foreach($course['lessons'][$key]['questions'][$questionKey]['answers'] as $answerKey => $answer) {
                    $validation = Validator::make($course['lessons'][$key]['questions'][$questionKey]['answers'][$answerKey], [
                        'content' => Answer::$rules['content'],
                        'isTrue' => Answer::$rules['is_true'],
                    ]);
                    if ($validation->fails()) $errors[] = 'Răspunsul la întrebarea <b><em>' . $question['content'] . '</em></b> de la lecția <b><em>' . $lesson['title'] . '</em></b> conține date invalide!';
                }
                // endregion
            }
            // endregion
        }
        //afiseaza errorile daca sunt
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
        $newCourse->short_description = $course['shortDescription'];
        $newCourse->description = $course['description'];
        $newCourse->difficulty = $course['difficulty'];
        $newCourse->prerequisites = json_encode($course['prerequisites']);
        $newCourse->purpose = $course['purpose'];
        $newCourse->purpose_what_will_learn = json_encode($course['purposeWhatWillLearn']);
        $newCourse->target_class_level = $course['targetClassLevel'];
        $newCourse->image_id = $courseImageId;
        $newCourse->user_id = Auth::id();
        $newCourse->save();

        foreach ($course['lessons'] as $key => $lesson) {
            $newLesson = new Lesson();
            $newLesson->title = $lesson['title'];
            $newLesson->short_description = $lesson['shortDescription'];
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

        return response()->json([
            'success' => true, // :D :D :D see ya'
        ]);
    }
}
