<?php

namespace App\Http\Controllers;

use App\Modules\Category\Models\Category;
use App\Modules\Article\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{
    public function index()
    {
        $locale = App::getLocale();
        
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->withCount(['articles' => function ($query) {
                $query->where('status', 'published')
                      ->where('published_at', '<=', now());
            }])
            ->orderBy('sort_order')
            ->get();

        return view('pages.categories.index', compact('categories', 'locale'));
    }

    public function show($locale, $slug)
    {
        $locale = App::getLocale();
        
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $query = Article::with(['categories', 'users'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category->id);
            });

        $articles = $query->orderBy('published_at', 'desc')
            ->paginate(12);

        // Categorías relacionadas (hermanas)
        $relatedCategories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->withCount(['articles' => function ($query) {
                $query->where('status', 'published')
                      ->where('published_at', '<=', now());
            }])
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        return view('pages.categories.show', compact('category', 'articles', 'relatedCategories', 'locale'));
    }
}