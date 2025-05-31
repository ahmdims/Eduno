<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'video' => 'nullable|string',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '.webp';
            $imagePath = 'course/' . $imageName;

            $img = Image::make($image->getRealPath())
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 75);

            Storage::disk('public')->put($imagePath, $img);
            $thumbnailPath = $imagePath;
        }

        Course::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'level' => $request->level,
            'language' => $request->language,
            'thumbnail' => $thumbnailPath,
            'video' => $request->video,
        ]);

        return redirect()->route('admin.course.index')
            ->with('success', 'Course created successfully!');
    }

    public function edit($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $materials = $course->materials;
        $quizzes = $course->quizzes;

        return view('admin.course.edit', compact('course', 'categories', 'materials', 'quizzes'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
            'level' => 'required|string',
            'language' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video' => 'nullable|string',
        ]);

        $course = Course::where('slug', $slug)->firstOrFail();

        if ($request->has('thumbnail_remove') && $request->thumbnail_remove == 1) {
            if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $course->thumbnail = null;
        }

        $thumbnailPath = $course->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            $image = $request->file('thumbnail');
            $imageName = time() . '.webp';
            $imagePath = 'course/' . $imageName;

            $img = Image::make($image->getRealPath())
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 75);

            Storage::disk('public')->put($imagePath, $img);
            $thumbnailPath = $imagePath;
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

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Course updated successfully!',
                'redirect_url' => route('admin.course.index'),
            ]);
        }

        return redirect()->route('admin.course.index')
            ->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json(['success' => true, 'message' => 'Course deleted successfully!']);
    }
}
