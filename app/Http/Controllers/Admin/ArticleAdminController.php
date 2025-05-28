<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ArticleAdminController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('category')->get();
        $categories = Category::all();

        return view('admin.article.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '.webp';
            $imagePath = 'article/' . $imageName;

            $img = Image::make($image->getRealPath())
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 75);

            Storage::disk('public')->put($imagePath, $img);
            $thumbnailPath = $imagePath;
        }

        Article::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'status' => $request->status,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->back()->with('success', 'Article created successfully!');
    }

    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return response()->json($article);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $article = Article::findOrFail($id);

        $thumbnailPath = $article->thumbnail;

        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            $image = $request->file('thumbnail');
            $imageName = time() . '.webp';
            $imagePath = 'article/' . $imageName;

            $img = Image::make($image->getRealPath())
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 75);

            Storage::disk('public')->put($imagePath, $img);
            $thumbnailPath = $imagePath;
        }

        $article->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status'),
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->back()->with('success', 'Article updated successfully!');
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return redirect()->back()->with('success', 'Article deleted successfully!');
    }
}
