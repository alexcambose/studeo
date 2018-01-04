<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run() {
        $this->command->alert('Tabelarele tabeloase o sâ fii goliti :>');

        DB::statement("SET foreign_key_checks=0");
        $tables = json_decode(json_encode(DB::select('SHOW TABLES')),true); // https://stackoverflow.com/a/19495142

        foreach($tables as $table) DB::table($table['Tables_in_' . env('DB_DATABASE')])->truncate();

        DB::statement("SET foreign_key_checks=1");

        $this->command->info('Tabelarele golite.');


        $this->call(UsersTableSeeder::class); // chestii care tin de user
        $this->call(CoursesTableSeeder::class); // chestii care tin de cursuri

        $this->command->alert('Gata boss, am terminat, '.random_int(20, 99999).' de lei o sa fie!');
    }
}
