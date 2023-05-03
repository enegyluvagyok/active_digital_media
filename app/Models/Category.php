<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'active', 'parameters'];

    public $timestamps = false;

    public function articles()
    {
        return $this->hasMany(ArticleToCategory::class)
                    ->whereNotNull('article_id')
                    ->with('category')
                    ->orderBy('_lft', 'asc');
    }

    public function categories()
    {
        return $this->hasMany(ArticleToCategory::class)
                    ->whereNull('article_id')
                    ->with('article')
                    ->orderBy('_lft');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($category) {
            $category->update(['slug' => $category->title]);
        });
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value, '-');
        $slug = "{$slug}-{$this->id}";
        $this->attributes['slug'] = $slug;
    }

}
