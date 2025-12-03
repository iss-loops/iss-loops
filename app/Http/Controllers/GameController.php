<?php

namespace App\Http\Controllers;

use App\Modules\Game\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of games
     */
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        
        $query = Game::query()
            ->active()
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc');

        // Filtrar por tipo si se especifica
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filtrar por dificultad si se especifica
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        // Búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search, $locale) {
                $q->where("title->{$locale}", 'like', "%{$search}%")
                  ->orWhere("description->{$locale}", 'like', "%{$search}%");
            });
        }

        $games = $query->paginate(12);

        // Juegos destacados
        $featuredGames = Game::active()
            ->featured()
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        // Tipos disponibles con contador
        $types = Game::active()
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type');

        return view('pages.games.index', compact('games', 'featuredGames', 'types'));
    }

    /**
     * Display a specific game
     */
    public function show($locale, $slug)
    {
        $game = Game::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Incrementar contador de juegos
        $game->incrementPlayCount();

        // Juegos relacionados del mismo tipo
        $relatedGames = Game::active()
            ->where('type', $game->type)
            ->where('id', '!=', $game->id)
            ->orderBy('play_count', 'desc')
            ->limit(3)
            ->get();

        return view('pages.games.show', compact('game', 'relatedGames'));
    }
}