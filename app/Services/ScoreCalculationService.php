<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;

class ScoreCalculationService
{
    public static function getQuestionCount ($score)
    {
        $question_count = Question::where('quiz_id','=', $score->quiz)->get()->count();
        return $question_count;
    }

//    public static function getCorrectCount ($score)
//    {
//        $answer_info = collect($score->answers)->only('answer');
//        $answer_array = $answer_info->toArray();
//        $correct_count = Answer::where('id','in', $answer_array)->get();
//        return $correct_count;
//    }

//    public static function getCorrectCount ($score)
//    {
//        $correct_count =
//        $answer_array =
//            [
//            foreach ($score->answers as $answer) {
//
//        $answer_array = array_push()
//
//            ]
//            }
//            return $correct_count;
//
//    }


    public static function getAvailablePoints ($score)
    {
        $available_points = Question::where('quiz_id','=', $score->quiz)->sum('points');
        return $available_points;
    }
}

