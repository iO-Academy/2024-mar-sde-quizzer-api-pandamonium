<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('questions')->insert([
                'question' => Str::random(30),
                'hint' => Str::random(60),
                'points' => rand(0, 100),
                'quiz_id' => rand(1, 10),
            ]);
        }
    }
}
