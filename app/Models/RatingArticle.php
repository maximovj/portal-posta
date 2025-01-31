<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\MoonshineUser;

class RatingArticle extends Model
{
    use HasFactory, Notifiable;

    protected $guard = ['id'];
    
    protected  $fillable = [
        'moonshine_user_id',
        'article_id',
        'rating',
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
    
}
