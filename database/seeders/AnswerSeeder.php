<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnswerSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            DB::table('answers')->insert([
                'answer' => Str::random(30),
                'feedback' => Str::random(60),
                'correct' => rand(0, 1),
                'question_id' => rand(1, 15)
            ]);
        }
    }
}
