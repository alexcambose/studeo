<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    public function insertTags() {
        $tags = array_map(function ($tag) {
            return ['label' => $tag];
        }, config('studeo.tags'));

        DB::table('tags')->insert($tags);
    }

    public function run()
    {
        $this->insertTags();

        $courseNumber = 20;

        factory(\App\Course::class, $courseNumber)->create()->each(function($course)use($courseNumber) {
            $course->tags()->sync( \App\Tag::all()->random(floor($courseNumber/2))->pluck('id') );
        });

        factory(\App\Playlist::class, 50)->create()->each(function($playlist)use($courseNumber) {
            $playlist->courses()->sync( \App\Course::all()->random(floor($courseNumber/2))->pluck('id') );
        });

        factory(\App\Path::class, 50)->create()->each(function($path)use($courseNumber) {
            $path->courses()->sync( \App\Course::all()->random(floor($courseNumber/2))->pluck('id') );
        });

        factory(\App\Lesson::class, $courseNumber*4)->create();

        factory(\App\Question::class, $courseNumber * 2)->create();

        factory(\App\Answer::class, $courseNumber * 4)->create();

        factory(\App\Note::class, $courseNumber*3)->create();
    }
}
