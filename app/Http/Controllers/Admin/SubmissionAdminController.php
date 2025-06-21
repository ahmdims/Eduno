<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class SubmissionAdminController extends Controller
{
    /**
     * Display a listing of the submissions.
     */
    public function index()
{
    $submissions = Submission::with(['user' => function($query) {
        $query->select('id', 'name', 'status', 'reason'); // Hanya ambil kolom yang diperlukan
    }, 'quiz'])
    ->latest()
    ->paginate(10);

    return view('admin.submission.index', compact('submissions'));
}

    /**
     * Display the specified submission.
     */
    public function show(Submission $submission)
{
    $answers = is_array($submission->answers)
        ? $submission->answers
        : json_decode($submission->answers, true) ?? [];

    // Tanpa withTrashed karena tidak pakai SoftDeletes
    $quiz = Quiz::with('questions')->findOrFail($submission->quiz_id);

    $detailedAnswers = [];

    foreach ($answers as $questionId => $userAnswer) {
        $question = $quiz->questions->firstWhere('id', $questionId);

        $detailedAnswers[] = [
            'question_id' => $questionId,
            'question_text' => $question->text ?? '[Deleted Question]',
            'user_answer' => $userAnswer,
            'correct_answer' => $question->correct_answer ?? 'N/A',
            'is_correct' => $question ? $this->checkAnswerCorrectness($question, $userAnswer) : false
        ];
    }

    return view('admin.submission.show', [
        'submission' => $submission,
        'answers' => $detailedAnswers
    ]);
}

    /**
     * Check if user's answer is correct
     */
    private function checkAnswerCorrectness(Question $question, $userAnswer): bool
    {
        // Handle different question types if needed
        if ($question->type === 'multiple_choice') {
            return strtolower(trim($userAnswer)) === strtolower(trim($question->correct_answer));
        }

        // Default comparison (for text/short answers)
        return strtolower(trim($userAnswer)) === strtolower(trim($question->correct_answer));
    }
}
