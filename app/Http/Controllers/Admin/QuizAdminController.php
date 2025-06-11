<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class QuizAdminController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('course')->latest()->get();
        return view('admin.course.edit', compact('quizzes'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.quiz.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'course_id' => ['required', 'exists:courses,id'],
        'questions' => ['required', 'array', 'min:1', 'max:5'],
        'questions.*.question' => ['required', 'string', 'max:255'],
        'questions.*.options' => ['required', 'array', 'min:2', 'max:6'],
        'questions.*.options.*' => ['required', 'string', 'max:255'],
        'questions.*.answer' => ['required', 'string', 'max:255'],
    ]);


        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->course_id = $request->course_id;
        $quiz->save();

        // Save questions and options
        foreach ($request->questions as $q) {
            $question = new Question();
            $question->quiz_id = $quiz->id;
            $question->question = $q['question'];
            $question->answer = $q['answer'];
            $question->save();

            foreach ($q['options'] as $optionText) {
                $option = new Option();
                $option->question_id = $question->id;
                $option->option_text = $optionText;
                $option->save();
            }
        }

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz created successfully!');
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $courses = Course::all();
        return view('admin.quiz.edit', compact('quiz', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'questions' => 'required|array|min:1|max:5',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.options' => 'required|array|min:2|max:6',
            'questions.*.options.*' => 'required|string|max:255',
            'questions.*.answer' => 'required|string|max:255',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->title = $request->title;
        $quiz->course_id = $request->course_id;
        $quiz->save();

        // Hapus pertanyaan lama dan opsinya dulu supaya tidak duplikat
        foreach ($quiz->questions as $oldQuestion) {
            $oldQuestion->options()->delete();
        }
        $quiz->questions()->delete();

        // Simpan pertanyaan baru dan opsinya
        foreach ($request->questions as $q) {
            $question = new Question();
            $question->quiz_id = $quiz->id;
            $question->question = $q['question'];
            $question->answer = $q['answer'];
            $question->save();

            foreach ($q['options'] as $optionText) {
                $option = new Option();
                $option->question_id = $question->id;
                $option->option_text = $optionText;
                $option->save();
            }
        }

        return redirect()->back()->with('success', 'Quiz updated successfully!');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz deleted successfully!');
    }

    private function prepareQuestions(array $questions): array
    {
        return array_map(function ($question) {
            return [
                'question' => $question['question'],
                'options' => $question['options'],
                'answer' => $question['answer'],
            ];
        }, $questions);
    }
}
