# Quiz Management API

## API documentation

### Return all quizzes

* **URL**

  /api/quizzes

* **Method:**

  `GET`

* **URL Params**

  **Required:**

  There are no required URL params

* **Success Response:**

    * **Code:** 200 <br />
      **Content:** <br />

```json
{
    "message": "Quizzes retrieved",
    "data": [
        {
            "id": 1,
            "name": "Example",
            "description": "An example quiz"
        }
    ]
}
```

### Return a specific quiz

* **URL**

  /api/quizzes/{id}

* **Method:**

  `GET`

**Example:**

`/api/quizzes/1`

* **Success Response:**

    * **Code:** 200 <br />
      **Content:** <br />

```json
{
    "message": "Quiz retrieved",
    "data": {
        "id": 1,
        "name": "Example",
        "description": "An example quiz",
        "questions": [
            {
                "id": 1,
                "question": "What is the S in SOLID?",
                "hint": "Hmmmmm",
                "points": 2,
                "answers": [
                    {
                        "id": 1,
                        "answer": "Single Responsibility Principle",
                        "feedback": "fake feedback",
                        "correct": 1
                    },
                    {
                        "id": 2,
                        "answer": "Separation of concerns",
                        "feedback": "fake feedback",
                        "correct": 0
                    }
                ]
            },
            {
                "id": 2,
                "question": "What is DI short for?",
                "hint": "Check notes",
                "points": 1,
                "answers": [
                    {
                        "id": 3,
                        "answer": "Dependency inclusion",
                        "feedback": "fake feedback",
                        "correct": 0
                    },
                    {
                        "id": 5,
                        "answer": "Dependency Injection",
                        "feedback": "fake feedback",
                        "correct": 1
                    }
                ]
            }
        ]
    }
}
```

* **Error Response:**

    * **Code:** 404 NOT FOUND <br />
      **Content:** `{"message": "Quiz not found"}`

### Add a new quiz

* **URL**

  /api/quizzes

* **Method:**

  `POST`

* **Body Data**

  Must be sent as JSON with the correct headers

  **Required:**

    ```json
    {
      "name": "string",
      "description": "string"
    }
    ```

  **Optional:**

  There is no optional body data

  **Example:**

  `/api/quizzes`

    * **Success Response:**

        * **Code:** 201 CREATED <br />
          **Content:** <br />

      ```json
      {"message": "Quiz created"}
      ```

* **Error Response:**

    * **Code:** 500 INTERNAL SERVER ERROR <br />
      **Content:**
      ```json
      {
          "message": "Quiz creation failed"
      }
      ```
    * **Code:** 422 UNPROCESSABLE CONTENT <br />
      **Content:**
    ```json
    {
        "message": "The name field is required. (and 1 more error)",
        "errors": {
            "name": [
                "The name field is required."
            ],
            "description": [
                "The description field is required."
            ]
        }
    }
    ```

### Edit a quiz

* **URL**

  /api/quizzes/{id}

* **Method:**

  `PUT`

* **Body Data**

  Must be sent as JSON with the correct headers

  **Required:**

    ```json
    {
      "name": "string",
      "description": "string"
    }
    ```

  **Optional:**

  There is no optional body data

  **Example:**

  `/api/quizzes/1`

    * **Success Response:**

        * **Code:** 201 CREATED <br />
          **Content:** <br />

      ```json
      {"message": "Quiz created"}
      ```

* **Error Response:**

    * **Code:** 404 NOT FOUND <br />
      **Content:**
    ```json
    {
        "message": "Quiz not found"
    }
    ```
    * **Code:** 422 UNPROCESSABLE CONTENT <br />
      **Content:**
    ```json
    {
        "message": "The name field is required. (and 1 more error)",
        "errors": {
            "name": [
                "The name field is required."
            ],
            "description": [
                "The description field is required."
            ]
        }
    }
    ```
    * **Code:** 500 INTERNAL SERVER ERROR <br />
      **Content:**
      ```json
      {
          "message": "Quiz editing failed"
      }
      ```


### Add a new question

* **URL**

  /api/questions

* **Method:**

  `POST`

* **Body Data**

  Must be sent as JSON with the correct headers

  **Required:**

    ```json
    {
      "question": "string",
      "points": integer,
      "quiz_id": integer
    }
    ```

  **Optional:**

  ```json
  {
     "hint": "string"
  }
  ```

  **Example:**

  `/api/questions`

    * **Success Response:**

        * **Code:** 201 CREATED <br />
          **Content:** <br />

      ```json
      {"message": "Question created"}
      ```

* **Error Response:**

    * **Code:** 500 INTERNAL SERVER ERROR <br />
      **Content:**
      ```json
      {
          "message": "Question creation failed"
      }
      ```
    * **Code:** 422 UNPROCESSABLE CONTENT <br />
      **Content:**
    ```json
    {
        "message": "The question field is required. (and 2 more errors)",
        "errors": {
            "question": [
                "The question field is required."
            ],
            "points": [
                "The points field is required."
            ],
            "quiz_id": [
                "The quiz id field is required."
            ]
        }
    }
    ```

### Edit a question

* **URL**

  /api/questions/{id}

* **Method:**

  `PUT`

