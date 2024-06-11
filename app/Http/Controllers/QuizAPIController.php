<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class QuizAPIController extends Controller
{
    public function displayAllQuizzes(): JsonResponse
    {
        try {
            $quizzes = Quiz::all();
        } catch (Exception $e) {
            return response()->json([
                "message" => "Something has gone wrong"
            ], 500);
        }

        return response()->json([
            "message" => "Quizzes retrieved",
            "data" => $quizzes
        ]);
    }

    public function addNewQuiz(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|min:1|max:10',
            'description' => 'required|string|min:1|max:100'
        ]);

        $quiz = new Quiz();

        $quiz->name = $request->name;
        $quiz->description = $request->description;

        $quiz->save();

        if ($quiz) {
            return response()->json(["message" => 'Quiz created'], 201);
        }

        return response()->json([
            "message" => "Something has gone wrong"
        ], 500);
    }
}
