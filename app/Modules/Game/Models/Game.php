<?php

namespace App\Modules\Game\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Game extends Model
{
    use SoftDeletes, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'instructions',
        'type',
        'difficulty',
        'thumbnail',
        'game_file',
        'learning_objectives',
        'estimated_time',
        'is_active',
        'is_featured',
        'play_count',
        'sort_order',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'instructions' => 'array',
        'learning_objectives' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'play_count' => 'integer',
        'estimated_time' => 'integer',
        'sort_order' => 'integer',
    ];

    public $translatable = [
        'title',
        'description',
        'instructions',
        'learning_objectives'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    // Helpers
    public function getDifficultyBadgeColorAttribute()
    {
        return match($this->difficulty) {
            'easy' => 'green',
            'medium' => 'yellow',
            'hard' => 'red',
            default => 'gray',
        };
    }

    public function getTypeBadgeColorAttribute()
    {
        return match($this->type) {
            'physics' => 'blue',
            'math' => 'purple',
            'biology' => 'green',
            'chemistry' => 'orange',
            default => 'gray',
        };
    }

    public function incrementPlayCount()
    {
        $this->increment('play_count');
    }
}