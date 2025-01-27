<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/article', function () {
    return view('article', [
        'article' => Article::findOrFail('git-workflow'),
    ]);
});