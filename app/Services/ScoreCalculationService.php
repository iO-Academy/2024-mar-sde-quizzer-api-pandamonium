<?php

namespace App\Services;

use App\Models\Question;

class ScoreCalculationService
{
    public static function getQuestionCount ($score)
    {
        $question_count = Question::where('quiz_id','=', $score->quiz)->get()->count();
        return $question_count;
    }

    public static function getAvailablePoints ($score)
    {
        $available_points = Question::where('quiz_id','=', $score->quiz)->sum('points');
        return $available_points;
    }
}
