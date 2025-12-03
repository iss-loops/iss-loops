<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Mostrar todos los favoritos del usuario
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Obtener tipo de contenido (articles, interviews, news)
        $type = $request->get('type', 'all');
        
        $query = Favorite::with('favorable')
            ->where('user_id', $user->id)
            ->latest();

        // Filtrar por tipo si se especifica
        if ($type !== 'all') {
            $modelMap = [
                'articles' => 'App\\Modules\\Article\\Models\\Article',
                'interviews' => 'App\\Models\\Interview',
                'news' => 'App\\Models\\News',
            ];
            
            if (isset($modelMap[$type])) {
                $query->where('favorable_type', $modelMap[$type]);
            }
        }

        $favorites = $query->paginate(12);

        return view('user.favorites', [
            'favorites' => $favorites,
            'activeType' => $type,
        ]);
    }

    /**
     * Toggle favorito (agregar/quitar) vía AJAX
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'favorable_type' => 'required|string',
            'favorable_id' => 'required|integer',
        ]);

        $user = Auth::user();
        $favorableType = $request->favorable_type;
        $favorableId = $request->favorable_id;

        // Verificar si ya existe
        $favorite = Favorite::where('user_id', $user->id)
            ->where('favorable_type', $favorableType)
            ->where('favorable_id', $favorableId)
            ->first();

        if ($favorite) {
            // Remover favorito
            $favorite->delete();
            
            return response()->json([
                'success' => true,
                'action' => 'removed',
                'message' => __('Removed from favorites'),
            ]);
        } else {
            // Agregar favorito
            Favorite::create([
                'user_id' => $user->id,
                'favorable_type' => $favorableType,
                'favorable_id' => $favorableId,
            ]);
            
            return response()->json([
                'success' => true,
                'action' => 'added',
                'message' => __('Added to favorites'),
            ]);
        }
    }

    /**
     * Eliminar favorito específico
     */
    public function destroy($locale, $id)
{
    $favorite = \App\Models\Favorite::findOrFail($id);
    
    // Verificar que el favorito pertenezca al usuario
    if ($favorite->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $favorite->delete();

    return redirect()
        ->route('favorites.index', ['locale' => app()->getLocale()])
        ->with('success', __('Removed from favorites'));
}

    /**
     * Limpiar todos los favoritos
     */
    public function clear()
    {
        $user = Auth::user();
        
        Favorite::where('user_id', $user->id)->delete();

        return redirect()
            ->route('favorites.index', ['locale' => app()->getLocale()])
            ->with('success', __('All favorites cleared'));
    }
}