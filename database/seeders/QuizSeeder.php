<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 3; $i++) {
            DB::table('quizzes')->insert([
                'name' => Str::random(10),
                'description' => Str::random(100)
            ]);
        }
    }
}
