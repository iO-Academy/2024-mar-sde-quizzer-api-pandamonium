<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10),
            'description' => $this->faker->text(100)
        ];
    }
}
