<?php

namespace App\Http\Controllers;

use App\Modules\Interview\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    /**
     * Mostrar listado de entrevistas
     */
    public function index($locale)
    {
        $interviews = Interview::where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with(['categories', 'tags'])
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $featuredInterview = Interview::where('status', 'published')
            ->where('is_featured', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with(['categories', 'tags'])
            ->first();

        $categories = \App\Modules\Category\Models\Category::active()
            ->orderBy('sort_order')
            ->get();

        return view('pages.interviews.index', compact('interviews', 'featuredInterview', 'categories'));
    }

    /**
     * Mostrar entrevista individual
     */
    public function show($locale, $slug)
    {
        $interview = Interview::where('slug', $slug)
            ->where('status', 'published')
            ->with(['categories', 'tags'])
            ->firstOrFail();

        // Entrevistas relacionadas
        $relatedInterviews = Interview::where('status', 'published')
            ->where('id', '!=', $interview->id)
            ->whereHas('categories', function ($query) use ($interview) {
                $query->whereIn('categories.id', $interview->categories->pluck('id'));
            })
            ->limit(3)
            ->get();

        return view('pages.interviews.show', compact('interview', 'relatedInterviews'));
    }
}