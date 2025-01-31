<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ArticleComments extends Component
{
    public $article;
    public $newComment = '';
    public $parentCommentId = null;
    public $comments = [];
    public $commentsCount = 5;  // Número de comentarios iniciales que se cargan
    public $totalComments = 0;  // Total de comentarios disponibles

    protected $rules = [
        'newComment' => 'required|string|max:500',
    ];

    public function mount(Article $article)
    {
        $this->article = $article;
        $this->totalComments = $this->article->comments()->whereNull('parent_id')->count();  // Contar los comentarios disponibles
        $this->loadComments();
    }

    public function loadComments()
    {
        // Cargar los comentarios según el número de comentarios solicitados
        $this->comments = $this->article->comments()
            ->whereNull('parent_id')
            ->with('replies')
            ->latest()
            ->take($this->commentsCount)
            ->get();
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
        $this->loadComments(); // Recargar los comentarios después de agregar uno nuevo
    }

    public function reply($commentId)
    {
        $this->parentCommentId = $commentId;
    }

    public function loadMoreComments()
    {
        $this->commentsCount += 5;  // Aumentar la cantidad de comentarios cargados
        $this->loadComments();  // Recargar los comentarios con más resultados

        // Emitir un evento para notificar al frontend que los comentarios fueron cargados
        $this->dispatch('commentsLoaded');
    }

    public function render()
    {
        return view('livewire.article-comments');
    }
}