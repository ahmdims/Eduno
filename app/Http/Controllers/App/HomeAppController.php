<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Article;
use App\Models\Faq;
use App\Models\Review;
use App\Models\Website;

class HomeAppController extends Controller
{
    public function index()
    {
        $articles = Article::published()->latest()->take(4)->get();
        $faqs = Faq::latest()->take(4)->get();
        $reviews = Review::with('user')->latest()->take(3)->get();

        $courses = Course::published()
            ->withCount(['quizzes', 'reviews'])
            ->withCount([
                'quizzes as submissions_count' => function ($query) {
                    $query->withCount('submissions');
                }
            ])
            ->orderBy('submissions_count', 'desc')
            ->orderBy('reviews_count', 'desc')
            ->take(3)
            ->get();

        $website = Website::first();

        return view('app.home.index', compact('articles', 'faqs', 'reviews', 'courses', 'website'));
    }
}
