<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'intro', 'content', 'publish_start', 'publish_end', 'hits', 'view', 'active', 'parameters', 'image'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_to_categories')
            ->using(ArticleToCategory::class)
            ->withPivot('_lft', '_rgt');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($article) {
            $article->update(['slug' => $article->title]);
        });
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value, '-');
        $slug = "{$slug}-{$this->id}";
        $this->attributes['slug'] = $slug;
    }

}
