<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'status', 'description', 'category_id', 'level', 'language', 'thumbnail', 'video'];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->when($categoryId, function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        });
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    public function scopeWithLatestReviews($query)
    {
        return $query->with([
            'reviews' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ]);
    }

    public function totalStudents()
    {
        $count = Submission::whereIn('quiz_id', $this->quizzes->pluck('id'))
            ->distinct('user_id')
            ->count();

        return $count . ' student' . ($count > 1 ? 's' : '');
    }

    public static function getRelatedCourses($slug, $categoryId, $limit = 4)
    {
        return self::where('status', 'Published')
            ->where('slug', '!=', $slug)
            ->latest()
            ->take($limit)
            ->get();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function submissions()
    {
        return $this->hasManyThrough(Submission::class, Quiz::class);
    }
}
