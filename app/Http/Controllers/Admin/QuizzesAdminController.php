<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Submission;
use Illuminate\Http\Request;

class QuizzesAdminController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array|min:1|max:5',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.options' => 'required|array|min:2|max:6',
            'questions.*.options.*' => 'required|string|max:255',
            'questions.*.answer' => 'required|string|max:255',
        ]);

        $questions = array_map(function ($question) {
            return [
                'question' => $question['question'],
                'options' => $question['options'],
                'answer' => $question['answer'],
            ];
        }, $request->questions);

        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->question = json_encode($questions);
        $quiz->save();

        return redirect()->route('quiz.index')->with('success', 'Quiz created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array|min:1|max:5',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.options' => 'required|array|min:2|max:6',
            'questions.*.options.*' => 'required|string|max:255',
            'questions.*.answer' => 'required|string|max:255',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->title = $request->title;

        $questions = array_map(function ($question) {
            return [
                'question' => $question['question'],
                'options' => $question['options'],
                'answer' => $question['answer'],
            ];
        }, $request->questions);

        $quiz->question = json_encode($questions);
        $quiz->save();

        return redirect()->route('quiz.index')->with('success', 'Quiz updated successfully!');
    }
}
