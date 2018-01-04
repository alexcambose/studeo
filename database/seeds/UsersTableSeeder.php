<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function insertAchievements() {
        $achievements = array_map(function ($achievement) {
            return ['type' => $achievement[0], 'description' => $achievement[1]];
        }, config('studeo.achievements'));
        DB::table('achievements')->insert($achievements);
    }

    public function insertAvatars() {
        $avatars = array_map(function ($avatar) {
            return ['type' => $avatar[0], 'title' => $avatar[1], 'description' => $avatar[2], 'price' => $avatar[3]];
        }, config('studeo.avatars'));
        DB::table('avatars')->insert($avatars);
    }

    public function run() {
        $this->insertAvatars();
        $this->insertAchievements();
        factory(\App\Item::class, 10)->create();
        factory(\App\User::class, 2)->create();
        factory(App\User::class)->create([
            'first_name' => 'Sandel',
            'last_name' => 'Sandica',
            'username' => 'sandilica293',
            'email' => 'sandel@sandica.com',
            'role' => 2,
            'image_id' => function() {
                return factory(App\Media::class)->create(['filename' => 'userdata/images/11.jpg',])->id;
            }
        ])->achievements()->sync(App\Achievement::all()->random(5)->pluck('type'));
        factory(\App\Post::class, 20)->create();
    }
}
