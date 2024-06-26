<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\QuizAPIController;
use \App\Http\Controllers\QuestionAPIController;
use \App\Http\Controllers\AnswerAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/quizzes', [QuizAPIController::class, 'displayAllQuizzes']);
Route::get('/quizzes/{id}', [QuizAPIController::class, 'displayQuizByID']);
Route::post('/quizzes', [QuizAPIController::class, 'addNewQuiz']);
Route::post('/questions', [QuestionAPIController::class, 'addNewQuestion']);
Route::post('/answers', [AnswerAPIController::class, 'addNewAnswer']);

