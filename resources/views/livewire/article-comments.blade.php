<div>
    <h2 class="mb-4">Comentarios</h2>

    @auth
    @if(!$parentCommentId)
    <div class="mb-3">
        <textarea class="form-control" wire:model="newComment" placeholder="Escribe un comentario..."></textarea>
        <button class="btn btn-primary mt-2" wire:click="addComment" wire:loading.class="d-none">
            <i class="bi bi-send"></i> Enviar
        </button>
        <div wire:loading wire:target="addComment" class="mt-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    </div>
    @else
    <p>
        <button class="btn btn-link text-primary" wire:click="reply(null)">
            <i class="bi bi-patch-plus"></i> Agregar comentario nuevo
        </button>
    </p>
    @endif
    @endauth

    <div class="list-group" id="comments-list" wire:scroll="loadMoreComments">
        @foreach ($comments as $comment)
        <div class="list-group-item">
            {{-- Mostrar comentario --}}
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

            {{-- Mostrar respuestas anidadas de forma recursiva --}}
            @if ($comment->replies->count() > 0)
            <div class="ms-4 mt-2">
                @foreach ($comment->replies as $reply)
                @include('partials.articles_comment', ['comment' => $reply])
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>

    {{-- Si hay más comentarios por cargar --}}
    @if ($commentsCount < $totalComments) <div class="text-center mt-3">
        <button class="btn btn-outline-primary rounded-pill d-flex align-items-center justify-content-center" wire:click="loadMoreComments" wire:loading.attr="disabled">
            <div wire:loading wire:target="loadMoreComments" class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <span wire:loading.remove>Cargar más comentarios</span>
        </button>
</div>
@else
<div class="text-center mt-3">
    <p>No hay más comentarios.</p>
</div>
@endif
</div>
