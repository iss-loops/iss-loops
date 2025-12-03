<?php

namespace App\Modules\Tag\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use App\Modules\Article\Models\Article;

class Tag extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    // ========================================
    // TRADUCCIONES
    // ========================================
    
    public $translatable = ['name'];

    // ========================================
    // RELACIONES
    // ========================================

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag');
    }

    // ========================================
    // SCOPES
    // ========================================

    public function scopePopular($query, $limit = 20)
    {
        return $query->withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->limit($limit);
    }
}