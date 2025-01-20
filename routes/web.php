<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/article', function () {
    return view('article', [
        'article' => Article::find(3),
        'articles' => Article::with('moonshine_user')->paginate(1),  
    ]);
});
