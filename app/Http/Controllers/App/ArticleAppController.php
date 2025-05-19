<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleAppController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $categoryId = $request->get('category_id');

        $articles = Article::with('category')
            ->published()
            ->byCategory($categoryId)
            ->get();

        return view('app.article.index', compact('articles', 'categories', 'categoryId'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $relatedArticles = Article::getRelatedArticles($slug);

        return view('app.article.show', compact('article', 'relatedArticles'));
    }
}
