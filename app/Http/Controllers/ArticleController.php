<?php

namespace App\Http\Controllers;

use App\Modules\Article\Models\Article;
use App\Modules\Category\Models\Category;
use App\Modules\Tag\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $locale = App::getLocale();
        
        $query = Article::with(['categories', 'users'])
            ->where('status', 'published')
            ->where('published_at', '<=', now());

        // Búsqueda - CORREGIDA para Laravel 12
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title->es', 'LIKE', "%{$search}%")
                  ->orWhere('title->en', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt->es', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt->en', 'LIKE', "%{$search}%")
                  ->orWhere('body->es', 'LIKE', "%{$search}%")
                  ->orWhere('body->en', 'LIKE', "%{$search}%");
            });
        }

        // Filtro por categoría
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filtro por tag
        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Ordenamiento
        $orderBy = $request->get('order_by', 'recent');
        switch ($orderBy) {
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'featured':
                $query->orderBy('is_featured', 'desc')
                      ->orderBy('published_at', 'desc');
                break;
            case 'recent':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        $articles = $query->paginate(12)->withQueryString();
        
        $categories = Category::where('is_active', true)
            ->withCount(['articles' => function ($query) {
                $query->where('status', 'published')
                      ->where('published_at', '<=', now());
            }])
            ->orderBy('sort_order')
            ->get();
        
        $popularTags = Tag::has('articles')->take(20)->get();
        
        $activeFilters = [
            'search' => $request->search,
            'category' => $request->category,
            'tag' => $request->tag,
            'sort' => $orderBy !== 'recent' ? $orderBy : null, 
        ];
        
        $activeCategory = $request->filled('category') 
            ? Category::where('slug', $request->category)->first() 
            : null;
        
        $activeTag = $request->filled('tag')
            ? Tag::where('slug', $request->tag)->first()
            : null;

        return view('pages.articles.index', compact(
            'articles',
            'categories',
            'popularTags',
            'activeFilters',
            'activeCategory',
            'activeTag',
            'locale'
        ));
    }

    public function show($locale, $slug)
    {
        $locale = App::getLocale();
        
        $article = Article::with(['categories', 'users', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $relatedArticles = Article::with(['categories', 'users'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->where('id', '!=', $article->id)
            ->whereHas('categories', function ($query) use ($article) {
                $query->whereIn('categories.id', $article->categories->pluck('id'));
            })
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.articles.show', compact('article', 'relatedArticles', 'locale'));
    }
}