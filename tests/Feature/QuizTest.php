<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Question;
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

    public function test_addNewQuestion_Success(): void
    {
        Question::factory()->create();
        $testData = [
            'question' => "dave",
            'points' => 2,
            'hint' => "hey",
            'quiz_id' => 1
        ];

        $response = $this->postJson('/api/questions', $testData);

        $response->assertStatus(201)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });
        $this->assertDatabaseHas('questions', $testData);
    }

    public function test_addNewQuestion_missingQuestion(): void
    {
        Question::factory()->create();
        $testData = [
            'points' => 2,
            'quiz_id' => 1
        ];

        $response = $this->postJson('/api/questions', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('question');
                    });
            });
    }

    public function test_addNewQuestion_missingPoints(): void
    {
        Question::factory()->create();
        $testData = [
            'question' => "hey",
            'quiz_id' => 1
        ];

        $response = $this->postJson('/api/questions', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('points');
                    });
            });
    }

    public function test_addNewQuestion_malformedQuestion(): void
    {
        Question::factory()->create();
        $testData = [
            'question' => 10,
            'points' => 1,
            'quiz_id' => 1
        ];

        $response = $this->postJson('/api/questions', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('question');
                    });
            });
    }

    public function test_addNewQuestion_missingQuizID(): void
    {
        Question::factory()->create();
        $testData = [
            'question' => "hey",
            'points' => 1
        ];

        $response = $this->postJson('/api/questions', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('quiz_id');
                    });
            });
    }

    public function test_addNewQuestion_invalidQuizID(): void
    {
        Question::factory()->create();
        $testData = [
            'question' => "hey",
            'points' => 1,
            'quiz_id' => 100
        ];

        $response = $this->postJson('/api/questions', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('quiz_id');
                    });
            });
    }

    public function test_addNewAnswer_Success(): void
    {
        Answer::factory()->create();
        $testData = [
            'answer' => "dave",
            'feedback' => null,
            'correct' => 1,
            'question_id' => 1
        ];

        $response = $this->postJson('/api/answers', $testData);

        $response->assertStatus(201)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });
        $this->assertDatabaseHas('answers', $testData);
    }

    public function test_addNewAnswer_missingAnswer(): void
    {
        Answer::factory()->create();
        $testData = [
            'feedback' => null,
            'correct' => 1,
            'question_id' => 1
        ];

        $response = $this->postJson('/api/answers', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('answer');
                    });
            });
    }

    public function test_addNewAnswer_missingQuestionID(): void
    {
        Answer::factory()->create();
        $testData = [
            'answer' => "dave",
            'feedback' => null,
            'correct' => 1
        ];

        $response = $this->postJson('/api/answers', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('question_id');
                    });
            });
    }

    public function test_addNewAnswer_malformedAnswer(): void
    {
        Answer::factory()->create();
        $testData = [
            'answer' => 3,
            'feedback' => null,
            'correct' => 1,
            'question_id' => 1
        ];

        $response = $this->postJson('/api/answers', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('answer');
                    });
            });
    }

    public function test_addNewAnswer_invalidQuestionID(): void
    {
        Answer::factory()->create();
        $testData = [
            'answer' => "dave",
            'feedback' => null,
            'correct' => 1,
            'question_id' => 1000
        ];

        $response = $this->postJson('/api/answers', $testData);

        $response->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'errors'])
                    ->has('errors', function (AssertableJson $json) {
                        $json->hasAll('question_id');
                    });
            });
    }
}
