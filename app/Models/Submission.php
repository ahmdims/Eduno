<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Submission extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'submissions';

    // UUID tidak auto-increment
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['user_id', 'quiz_id', 'score', 'answers'];

    protected $casts = [
        'answers' => 'array' // Automatically cast JSON to array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Accessor for formatted answers
     */
    public function getFormattedAnswersAttribute()
    {
        return collect($this->answers)->map(function($answer, $questionId) {
            $question = Question::withTrashed()->find($questionId);

            return [
                'question' => $question ? $question->text : 'Deleted Question',
                'user_answer' => $answer,
                'correct_answer' => $question ? $question->correct_answer : 'N/A',
                'is_correct' => $question ? $this->checkAnswerCorrectness($question, $answer) : false
            ];
        });
    }

    /**
     * Check answer correctness
     */
    private function checkAnswerCorrectness(Question $question, $answer): bool
    {
        return strtolower(trim($answer)) === strtolower(trim($question->correct_answer));
    }
}
