<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 10)->create();
        factory(\App\Item::class, 10)->create();

        //Create SANDEL
        factory(App\User::class)->create([
            'first_name' => 'Sandel',
            'last_name' => 'Sandica',
            'username' => 'sandilica293',
            'email' => 'sandel@sandica.com',
            'role' => 2,
        ]);

//        factory(\App\Course::class, 5)->create();
//        factory(\App\Lesson::class, 20)->create();
//        factory(\App\Question::class, 10)->create();
//        factory(\App\Answer::class, 20)->create();
        factory(\App\Course::class, 50)->create();
        factory(\App\Lesson::class, 80)->create();
        factory(\App\Question::class, 40)->create();
        factory(\App\Answer::class, 20)->create();
    }
}
