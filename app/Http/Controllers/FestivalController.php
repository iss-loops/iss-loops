<?php

namespace App\Http\Controllers;

use App\Models\FestivalWinner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FestivalController extends Controller
{
    /**
     * Mostrar listado de ganadores del festival
     */
    public function index($locale, Request $request)
    {
        App::setLocale($locale);

        // Obtener filtros de la request
        $year = $request->input('year', 2025);
        $category = $request->input('category');

        // Query base
        $query = FestivalWinner::active()
            ->year($year)
            ->orderBy('award_level')
            ->orderBy('sort_order')
            ->orderBy('student_name->es');

        // Filtro por categoría si existe
        if ($category) {
            $query->category($category);
        }

        $winners = $query->get();

        // Ganadores destacados
        $featuredWinners = FestivalWinner::active()
            ->featured()
            ->year($year)
            ->limit(3)
            ->get();

        // Años disponibles para el filtro
        $availableYears = FestivalWinner::active()
            ->distinct()
            ->pluck('year')
            ->sort()
            ->reverse();

        // Categorías disponibles
        $categories = [
            'physics' => __('Physics'),
            'biology' => __('Biology'),
            'technology' => __('Technology'),
            'chemistry' => __('Chemistry'),
            'mathematics' => __('Mathematics'),
        ];

        return view('pages.festival.index', compact(
            'winners',
            'featuredWinners',
            'availableYears',
            'categories',
            'year',
            'category'
        ));
    }

    /**
     * Mostrar detalle de un ganador
     */
    public function show($locale, $id)
    {
        App::setLocale($locale);

        $winner = FestivalWinner::active()->findOrFail($id);

        // Ganadores relacionados (misma categoría, mismo año, excluyendo el actual)
        $relatedWinners = FestivalWinner::active()
            ->where('id', '!=', $winner->id)
            ->where('category', $winner->category)
            ->where('year', $winner->year)
            ->limit(3)
            ->get();

        return view('pages.festival.show', compact('winner', 'relatedWinners'));
    }
}