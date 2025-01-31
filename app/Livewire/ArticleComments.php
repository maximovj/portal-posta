<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ArticleComments extends Component
{
    use WithPagination;

    public $article;
    public $newComment = '';
    public $parentCommentId = null;
    protected $paginationTheme = 'bootstrap'; // Usa el paginador de Bootstrap

    protected $rules = [
        'newComment' => 'required|string|max:500',
    ];

    public function mount(Article $article)
    {
        $this->article = $article;
    }

    public function addComment()
    {
        $this->validate();

        Comment::create([
            'article_id' => $this->article->id,
            'moonshine_user_id' => Auth::id(),
            'content' => $this->newComment,
            'parent_id' => $this->parentCommentId,
        ]);

        $this->reset('newComment', 'parentCommentId');
        $this->resetPage(); // Reinicia la paginación para que el nuevo comentario aparezca en la primera página
    }

    public function reply($commentId)
    {
        $this->parentCommentId = $commentId;
    }

    public function render()
    {
        $comments = $this->article->comments()
            ->whereNull('parent_id')
            ->with('replies')
            ->latest()
            ->paginate(5);

        return view('livewire.article-comments', compact('comments'));
    }
}