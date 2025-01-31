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
    @if ($comment->moonshine_user_id === Auth::id())
    <button class="btn btn-link text-danger" wire:click="deleteComment({{ $comment->id }})">
        <i class="bi bi-trash"></i> Eliminar
    </button>
    @endif
    @endauth

    {{-- Formulario para responder --}}
    @if ($parentCommentId === $comment->id)
    <div class="mt-2">
        <textarea class="form-control" wire:model="newComment" placeholder="Escribe una respuesta..."></textarea>

        <!-- Botón para responder con el ícono de enviar -->
        <button class="btn btn-success mt-2" wire:click="addComment" wire:loading.attr="disabled" wire:loading.class="d-none">
            <!-- Icono de enviar usando Bootstrap Icons -->
            <i class="bi bi-send"></i>
            Responder
        </button>

        <!-- Spinner de carga (Bootstrap 5) -->
        <div class="spinner-border text-primary mt-2" role="status" wire:loading wire:target="addComment">
            <span class="visually-hidden">Cargando...</span>
        </div>
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
