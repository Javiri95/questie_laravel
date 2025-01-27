<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Ejecutar el seed de la base de datos.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Question::factory(50)->create();
    }
}
