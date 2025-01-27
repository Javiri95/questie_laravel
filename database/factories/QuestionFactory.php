<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * El nombre del modelo relacionado.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Definir el estado de la fábrica.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->sentence,
            'option_a' => $this->faker->word,
            'option_b' => $this->faker->word,
            'option_c' => $this->faker->word,
            'correct_option' => $this->faker->randomElement(['a', 'b', 'c']),
            'media_url' => $this->faker->imageUrl(640, 480, 'nature', true),
        ];
    }
}

