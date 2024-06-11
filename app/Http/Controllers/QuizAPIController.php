<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Exception;
use Illuminate\Http\JsonResponse;

class QuizAPIController extends Controller
{
    public function displayAllQuizzes():JsonResponse
    {
        try {
            $quizzes = Quiz::all();
        } catch(Exception $e) {
            return response()->json([
                "message" => "Something has gone wrong"
            ], 500);
        }

        return response()->json([
            "message" => "Quizzes retrieved",
            "data" => $quizzes
        ]);
    }
}
