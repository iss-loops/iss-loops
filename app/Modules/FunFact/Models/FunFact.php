<?php

namespace App\Modules\FunFact\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Modules\Category\Models\Category;

class FunFact extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'content',
        'image',
        'category_id',
        'is_active',
        'sort_order',
    ];

    public $translatable = ['title', 'content'];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Relación con categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope para activos
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope para ordenados
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    // Obtener facts aleatorios
    public static function getRandom($count = 6)
    {
        return self::active()->inRandomOrder()->limit($count)->get();
    }
}