<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'favorable_type',
        'favorable_id',
    ];

    /**
     * Relación polimórfica: puede ser Article, Interview, News, etc.
     */
    public function favorable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relación con el usuario dueño del favorito
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para filtrar por usuario
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope para filtrar por tipo de contenido
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('favorable_type', $type);
    }
}