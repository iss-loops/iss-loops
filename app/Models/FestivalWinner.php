<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FestivalWinner extends Model
{
    use HasTranslations;

    protected $fillable = [
        'student_name',
        'photo',
        'school',
        'state',
        'project_title',
        'project_description',
        'category',
        'year',
        'award_level',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    public $translatable = [
        'student_name',
        'project_title',
        'project_description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'year' => 'integer',
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

    public function scopeYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Accessors
    public function getCategoryNameAttribute()
    {
        $categories = [
            'physics' => __('Physics'),
            'biology' => __('Biology'),
            'technology' => __('Technology'),
            'chemistry' => __('Chemistry'),
            'mathematics' => __('Mathematics'),
        ];

        return $categories[$this->category] ?? $this->category;
    }

    public function getAwardLevelNameAttribute()
    {
        $levels = [
            'first_place' => __('First Place'),
            'second_place' => __('Second Place'),
            'third_place' => __('Third Place'),
            'honorable_mention' => __('Honorable Mention'),
        ];

        return $levels[$this->award_level] ?? $this->award_level;
    }

    public function getAwardColorAttribute()
    {
        return match($this->award_level) {
            'first_place' => 'yellow',
            'second_place' => 'gray',
            'third_place' => 'orange',
            'honorable_mention' => 'blue',
            default => 'gray',
        };
    }
}