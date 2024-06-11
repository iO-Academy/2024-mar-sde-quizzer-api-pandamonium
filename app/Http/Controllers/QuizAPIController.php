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
            'name' => 'required|string|min:1|max:255',
            'description' => 'required|string|min:1|max:1000'
        ]);

        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->description = $request->description;

        try {
            $result = $quiz->save();
        } catch (Exception $e) {
            $result = false;
        }

        if ($result === true) {
            return response()->json(["message" => 'Quiz created'], 201);
        } else {
            return response()->json([
                "message" => "Quiz creation failed"
            ], 500);
        }
    }

    public function displayQuizByID(int $id): JsonResponse {
        try {
             $singleQuiz = Quiz::with(['questions', 'questions.answers'])->find($id);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Quiz not found"
            ], 404);
        }
        return response()->json([
            "message" => "Quiz retrieved",
            "data" => $singleQuiz
        ]);
    }
}
