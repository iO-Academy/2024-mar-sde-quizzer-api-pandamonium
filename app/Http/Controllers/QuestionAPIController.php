<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionAPIController extends Controller
{
    public function addNewQuestion( Request $request): JsonResponse
    {
        $request->validate([
            'question' => 'required|string|min:1|max:255',
            'hint' => 'string|max:255',
            'points' => 'required|min:1|integer',
        ]);

        $question = new Question();
        $question->question = $request->question;
        $question->hint = $request->hint;
        $question->points = $request->points;
        $question->quiz_id = $request->quiz_id;

        try {
            $result = $question->save();
        } catch (Exception $e) {
            $result = false;
        }

        if ($result === true) {
            return response()->json(["message" => 'Question created'], 201);
        } else {
            return response()->json([
                "message" => "Question creation failed"
            ], 500);
        }
    }
}
