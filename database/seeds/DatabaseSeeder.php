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
        if(!$this->command->confirm('Ejti sigor cî vrei să golejti tabelarele tabeloase? :>', true)) return;

        DB::statement("SET foreign_key_checks=0");
        DB::table('answers')->truncate();
        DB::table('questions')->truncate();
        DB::table('lessons')->truncate();
        DB::table('tags')->truncate();
        DB::table('courses')->truncate();
        DB::table('notes')->truncate();
        DB::table('items')->truncate();
        DB::table('playlists')->truncate();
        DB::table('users')->truncate();
        DB::table('media')->truncate();
        DB::table('course_tag')->truncate();
        DB::table('course_playlist')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $this->command->info('Tables emptied!');

        factory(\App\User::class, 2)->create();
        factory(\App\Item::class, 10)->create();

        //Create SANDEL
        factory(App\User::class)->create([
            'first_name' => 'Sandel',
            'last_name' => 'Sandica',
            'username' => 'sandilica293',
            'email' => 'sandel@sandica.com',
            'role' => 2,
        ]);
        $this->insertTags();

        factory(\App\Course::class, 30)->create()->each(function($course) {
            $course->tags()->sync( \App\Tag::all()->random(16)->pluck('id') );
        });
        $this->command->info('30%');
        factory(\App\Note::class, 10)->create();
        factory(\App\Lesson::class, 50)->create();
        factory(\App\Question::class, 40)->create();
        factory(\App\Answer::class, 200)->create();$this->command->info('60%');
        factory(\App\Playlist::class, 50)->create()->each(function($playlist) {
            $playlist->courses()->sync( \App\Course::all()->random(5)->pluck('id') );
        });
        $this->command->info('100%');
    }
}
