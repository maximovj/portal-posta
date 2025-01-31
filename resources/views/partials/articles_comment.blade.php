<div class="list-group-item">
    {{-- Mostrar respuesta --}}
    <div class="d-flex justify-content-between">
        <strong>{{ $comment->moonshine_user->name }}</strong>
        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
    </div>
    <p>{{ $comment->content }}</p>

    @auth
        <button class="btn btn-link text-primary" wire:click="reply({{ $comment->id }})">
            <i class="bi bi-reply"></i> Responder
        </button>
    @endauth

    {{-- Formulario para responder --}}
    @if ($parentCommentId === $comment->id)
        <div class="mt-2">
            <textarea class="form-control" wire:model="newComment" placeholder="Escribe una respuesta..."></textarea>
            <button class="btn btn-success mt-2" wire:click="addComment">
                <i class="bi bi-send"></i> Responder
            </button>
        </div>
    @endif

    {{-- Mostrar respuestas de manera recursiva si existen --}}
    @if ($comment->replies->count() > 0)
        <div class="ms-4 mt-2">
            @foreach ($comment->replies as $reply)
                @include('partials.articles_comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>
