<?php

namespace App\Http\Controllers;

use App\Modules\FunFact\Models\FunFact;
use Illuminate\Http\Request;

class FunFactController extends Controller
{
    /**
     * Mostrar página de Fun Facts con carrusel
     */
    public function index($locale)
    {
        // Obtener todos los fun facts activos ordenados
        $funFacts = FunFact::active()->ordered()->get();
        
        // Obtener fun facts aleatorios para el carrusel (6 items)
        $randomFacts = FunFact::getRandom(6);
        
        // Obtener categorías para filtros
        $categories = \App\Modules\Category\Models\Category::active()
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        return view('pages.fun-facts.index', compact('funFacts', 'randomFacts', 'categories'));
    }
}