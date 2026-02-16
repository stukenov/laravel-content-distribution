<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Projects extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'author',
        'time',
        'category_id',
        'slider_image',
        'content',
        'image',
        'trailers',
        'episodes',
        'slider',
        'year',
        'country',
        'genre',
        'quality',
        'director',
        'cast',
        'episodes_count',
        'subtitles',
        'subtitles_lang',
        'mande',
        'mande_lang',
        'update_cause',
    ];

    protected $casts = [
        'trailers' => 'array',
        'episodes' => 'array',
        'episodes_count' => 'integer',
        'subtitles' => 'boolean',
        'mande' => 'boolean',
        'slider' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($project) {
            if (! $project->slug) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tag', 'project_id', 'tag_id');
    }
}
