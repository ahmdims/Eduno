<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Quiz extends Model
{
    use HasUuids;

    protected $table = 'quiz';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['title', 'course_id', 'material_id', 'question'];

    // Remove this duplicate relationship
    // public function quiz()
    // {
    //     return $this->belongsTo(Quiz::class);
    // }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function options()
    {
        return $this->hasManyThrough(Option::class, Question::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
