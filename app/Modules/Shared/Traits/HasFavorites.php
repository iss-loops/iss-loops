<?php

namespace App\Modules\Shared\Traits;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasFavorites
{
    /**
     * Relación: Este modelo puede tener muchos favoritos
     */
    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }

    /**
     * Verificar si el usuario actual marcó esto como favorito
     */
    public function isFavoritedBy($userId): bool
    {
        if (!$userId) {
            return false;
        }

        return $this->favorites()
            ->where('user_id', $userId)
            ->exists();
    }

    /**
     * Obtener el ID del favorito si existe
     */
    public function getFavoriteIdFor($userId): ?int
    {
        if (!$userId) {
            return null;
        }

        $favorite = $this->favorites()
            ->where('user_id', $userId)
            ->first();

        return $favorite?->id;
    }

    /**
     * Contar total de favoritos
     */
    public function favoritesCount(): int
    {
        return $this->favorites()->count();
    }

    /**
     * Scope para obtener solo items favoritos de un usuario
     */
    public function scopeFavoritedBy($query, $userId)
    {
        return $query->whereHas('favorites', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    /**
     * Scope para ordenar por cantidad de favoritos
     */
    public function scopePopular($query)
    {
        return $query->withCount('favorites')
            ->orderBy('favorites_count', 'desc');
    }
}