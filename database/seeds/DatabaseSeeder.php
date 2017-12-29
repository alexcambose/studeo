<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    public function insertTags() {
        $defaults = [
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
        foreach ($defaults as $default) DB::table('tags')->insert($default);
    }
    public function insertAchievements() {
        $achievements = [];
        // in ordine, un fel cronologica
        $achievements[] = ['type' => '1_COURSE_FINISHED', 'description' => 'Un curs terminat.'];
        foreach ([5,10,25,50,100,200,250,500] as $value)
            $achievements[] = [
                'type' => $value . '_COURSE_FINISHED',
                'description' => $value . ($value % 100 > 19 ? ' de ' : ' ') . 'cursuri terminate.',
            ];

        $achievements[] = ['type' => 'BECAME_MENTOR', 'description' => 'Mentor'];
        $achievements[] = ['type' => '1_COURSE_PUBLISHED', 'description' => 'Un curs publicat'];
        foreach ([2,6,10,20,30] as $value) // 30 ii ajung disperatului
            $achievements[] = [
                'type' => $value . '_COURSE_PUBLISHED',
                'description' => $value . ($value % 100 > 19 ? ' de ' : ' ') . 'cursuri publicate.',
            ];
        DB::table('achievements')->insert($achievements);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /*
         * Ca sa nu trebuiasca de fiecare data sa stergem tabelele cand testam un seeder,
         * e suficient doar
         *  ~ php artisan db:seed
         *
         * iar varianta veche era
         *  ~ php artisan migrate:rollback && php artisan migrate && php artisan db:seed
        */
        $this->command->alert('Tabelarele tabeloase o sâ fii goliti :>');

        DB::statement("SET foreign_key_checks=0");
        DB::table('answers')->truncate();
        DB::table('questions')->truncate();
        DB::table('lessons')->truncate();
        DB::table('lesson_user')->truncate();
        DB::table('tags')->truncate();
        DB::table('courses')->truncate();
        DB::table('notes')->truncate();
        DB::table('items')->truncate();
        DB::table('playlists')->truncate();
        DB::table('users')->truncate();
        DB::table('media')->truncate();
        DB::table('course_tag')->truncate();
        DB::table('course_playlist')->truncate();
        DB::table('achievements')->truncate();
        DB::table('achievement_user')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $this->command->info('Tables emptied!');

        factory(\App\User::class, 2)->create();
        factory(\App\Item::class, 10)->create();
        $this->insertTags();
        $this->insertAchievements();
        //Create SANDEL
        factory(App\User::class)->create([
            'first_name' => 'Sandel',
            'last_name' => 'Sandica',
            'username' => 'sandilica293',
            'email' => 'sandel@sandica.com',
            'role' => 2,
        ])->achievements()->sync(App\Achievement::all()->random(5)->pluck('type'));

        $courseNumber = 10; //ca sa nu mai modificam peste tot
        factory(\App\Course::class, $courseNumber)->create()->each(function($course)use($courseNumber) {
            $course->tags()->sync( \App\Tag::all()->random(floor($courseNumber/2))->pluck('id') );
        });
        factory(\App\Note::class, $courseNumber*10)->create();
        $this->command->info('30%');
        factory(\App\Lesson::class, $courseNumber*4)->create();
        factory(\App\Question::class, 30)->create();
        factory(\App\Answer::class, 40)->create();
        $this->command->info('60%');
        factory(\App\Playlist::class, 50)->create()->each(function($playlist)use($courseNumber) {
            $playlist->courses()->sync( \App\Course::all()->random(floor($courseNumber/2))->pluck('id') );
        });
        factory(\App\Post::class, 20)->create();
        $this->command->info('100%');
    }
}
