<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreAPIController extends Controller
{
    public function addScores(Request $request)
    {
        $score = new Score();
        $score->quiz = $request->quiz;
        $score->answers = $request->answers;
        $score->save();
    }
}
