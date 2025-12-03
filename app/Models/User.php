<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // ⬅️ AGREGAR ESTE IMPORT

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'bio',
        'social_links',
        'preferred_locale', // ⬅️ Asegúrate que esté aquí
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'social_links' => 'array',
        ];
    }

    // ========================================
    // RELACIONES - FAVORITOS
    // ========================================

    /**
     * Relación: favoritos del usuario
     */
    public function favorites(): HasMany // ⬅️ TIPO DE RETORNO CORRECTO
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Obtener artículos favoritos
     */
    public function favoriteArticles()
    {
        return $this->favorites()
            ->where('favorable_type', 'App\\Modules\\Article\\Models\\Article')
            ->with('favorable')
            ->get()
            ->pluck('favorable');
    }

    /**
     * Verificar si tiene un item como favorito
     */
    public function hasFavorite($favorableType, $favorableId): bool
    {
        return $this->favorites()
            ->where('favorable_type', $favorableType)
            ->where('favorable_id', $favorableId)
            ->exists();
    }

    /**
     * Agregar a favoritos
     */
    public function addFavorite($favorable): Favorite
    {
        return $this->favorites()->create([
            'favorable_type' => get_class($favorable),
            'favorable_id' => $favorable->id,
        ]);
    }

    /**
     * Remover de favoritos
     */
    public function removeFavorite($favorable): bool
    {
        return $this->favorites()
            ->where('favorable_type', get_class($favorable))
            ->where('favorable_id', $favorable->id)
            ->delete() > 0;
    }

    /**
     * Toggle favorito (agregar/quitar)
     */
    public function toggleFavorite($favorable): bool
    {
        if ($this->hasFavorite(get_class($favorable), $favorable->id)) {
            $this->removeFavorite($favorable);
            return false; // Removido
        } else {
            $this->addFavorite($favorable);
            return true; // Agregado
        }
    }
   
    /**
 * Suscripción al newsletter del usuario
 */
public function subscriber()
{
    return $this->hasOne(\App\Modules\Subscription\Models\Subscriber::class);
}

/**
 * Verificar si está suscrito al newsletter
 */
public function isSubscribed(): bool
{
    return $this->subscriber && $this->subscriber->is_active;
}
}