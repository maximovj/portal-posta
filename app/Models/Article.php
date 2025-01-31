<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Laravel\Models\MoonshineUser;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $table = 'articles';

    protected $casts = [
        'network_social' => 'array',
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'moonshine_user_id',
        'cover',
        'author',
        'profession',
        'title',
        'subtitle',
        'slug',
        'summary',
        'header',
        'content',
        'footer',
        'tags',
        'network_social',
        'published_at',
        'is_publish',
    ];

    public function moonshine_user() 
    {
        return $this->belongsTo(MoonshineUser::class, 'moonshine_user_id', 'id');
    }

    public function scopeIsPublished(Builder $query)
    {
        return $query->where('is_publish', true);
    }

    public function ratings()
    {
        return $this->hasMany(RatingArticle::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?? 0; // Si no hay votos, devuelve 0
    }

}
