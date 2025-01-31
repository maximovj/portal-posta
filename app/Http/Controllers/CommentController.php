<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $article->comments()->create([
            'moonshine_user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Comentario agregado.');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->moonshine_user_id) {
            abort(403, 'No autorizado');
        }

        $comment->delete();
        return back()->with('success', 'Comentario eliminado.');
    }
}
