<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\QuizAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/quizzes', [QuizAPIController::class, 'displayAllQuizzes']);
Route::get('/quizzes/{id}', [QuizAPIController::class, 'displayQuizByID']);
Route::post('/quizzes', [QuizAPIController::class, 'addNewQuiz']);
Route::post('/questions', [QuizAPIController::class, 'addNewQuestion']);


