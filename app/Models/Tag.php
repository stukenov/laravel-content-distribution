<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $table = 'tags';
    
    protected $fillable = [
        'name',
        'slug'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($tag) {
            if (! $tag->slug) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }
    
    public function projects()
    {
        return $this->belongsToMany(Projects::class, 'project_tag', 'tag_id', 'project_id');
    }
}
