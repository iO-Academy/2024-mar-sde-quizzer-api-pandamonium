<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizAPIController extends Controller
{
    public function displayAllQuizzes()
    {
        $quizzes = Quiz::all();

        return response()->json([
            "message" => "Quizzes retrieved",
            "success" => true,
            "data" => $quizzes
        ]);
    }
}
