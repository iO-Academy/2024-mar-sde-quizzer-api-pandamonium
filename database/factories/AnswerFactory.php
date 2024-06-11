<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'answer' => $this->faker->text(10),
            'feedback' => $this->faker->text(100),
            'correct' => $this->faker->boolean(),
            'question_id' => Question::factory(),
        ];
    }
}
