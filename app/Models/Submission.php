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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
