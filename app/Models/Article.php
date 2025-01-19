<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Laravel\Models\MoonshineUser;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $table = 'articles';

    protected $casts = [
        'network_social' => 'array'
    ];

    protected $fillable = [
        'moonshine_user_id',
        'cover',
        'author',
        'profession',
        'title',
        'subtile',
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

}
