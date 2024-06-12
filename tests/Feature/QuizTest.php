<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class QuizTest extends TestCase
{
    use DatabaseMigrations;

    public function test_displayAllQuizzes_success(): void
    {
        Quiz::factory()->create();
        $response = $this->get('/api/quizzes');
        $response->assertStatus(200)
            ->assertJson(function(AssertableJson $json) {
                $json->hasAll(['message', 'data'])
                    ->has('data', 1, function(AssertableJson $json) {
                        $json->hasAll(['id', 'name', 'description']);
            });
        });
    }

    public function test_addNewQuiz_Success(): void
    {
        Quiz::factory()->create();
        $testData = [
            'name' => "dave",
            'description' => "hey",
        ];

        $response = $this->postJson('/api/quizzes', $testData);

        $response->assertStatus(201)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });
        $this->assertDatabaseHas('quizzes', $testData);
    }

    public function test_addNewQuiz_nameValidation(): void
    {
        Quiz::factory()->create();
        $testData = [
            'description' => "hey"
        ];

        $response = $this->postJson('/api/quizzes', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('name');
                    });
            });
    }

    public function test_addNewQuiz_descriptionValidation(): void
    {
        Quiz::factory()->create();
        $testData = [
            'name' => "hey"
        ];

        $response = $this->postJson('/api/quizzes', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('description');
                    });
            });
    }

    public function test_addNewQuiz_malformedName(): void
    {
        Quiz::factory()->create();
        $testData = [
            'name' => 10,
             'description' => "hey"
        ];

        $response = $this->postJson('/api/quizzes', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('name');
                    });
            });
    }

    public function test_addNewQuiz_malformedDescription(): void
    {
        Quiz::factory()->create();
        $testData = [
            'name' => 'hey',
            'description' =>10
        ];

        $response = $this->postJson('/api/quizzes', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('description');
                    });
            });
    }

    public function test_getQuizByID_success(): void
    {
        Answer::factory()->create();
        $response = $this->get('/api/quizzes/1');
        $response->assertStatus(200)
            ->assertJson(function(AssertableJson $json) {
                $json->hasAll(['message', 'data'])
                    ->has('data', function(AssertableJson $json) {
                        $json->hasAll(['id', 'name', 'description', 'questions'])
                            ->has('questions', 1, function(AssertableJson $json) {
                                $json->hasAll(['id', 'question', 'hint', 'points', 'quiz_id', 'answers'])
                                    ->has('answers', 1, function(AssertableJson $json) {
                                        $json->hasAll(['id', 'answer', 'feedback', 'correct', 'question_id']);
                        });
                    });
                });
            });
    }

    public function test_getQuizByID_failure(): void
    {
        Answer::factory()->create();
        $response = $this->get('/api/quizzes/10');
        $response->assertStatus(404)
            ->assertJson(function(AssertableJson $json) {
                $json->hasAll(['message']);
            });
    }
}
