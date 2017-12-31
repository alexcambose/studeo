<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
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
        DB::table('avatars')->truncate();
        DB::table('avatar_user')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $this->call(UsersTableSeeder::class); // chestii care tin de user
        $this->call(CoursesTableSeeder::class); // chestii care tin de coursuri

        $this->command->alert('Gata boss, am terminat, '.random_int(20, 99999).' de lei o sa fie!');
    }
}
