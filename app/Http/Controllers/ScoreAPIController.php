<?php

namespace App\Http\Controllers;

use App\Models\Score;
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

        try {
            $result = $score->save();
        } catch (Exception $e) {
            $result = false;
        }

        if ($result === true) {
            return response()->json(["message" => 'Score calculated'], 200);
        } else {
            return response()->json([
                "message" => " "
            ], 500);
        }
    }
}