* **Body Data**

  Must be sent as JSON with the correct headers

  **Required:**

    ```json
    {
      "question": "string",
      "points": integer,
    }
    ```

  **Optional:**

  ```json
  {
     "hint": "string"
  }
  ```

  **Example:**

  `/api/questions/1`

    * **Success Response:**

        * **Code:** 200 SUCCESS <br />
          **Content:** <br />

      ```json
      {"message": "Question edited"}
      ```

* **Error Response:**

    * **Code:** 404 NOT FOUND <br />
      **Content:**
    ```json
    {
        "message": "Question not found"
    }
    ```
    * **Code:** 422 UNPROCESSABLE CONTENT <br />
      **Content:**
    ```json
    {
        "message": "The question field is required. (and 1 more error)",
        "errors": {
            "question": [
                "The question field is required."
            ],
            "points": [
                "The points field is required."
            ]
        }
    }
    ```
    * **Code:** 500 INTERNAL SERVER ERROR <br />
      **Content:**
      ```json
      {
          "message": "Question editing failed"
      }
      ```

### Delete question

* **URL**

  /api/questions/{id}

* **Method:**

  `DELETE`

  **Example:**

  `/api/questions/1`

* **Success Response:**

    * **Code:** 200 OK <br />
      **Content:** <br />

  ```json
  {"message": "Question deleted"}
  ```

* **Error Response:**

    * **Code:** 404 NOT FOUND <br />
      **Content:** `{"message": "Question not found"}`

### Add a new answer

* **URL**

  /api/answers

* **Method:**

  `POST`

* **Body Data**

  Must be sent as JSON with the correct headers

  **Required:**

    ```json
    {
      "answer": "string",
      "correct": boolean,
      "question_id": integer
    }
    ```

  **Optional:**

  There is no optional body data

  **Example:**

  `/api/answers`

    * **Success Response:**

        * **Code:** 201 CREATED <br />
          **Content:** <br />

      ```json
      {"message": "Answer created"}
      ```

* **Error Response:**

    * **Code:** 500 INTERNAL SERVER ERROR <br />
      **Content:**
      ```json
      {
          "message": "Answer creation failed"
      }
      ```
    * **Code:** 422 UNPROCESSABLE CONTENT <br />
      **Content:**
    ```json
    {
        "message": "The answer field is required. (and 2 more errors)",
        "errors": {
            "answer": [
                "The answer field is required."
            ],
            "correct": [
                "The correct field is required."
            ],
            "question_id": [
                "The question id field is required."
            ]
        }
    }
    ```

### Edit an answer

* **URL**

  /api/answers/{id}

* **Method:**

  `PUT`

* **Body Data**

  Must be sent as JSON with the correct headers

  **Required:**

    ```json
    {
      "answer": "string",
      "correct": boolean,
    }
    ```

  **Optional:**

  There is no optional body data

  **Example:**

  `/api/answers/1`

    * **Success Response:**

        * **Code:** 200 SUCCESS <br />
          **Content:** <br />

      ```json
      {"message": "Answer edited"}
      ```

* **Error Response:**

    * **Code:** 404 NOT FOUND <br />
      **Content:**
    ```json
    {
        "message": "Answer not found"
    }
    ```
    * **Code:** 422 UNPROCESSABLE CONTENT <br />
      **Content:**
    ```json
    {
        "message": "The question field is required. (and 1 more error)",
        "errors": {
            "question": [
                "The question field is required."
            ],
            "points": [
                "The points field is required."
            ]
        }
    }
    ```
    * **Code:** 500 INTERNAL SERVER ERROR <br />
      **Content:**
      ```json
      {
          "message": "Answer editing failed"
      }
      ```

### Delete answer

* **URL**

  /api/answers/{id}

* **Method:**

  `DELETE`

  **Example:**

  `/api/answers/1`

* **Success Response:**

    * **Code:** 200 OK <br />
      **Content:** <br />

  ```json
  {"message": "Answer deleted"}
  ```

* **Error Response:**

    * **Code:** 404 NOT FOUND <br />
      **Content:** `{"message": "Answer not found"}`


### Get quiz results

* **URL**

  /api/scores

* **Method:**

  `POST`

* **Body Data**

  Must be sent as JSON with the correct headers

  **Required:**

    ```json
    {
      "quiz": integer,
      "answers": [
        {
          "question": "integer",
          "answer": integer
        }
      ]
    }
    ```
  
    Answers array must contain an object to represent each question/answer, including the id of the question and the id of the answer selected

  **Optional:**

  There is no optional body data

  **Example:**

  `/api/scores`

    * **Success Response:**

        * **Code:** 200 SUCCESS <br />
          **Content:** <br />

      ```json
      {
        "message": "Score calculated",
        "data": {
          "question_count": integer,
          "correct_count": integer,
          "available_points": integer,
          "points": integer
        }
      }
      ```

* **Error Response:**

    * **Code:** 422 UNPROCESSABLE CONTENT <br />
      **Content:**
    ```json
    {
        "message": "The quiz field is required. (and 1 more error)",
        "errors": {
            "quiz": [
                "The quiz field is required."
            ],
            "answers": [
                "The answers field is required."
            ]
        }
    }
    ```
