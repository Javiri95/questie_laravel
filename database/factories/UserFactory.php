<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class UserFactory extends Factory
{

    protected $model = User::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nickname' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'birth_date' => $this->faker->date(),
            'avatar' => $this->faker->imageUrl(),
            'role' => $this->faker->randomElement(['admin', 'user', 'guest']),
        ];

     
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
