<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialAdminController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'video' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        $course = Course::findOrFail($validated['course_id']);

        $material = new Material();
        $material->course_id = $validated['course_id'];
        $material->title = $validated['title'];
        $material->video = $validated['video'];
        $material->content = $validated['content'];
        $material->save();

        return redirect()->route('admin.course.edit', $course->slug)
            ->with('success', 'Material successfully added.');
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        $courses = Course::all();

        return view('admin.material.edit', compact('material', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'video' => 'nullable|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:0,1',
        ]);

        $material = Material::findOrFail($id);

        $material->course_id = $validated['course_id'];
        $material->title = $validated['title'];
        $material->video = $validated['video'];
        $material->content = $validated['content'];
        $material->status = $validated['status'];
        $material->save();

        return redirect()->route('admin.material.edit', $material->id)
            ->with('success', 'Material updated successfully!');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $courseSlug = $material->course->slug;

        $material->delete();

        return redirect()->route('admin.course.edit', $courseSlug)
            ->with('success', 'Material successfully deleted.');
    }
}
