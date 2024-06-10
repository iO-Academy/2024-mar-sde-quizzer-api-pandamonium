<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\JsonResponse;

class QuizAPIController extends Controller
{
    public function displayAllQuizzes():JsonResponse
    {
        $quizzes = Quiz::all();

        return response()->json([
            "message" => "Quizzes retrieved",
            "success" => true,
            "data" => $quizzes
        ]);
    }
}
