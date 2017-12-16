<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
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
        DB::statement("SET foreign_key_checks=0");
        \App\Answer::truncate();
        \App\Question::truncate();
        \App\Lesson::truncate();
        \App\Course::truncate();
        \App\Note::truncate();
        \App\Item::truncate();
        \App\Playlist::truncate();
        \App\User::truncate();
        \App\Media::truncate();
        DB::statement("SET foreign_key_checks=1");

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

        factory(\App\Course::class, 1)->create();
        factory(\App\Note::class, 10)->create();
        factory(\App\Lesson::class, 10)->create();
        factory(\App\Question::class, 40)->create();
        factory(\App\Answer::class, 200)->create();
        factory(\App\Playlist::class, 50)->create()->each(function($playlist) {
            $playlist->courses()->sync(
                \App\Course::all()->random(1)
            );
        });
    }
}
