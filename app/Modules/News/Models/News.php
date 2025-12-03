<?php

namespace App\Modules\News\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Category\Models\Category;
use App\Modules\Tag\Models\Tag;
use App\Models\User;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'source_name',
        'source_url',
        'status',
        'is_featured',
        'is_breaking',
        'published_at',
        'scheduled_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'title' => 'array',
        'excerpt' => 'array',
        'body' => 'array',
        'is_featured' => 'boolean',
        'is_breaking' => 'boolean',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
    ];

    // RELACIONES
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'news_category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tag');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // SCOPES
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeBreaking($query)
    {
        return $query->where('is_breaking', true);
    }

    // HELPERS
    public function getTranslatedTitle(?string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->title[$locale] ?? $this->title['es'] ?? '';
    }
}