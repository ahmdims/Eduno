<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Submission;
use Illuminate\Http\Request;

class QuizzesAppController extends Controller
{
    public function index()
    {
        $quizz = Quiz::with('course')->get();
        return view('quiz.index', compact('quizz'));
    }

    public function show($id)
    {
        $quiz = Quiz::with(['material.course'])->findOrFail($id);

        return view('quiz.show', compact('quiz'));
    }

    public function submitQuiz(Request $request, $slug, $quizId)
    {
        $quiz = Quiz::whereHas('course', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->with('course')->findOrFail($quizId);

        $course = $quiz->course;

        $questions = json_decode($quiz->question, true);
        $score = 0;
        $userAnswers = [];

        foreach ($questions as $index => $question) {
            $correctAnswer = $question['answer'];
            $userAnswer = $request->input('question_' . $index);
            $userAnswers[] = $userAnswer;

            if ($userAnswer == $correctAnswer) {
                $score += 100;
            }
        }

        Submission::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'answers' => json_encode($userAnswers),
        ]);

        return view('app.quiz.result', compact('quiz', 'score', 'userAnswers', 'course'));
    }

    public function result($slug, $quizId)
    {
        $quiz = Quiz::whereHas('course', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->findOrFail($quizId);

        $course = $quiz->course;

        $submission = Submission::where('user_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->first();

        if (!$submission) {
            return redirect()->route('quiz.show', ['slug' => $slug, 'quiz' => $quizId]);
        }

        $userAnswers = json_decode($submission->answers, true);
        $score = $submission->score;

        return view('app.quiz.result', compact('quiz', 'score', 'userAnswers', 'course'));
    }

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
