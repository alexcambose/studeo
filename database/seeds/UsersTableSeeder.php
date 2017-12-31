<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
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

    public function insertAvatars() {
        $avatars = [
            [ 'type'=> 'DEFAULT', 'title' => 'Caracterul standard', 'description' => '', 'price' => 0 ],
            [ 'type'=> 'CAMEL', 'title' => 'Camil Cămila', 'description' => 'Camil Cămila este un personaj antic in istoria Africii. Se spune ca acesta se plimbă noaptea prin deșet și manancă nisip.', 'price' => 10 ],
            [ 'type'=> 'PONY', 'title' => 'Poneiul Fericit', 'description' => 'Descriere. Descriere. Descriere. Descriere. Descriere. Descriere. Descriere. ', 'price' => 40 ],
            [ 'type'=> 'WIZARD', 'title' => 'Vrăjitorul de Fier', 'description' => 'Descriere. Descriere. Descriere. Descriere. Descriere. Descriere. Descriere. ', 'price' => 60 ],
            [ 'type'=> 'SABIN', 'title' => 'Sabin Butoi', 'description' => 'Sabin Butoi face laba in noroi', 'price' => 300 ],
        ];
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
