<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question' => $this->faker->text(10),
            'hints' => $this->faker->text(100),
            'points' => $this->faker->numberBetween(0, 100),
            'quiz_id' => Quiz::factory(),
        ];
    }
}
