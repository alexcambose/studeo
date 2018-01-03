<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    public function insertTags() {
        $tags = [
            ['label' => 'matematică'],
            ['label' => 'algebră'],
            ['label' => 'geometrie'],
            ['label' => 'fracție'],
            ['label' => 'numere complexe'],
            ['label' => 'vectori'],
            ['label' => 'grupuri'],
            ['label' => 'ecuații'],
            ['label' => 'inecuații'],
            ['label' => 'intervale'],
            ['label' => 'șiruri'],
            ['label' => 'monotonie'],
            ['label' => 'adunare'],
            ['label' => 'scădere'],
            ['label' => 'înmultire'],
            ['label' => 'împărțire'],
            ['label' => 'romana'],
            ['label' => 'cultura'],
            ['label' => 'istorie'],
            ['label' => 'arheologie'],
            ['label' => 'geografie'],
            ['label' => 'politică'],
            ['label' => 'castravete'],
            ['label' => 'informatica'],
            ['label' => 'programare'],
            ['label' => 'it'],
            ['label' => 'calculator'],
            ['label' => 'calculatoare'],
        ];
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

        factory(\App\Question::class, 30)->create();

        factory(\App\Answer::class, 40)->create();

        factory(\App\Note::class, $courseNumber*10)->create();
    }
}
