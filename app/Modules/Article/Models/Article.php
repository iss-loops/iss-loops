<?php

namespace App\Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Translatable\HasTranslations;
use App\Modules\Shared\Traits\HasFavorites;
use App\Modules\Category\Models\Category;
use App\Modules\Tag\Models\Tag;
use App\Models\User;

class Article extends Model
{
    use HasFactory, SoftDeletes, HasTranslations, LogsActivity, HasFavorites; // ⬅️ HasFavorites ya debería estar aquí

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'status',
        'reading_time',
        'is_featured',
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
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
    ];

    public $translatable = ['title', 'excerpt', 'body'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'body', 'excerpt', 'status', 'featured_image'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // RELACIONES
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'article_user')->withPivot('role');
    }

    public function authors()
    {
        return $this->users();
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

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeRecent($query, $limit = 10)
    {
        return $query->published()
            ->orderBy('published_at', 'desc')
            ->limit($limit);
    }

    // HELPERS
    public function getTranslatedTitle(?string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->getTranslation('title', $locale);
    }

    public function getTranslatedExcerpt(?string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->getTranslation('excerpt', $locale);
    }

    public function getTranslatedBody(?string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->getTranslation('body', $locale);
    }

    // MUTATORS
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (!$article->created_by) {
                $article->created_by = auth()->id();
            }
        });

        static::updating(function ($article) {
            $article->updated_by = auth()->id();
        });
    }
}