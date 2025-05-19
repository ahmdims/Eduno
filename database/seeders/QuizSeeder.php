<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            for ($i = 1; $i <= 5; $i++) {
                Quiz::create([
                    'course_id' => $course->id,
                    'title' => 'Quiz ' . $i,
                    'question' => json_encode([
                        [
                            'question' => 'Question ' . $i . ' - Question 1',
                            'options' => ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                            'answer' => 'Option 1',
                        ],
                        [
                            'question' => 'Question ' . $i . ' - Question 1',
                            'options' => ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                            'answer' => 'Option 2',
                        ],
                        [
                            'question' => 'Question ' . $i . ' - Question 1',
                            'options' => ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                            'answer' => 'Option 3',
                        ],
                        [
                            'question' => 'Question ' . $i . ' - Question 1',
                            'options' => ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                            'answer' => 'Option 4',
                        ],
                    ]),
                ]);
            }
        }
    }
}
