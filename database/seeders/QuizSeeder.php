<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;

class QuizSeeder extends Seeder
{
    public function run()
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            for ($i = 1; $i <= 5; $i++) {
                $quiz = Quiz::create([
                    'course_id' => $course->id,
                    'title' => 'Quiz ' . $i,
                ]);

                $questionsData = [
                    [
                        'question' => 'Question ' . $i . ' - Question 1',
                        'options' => ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                        'answer' => 'Option 1',
                    ],
                    [
                        'question' => 'Question ' . $i . ' - Question 2',
                        'options' => ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                        'answer' => 'Option 2',
                    ],
                    [
                        'question' => 'Question ' . $i . ' - Question 3',
                        'options' => ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                        'answer' => 'Option 3',
                    ],
                    [
                        'question' => 'Question ' . $i . ' - Question 4',
                        'options' => ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                        'answer' => 'Option 4',
                    ],
                ];

                foreach ($questionsData as $qData) {
                    $question = Question::create([
                        'quiz_id' => $quiz->id,
                        'question' => $qData['question'],
                        'answer' => $qData['answer'],
                    ]);

                    foreach ($qData['options'] as $optionText) {
                        Option::create([
                            'question_id' => $question->id,
                            'option_text' => $optionText,
                        ]);
                    }
                }
            }
        }
    }
}
