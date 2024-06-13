<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Services\ScoreCalculationService;
use Exception;
use Illuminate\Http\Request;

class ScoreAPIController extends Controller
{
    public function addScores(Request $request)
    {
        $request->validate([
            'quiz' => 'required|integer|exists:quizzes,id',
            'answers' => 'required'
        ]);

        $score = new Score();
        $score->quiz = $request->quiz;
        $score->answers = $request->answers;
        $question_count = ScoreCalculationService::getQuestionCount($score);
        $correct_count = ScoreCalculationService::getQuestionCount($score);
        $available_points = ScoreCalculationService::getAvailablePoints($score);
        $points = ScoreCalculationService::getQuestionCount($score);

        $data = ['question_count' => $question_count, 'available_points' => $available_points];

        try {
            $result = $score->save();
        } catch (Exception $e) {
            $result = false;
        }

        if ($result === true) {
            return response()->json(["message" => 'Score calculated', 'data' => $data], 200);
        } else {
            return response()->json([
                "message" => " "
            ], 500);
        }
    }
}
