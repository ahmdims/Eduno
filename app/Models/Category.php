<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relasi ke model Course (One to Many)
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}