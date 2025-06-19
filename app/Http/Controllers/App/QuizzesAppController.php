<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class QuizzesAppController extends Controller
{
    public function index()
    {
        $quizz = Quiz::with('course')->get();
        return view('quiz.index', compact('quizz'));
    }

    public function show($id)
    {
        $quiz = Quiz::with(['questions.options', 'course'])->findOrFail($id);

        // Clear previous session data if starting fresh
        if (!Session::has('quiz_started_'.$quiz->id)) {
            Session::put('quiz_started_'.$quiz->id, true);
            Session::forget('quiz_'.$quiz->id.'_answers');
        }

        return view('quiz.show', compact('quiz'));
    }
    public function saveDraft(Request $request, $quizId)
    {
        $questionId = $request->question_id;
        $optionId = $request->option_id;

        // Simpan di session
        Session::put("quiz_{$quizId}_question_{$questionId}", $optionId);

        return response()->json(['success' => true]);
    }

 public function submitQuiz(Request $request, $quizId)
    {
        $quiz = Quiz::with(['course', 'questions.options'])->findOrFail($quizId);
        $course = $quiz->course; // Get the course from quiz relationship

        $score = 0;
        $userAnswers = [];

        foreach ($quiz->questions as $question) {
            $optionId = Session::get("quiz_{$quizId}_question_{$question->id}")
                        ?? $request->input("question_{$question->id}");

            $selectedOption = $question->options->firstWhere('id', $optionId);
            $userAnswers[$question->id] = $selectedOption ? $selectedOption->option_text : null;

            if ($selectedOption && $selectedOption->option_text == $question->answer) {
                $score += (100 / $quiz->questions->count());
            }

            Session::forget("quiz_{$quizId}_question_{$question->id}");
        }

        Session::forget('quiz_started_'.$quizId);

        Submission::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'answers' => json_encode($userAnswers),
        ]);

        return view('app.quiz.result', compact('quiz', 'score', 'userAnswers', 'course'));
    }

    public function result($quizId)
    {
        $quiz = Quiz::with('course')->findOrFail($quizId);
        $course = $quiz->course;

        $submission = Submission::where('user_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->first();

        if (!$submission) {
            return redirect()->route('quiz.show', $quizId);
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
