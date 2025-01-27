<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ranking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener los primeros 5 usuarios
        $users = User::take(5)->get();

        // Asignar rankings a los usuarios
        foreach ($users as $user) {
            Ranking::create([
                'user_id' => $user->id,
                'weekly_score' => rand(0, 100), // Puntaje semanal aleatorio
                'total_score' => rand(0, 500)   // Puntaje total aleatorio
            ]);
        }
    }
}
