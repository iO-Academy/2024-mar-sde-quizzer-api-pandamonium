<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswerAPIController extends Controller
{
    public function addNewAnswer(Request $request): JsonResponse
    {
        $request->validate([
            'answer' => 'required|string|min:1|max:255',
            'correct' => 'boolean',
            'question_id' => 'required|integer|exists:questions,id'
        ]);

        $answer = new Answer();
        $answer->answer = $request->answer;
        $answer->correct = $request->correct;
        $answer->question_id = $request->question_id;


        try {
            $result = $answer->save();
        } catch (Exception $e) {
            $result = false;
        }

        if ($result === true) {
            return response()->json(["message" => 'Answer created'], 201);
        } else {
            return response()->json([
                "message" => "Answer creation failed"
            ], 500);
        }
    }
}
