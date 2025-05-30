<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Material extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'materials';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['course_id', 'title', 'video', 'content', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
