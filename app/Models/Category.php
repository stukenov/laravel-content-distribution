<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            if (! $category->slug) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function projects()
    {
        return $this->hasMany(Projects::class);
    }
}
