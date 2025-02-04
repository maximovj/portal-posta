<?php

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome', [
        'articles' => Article::isPublished()->latest('updated_at')->paginate(2),
    ]);
});

Route::get('/article/{article}', function (Article $article) {
    return view('article', [
        'article' => $article,
        'comments' => $article->comments()->whereNull('parent_id')->with('replies')->latest()->paginate(2),
    ]);
})->name('portal.posta.article');

Route::get('/search', function (Request $request) {
    $query_slug = Str::slug($request->get('q'));
    $type = $request->get('type');
    return view('search', [
        'articles' => Article::selectDetails()->isPublished()->likeSlug($query_slug)->latest('updated_at')->paginate(15),
    ]);
});

$authEnabled = moonshineConfig()->isAuthEnabled();
$authMiddleware = moonshineConfig()->getAuthMiddleware();

if ($authEnabled) {
    Route::post('/articles/{article}/rate', 
        [RatingController::class, 'rate'])
        ->middleware($authMiddleware)
        ->name('api.portal.porta.articles.rate.store');

    Route::post('/articles/{article}/comments', 
        [CommentController::class, 'store'])
        ->name('api.portal.porta.comments.store');

    Route::delete('/comments/{comment}', 
        [CommentController::class, 'destroy'])
        ->name('api.portal.porta.comments.destroy');
}
