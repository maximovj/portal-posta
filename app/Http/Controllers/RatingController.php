<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\RatingArticle;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rate(Request $request, Article $article)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return response()->json(['message' => 'Debe iniciar sesión para calificar.'], 403);
        }

        $user = Auth::user();

        // Verificar si el usuario tiene un rol permitido para votar
        if (!in_array(moonshine_role_name(), ['Blogger', 'Guest'])) {
            return response()->json(['message' => 'No tiene permisos para calificar.'], 403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Buscar si el usuario ya votó antes
        $existingRating = RatingArticle::where('moonshine_user_id', $user->id)
            ->where('article_id', $article->id)
            ->first();

        if ($existingRating) {
            // Si ya votó, actualizar el puntaje
            $existingRating->update(['rating' => $request->rating]);
        } else {
            // Si no ha votado, registrar nuevo voto
            RatingArticle::create([
                'moonshine_user_id' => $user->id,
                'article_id' => $article->id,
                'rating' => $request->rating,
            ]);
        }

        return response()->json([
            'message' => 'Calificación guardada exitosamente.',
            'average_rating' => $article->averageRating(),
            'rating_count' => $article->ratings()->count(),
        ]);
    }
}