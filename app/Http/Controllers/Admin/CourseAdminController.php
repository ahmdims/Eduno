<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CourseAdminController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();
        $categories = Category::all();

        return view('admin.course.index', compact('courses', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.course.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'level' => 'required|string',
            'language' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video' => 'required|string',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('course', 'public');
        }

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'level' => $request->level,
            'language' => $request->language,
            'thumbnail' => $thumbnailPath,
            'video' => $request->video,
        ]);

        return redirect()->route('admin.course.index')->with('success', 'Course created successfully!');
    }

    public function edit($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $materials = $course->materials;
        $quizzes = $course->quizzes;

        return view('admin.course.edit', compact('course', 'categories', 'materials', 'quizzes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'level' => 'required|string',
            'language' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video' => 'required|string',
        ]);

        $course = Course::findOrFail($id);

        $thumbnailPath = $course->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('course', 'public');
        }

        $course->update([
            'title' => $request->title,
            'slug' => $course->slug,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'level' => $request->level,
            'language' => $request->language,
            'video' => $request->video,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('admin.course.edit', $course->slug)->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.course.index')->with('success', 'Course deleted successfully!');
    }
}
