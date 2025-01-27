<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         // Llamar a los seeders específicos
         $this->call([
            UserSeeder::class,
            QuestionSeeder::class,
            AdminUserSeeder::class,
            RankingSeeder::class,
        ]);
    }
}
