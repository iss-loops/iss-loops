<?php

namespace App\Modules\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'frequency',
        'category_preferences',
        'is_active',
        'subscribed_at',
        'unsubscribed_at',
    ];

    protected $casts = [
        'category_preferences' => 'array',
        'is_active' => 'boolean',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    // RELACIONES
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // SCOPES
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeDaily($query)
    {
        return $query->where('frequency', 'daily');
    }

    public function scopeWeekly($query)
    {
        return $query->where('frequency', 'weekly');
    }
    /**
     * Suscriptores mensuales
     */
    public function scopeMonthly($query)
    {
        return $query->where('frequency', 'monthly');
    }

    /**
     * Suscriptores por frecuencia (método genérico)
     */
    public function scopeByFrequency($query, $frequency)
    {
        return $query->where('frequency', $frequency);
    }

    /**
     * Suscriptores con categorías específicas
     */
    public function scopeWithCategoryPreference($query, $categoryId)
    {
        return $query->whereJsonContains('category_preferences', $categoryId);
    }

    // ==========================================
    // MÉTODOS HELPER
    // ==========================================

    /**
     * Verificar si está suscrito a una categoría
     */
    public function isSubscribedToCategory($categoryId): bool
    {
        if (!$this->category_preferences) {
            return false;
        }

        return in_array($categoryId, $this->category_preferences);
    }

    /**
     * Activar suscripción
     */
    public function activate(): void
    {
        $this->update([
            'is_active' => true,
            'subscribed_at' => now(),
            'unsubscribed_at' => null,
        ]);
    }

    /**
     * Desactivar suscripción
     */
    public function deactivate(): void
    {
        $this->update([
            'is_active' => false,
            'unsubscribed_at' => now(),
        ]);
    }
}