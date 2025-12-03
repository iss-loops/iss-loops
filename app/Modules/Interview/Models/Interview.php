<?php

namespace App\Modules\Interview\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Interview extends Model
{
    use SoftDeletes, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'video_url',
        'video_provider',
        'thumbnail',
        'interviewee_name',
        'interviewee_title',
        'interviewee_photo',
        'duration',
        'status',
        'is_featured',
        'published_at',
        'scheduled_at',
        'created_by',
        'updated_by',
    ];

    public $translatable = ['title', 'description'];

    protected $casts = [
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    // ==========================================
    // RELACIONES
    // ==========================================

    public function categories()
    {
        return $this->belongsToMany(
            \App\Modules\Category\Models\Category::class,
            'interview_category'
        );
    }

    public function tags()
    {
        return $this->belongsToMany(
            \App\Modules\Tag\Models\Tag::class,
            'interview_tag'
        );
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    // ==========================================
    // SCOPES
    // ==========================================

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

    // ==========================================
    // HELPERS
    // ==========================================

    /**
     * Obtener URL embebida del video
     */
    public function getEmbedUrl()
    {
        if ($this->video_provider === 'youtube') {
            // Extraer ID de YouTube
            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\?]+)/', $this->video_url, $matches);
            $videoId = $matches[1] ?? null;
            return $videoId ? "https://www.youtube.com/embed/{$videoId}" : null;
        }

        if ($this->video_provider === 'vimeo') {
            preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches);
            $videoId = $matches[1] ?? null;
            return $videoId ? "https://player.vimeo.com/video/{$videoId}" : null;
        }

        return $this->video_url;
    }

    /**
     * Formatear duración (segundos a minutos)
     */
    public function getFormattedDuration()
    {
        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;
        return sprintf('%d:%02d', $minutes, $seconds);
    }
}