<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\RatingArticle;
use Illuminate\Support\Facades\Auth;

class ArticleRating extends Component
{

    public $article;
    public $averageRating;
    public $totalVotes;
    public $userRating;

    public function mount(Article $article)
    {
        $this->article = $article;
        $this->loadRatings();
    }

    public function loadRatings()
    {
        $this->averageRating = $this->article->ratings()->avg('rating') ?? 0;
        $this->totalVotes = $this->article->ratings()->count();

        if (Auth::check()) {
            $this->userRating = RatingArticle::where('moonshine_user_id', Auth::id())
                ->where('article_id', $this->article->id)
                ->value('rating');
        } else {
            $this->userRating = null;
        }
    }

    public function rate($rating)
    {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();
        if (!$user->canVote()) {
            return;
        }

        RatingArticle::updateOrCreate(
            ['moonshine_user_id' => $user->id, 'article_id' => $this->article->id],
            ['rating' => $rating]
        );

        // Recargar la información
        $this->loadRatings();
    }

    public function render()
    {
        return view('livewire.article-rating');
    }

}
