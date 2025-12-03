<?php

namespace App\Http\Controllers;

use App\Modules\Article\Models\Article;
use App\Modules\Category\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener artículos destacados
        $featuredArticles = Article::where('is_featured', true)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['categories', 'users', 'tags'])
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        // Obtener artículos recientes
        $recentArticles = Article::where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['categories', 'users', 'tags'])
            ->orderBy('published_at', 'desc')
            ->take(8)
            ->get();

        // Obtener categorías principales
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('pages.home', compact('featuredArticles', 'recentArticles', 'categories'));
    }
}