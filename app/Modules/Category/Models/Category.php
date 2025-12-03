<?php

namespace App\Modules\Category\Models;

use App\Modules\Article\Models\Article;
use App\Modules\Interview\Models\Interview;
use App\Modules\News\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'color',
        'icon',
        'sort_order',
        'is_active',
    ];

    public $translatable = [
        'name',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Relación con categoría padre
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Relación con subcategorías
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    /**
     * Relación con artículos
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_category')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');
    }

    /**
     * Relación con entrevistas
     */
    public function interviews(): BelongsToMany
    {
        return $this->belongsToMany(Interview::class, 'interview_category')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');
    }

    /**
     * Relación con noticias
     */
    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'news_category')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');
    }

    /**
     * Scope para solo categorías activas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para solo categorías padre
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope para buscar por slug
     */
    public function scopeBySlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * Obtener todas las categorías (incluyendo hijas) recursivamente
     */
    public function getAllDescendants(): \Illuminate\Support\Collection
    {
        $descendants = collect([$this]);
        
        foreach ($this->children as $child) {
            $descendants = $descendants->merge($child->getAllDescendants());
        }
        
        return $descendants;
    }

    /**
     * Obtener el path completo de la categoría
     * Ejemplo: "Ciencias > Física > Mecánica Cuántica"
     */
    public function getFullPath(string $locale = null, string $separator = ' > '): string
    {
        $locale = $locale ?? app()->getLocale();
        $path = [];
        $current = $this;
        
        while ($current) {
            array_unshift($path, $current->getTranslation('name', $locale));
            $current = $current->parent;
        }
        
        return implode($separator, $path);
    }

    /**
     * Verificar si es categoría padre
     */
    public function isParent(): bool
    {
        return is_null($this->parent_id);
    }

    /**
     * Verificar si tiene hijos
     */
    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }

    /**
     * Contar todos los artículos (incluyendo subcategorías)
     */
    public function getTotalArticlesCount(): int
    {
        $count = $this->articles()->count();
        
        foreach ($this->children as $child) {
            $count += $child->getTotalArticlesCount();
        }
        
        return $count;
    }

    /**
     * Obtener URL amigable
     */
    public function getUrlAttribute(): string
    {
        return route('categories.show', $this->slug);
    }

    /**
     * Obtener nombre traducido (helper)
     */
    public function getLocalizedName(): string
    {
        return $this->getTranslation('name', app()->getLocale());
    }

    /**
     * Boot method para eventos del modelo
     */
    protected static function boot()
    {
        parent::boot();

        // Al eliminar una categoría, reasignar las subcategorías al padre
        static::deleting(function ($category) {
            if ($category->hasChildren()) {
                $category->children()->update([
                    'parent_id' => $category->parent_id
                ]);
            }
        });

        // Ordenamiento automático al crear
        static::creating(function ($category) {
            if (is_null($category->sort_order)) {
                $category->sort_order = static::where('parent_id', $category->parent_id)
                    ->max('sort_order') + 1;
            }
        });
    }
}
