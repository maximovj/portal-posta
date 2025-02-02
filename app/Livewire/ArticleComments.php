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
        $this->loadComments();
    }

    public function loadComments()
    {
        // Contar los comentarios disponibles
        $comments = $this->article->comments()->whereNull('parent_id'); // Solo comentarios principales
        $this->totalComments = $comments->count(); 

        // Cargar los comentarios según el número de comentarios solicitados
        $this->comments = $comments
            ->with(['replies' => function ($query) {
                $query->isPublished()->whereNotNull('parent_id'); // Solo respuestas publicadas
            }])
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
            'title' => $this->parentCommentId ? ('Este es una respuesta para @' . $this->article->moonshine_user->name): 'Abro un nuevo hilo',
            'tags' => $this->parentCommentId ? 'respuesta'.(',de,'.moonshine_user()->name).(',para,'.$this->article->moonshine_user->name): 'nuevo,hilo',
            'is_publish' => true,
        ]);

        $this->reset('newComment', 'parentCommentId');
        $this->loadComments(); // Recargar los comentarios después de agregar uno nuevo
    }

    public function deleteComment($commentId)
    {
        // Encuentra el comentario a eliminar
        $comment = Comment::find($commentId);

        // Verifica si el comentario existe y si el usuario tiene permiso para eliminarlo
        if ($comment && $comment->moonshine_user_id === Auth::id()) {
            // Elimina el comentario y sus respuestas, si las tiene
            $comment->replies()->delete();  // Eliminar respuestas (comentarios hijos)
            $comment->delete();  // Eliminar el comentario principal
        }

        // Recargar los comentarios después de eliminar uno
        $this->loadComments();
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