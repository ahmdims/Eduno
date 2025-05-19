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
        return response()->json($material);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'video' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        $material = Material::findOrFail($id);

        $material->course_id = $validated['course_id'];
        $material->title = $validated['title'];
        $material->video = $validated['video'];
        $material->content = $validated['content'];
        $material->save();

        return redirect()->route('admin.course.edit', $material->course->slug)
            ->with('success', 'Material successfully updated.');
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
