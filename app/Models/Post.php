<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MoonshineUser;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $table = 'posts';

    protected $casts = [
        'network_social' => 'array',
    ];

    protected $fillable = [
        'moonshine_user_id',
        'cover',
        'slug',
        'title',
        'subtitle',
        'author',
        'published',
        'tags',
        'network_social',
        'summary',
        'header',
        'content',
        'footer',
        'published',
        'date_published',
    ];

    public function user()
    {
        return $this->belongsTo(MoonshineUser::class, "moonshine_user_id", "id");
    }

}

