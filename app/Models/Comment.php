<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, Notifiable;

    protected $guard = ['id'];
    
    protected  $fillable = [
        'moonshine_user_id',
        'article_id',
        'parent_id',
        'title',
        'tags',
        'content',
        'is_publish',
    ];

    // ?? RELATIONS

    public function moonshine_user() 
    {
        return $this->belongsTo(MoonshineUser::class, 'moonshine_user_id' , 'id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    // Relación con respuestas (hijos)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('is_publish', true)->with('replies');
    }

    // Relación con comentario padre
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function scopeIsPublished(Builder $query)
    {
        return $query->where('is_publish', true);
    }

}
