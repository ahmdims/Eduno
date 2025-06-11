<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\Review;
use App\Models\Submission;
use Illuminate\Http\Request;

class CourseAppController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $categoryId = $request->get('category_id');

        $courses = Course::with('category')
            ->published()
            ->byCategory($categoryId)
            ->get();

        return view('app.course.index', compact('courses', 'categories', 'categoryId'));
    }

    public function storeReview(Request $request, $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        $existingReview = Review::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingReview) {
            return redirect()->route('course.show', $slug)
                ->with('error', 'You have already submitted a review for this course.');
        }

        $request->validate([
            'review' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'review' => $request->review,
        ]);

        return redirect()->route('course.show', $slug)
            ->with('success', 'Your review has been posted.');
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)
            ->with(['category', 'materials', 'quizzes', 'reviews'])
            ->withLatestReviews()
            ->firstOrFail();

        $totalReviews = $course->reviews()->count();
        $studentCountText = $course->totalStudents();
        $userReview = $course->reviews()->where('user_id', auth()->id())->first();
        $relatedCourses = Course::getRelatedCourses($slug, $course->category_id);

        $timeline = collect();

        foreach ($course->materials as $material) {
            $timeline->push([
                'type' => 'material',
                'title' => $material->title,
                'created_at' => $material->created_at,
                'id' => $material->id,
                'slug' => $course->slug,
            ]);
        }

        foreach ($course->quizzes as $quiz) {
            $timeline->push([
                'type' => 'quiz',
                'title' => $quiz->title,
                'created_at' => $quiz->created_at,
                'id' => $quiz->id,
                'slug' => $course->slug,
            ]);
        }

        $timeline = $timeline->sortBy('created_at');

        return view('app.course.show', compact(
            'course',
            'relatedCourses',
            'userReview',
            'totalReviews',
            'studentCountText',
            'timeline'
        ));
    }

    public function showMaterial($slug, $materialId)
    {
        $material = Material::whereHas('course', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->findOrFail($materialId);

        $materials = $material->course->materials;

        $course = $material->course;

        return view('app.material.show', compact('material', 'materials', 'course'));
    }

    public function showQuiz($slug, $quizId)
    {
        $quiz = Quiz::whereHas('course', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->findOrFail($quizId);

        $quiz->question = json_decode($quiz->question, true);

        $submission = Submission::where('user_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->first();

        if ($submission) {
            return redirect()->route('quiz.result', ['slug' => $slug, 'quiz' => $quiz->id]);
        }

        $course = $quiz->course;

        return view('app.quiz.show', compact('quiz', 'slug', 'course'));
    }
}
