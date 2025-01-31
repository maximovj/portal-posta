<?php

use App\Http\Controllers\RatingController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'articles' => Article::isPublished()->latest('updated_at')->paginate(2),
    ]);
});

Route::get('/article/{article}', function (Article $article) {
    return view('article', [
        'article' => $article,
    ]);
})->name('portal.posta.article');


$authEnabled = moonshineConfig()->isAuthEnabled();
$authMiddleware = moonshineConfig()->getAuthMiddleware();

if ($authEnabled) {
    Route::post('/articles/{article}/rate', [RatingController::class, 'rate'])
        ->middleware($authMiddleware)
        ->name('api.portal.porta.articles.rate.store');
}
