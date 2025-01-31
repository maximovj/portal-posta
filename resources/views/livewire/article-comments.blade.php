<div>
    <h2 class="mb-4">Comentarios</h2>

    @auth
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
    @endauth

    <div class="list-group" id="comments-list" wire:scroll="loadMoreComments">
        @foreach ($comments as $comment)
            <div class="list-group-item">
                
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

                {{-- Mostrar respuestas anidadas --}}
                @foreach ($comment->replies as $reply)
                    <div class="ms-4 mt-2 border-start ps-3">

                        <div class="d-flex justify-content-between">
                            <strong>{{ $reply->moonshine_user->name }}</strong>
                            <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                        </div>
                        <p>{{ $reply->content }}</p>

                        @auth
                            <button class="btn btn-link text-primary" wire:click="reply({{ $reply->id }})">
                                <i class="bi bi-reply"></i> Responder
                            </button>
                        @endauth

                        {{-- Formulario para responder a respuestas --}}
                        @if ($parentCommentId === $reply->id)
                            <div class="mt-2">
                                <textarea class="form-control" wire:model="newComment" placeholder="Escribe una respuesta..."></textarea>
                                <button class="btn btn-success mt-2" wire:click="addComment">
                                    <i class="bi bi-send"></i> Responder
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    {{-- Si hay más comentarios por cargar --}}
    @if ($commentsCount < $totalComments)
        <div class="text-center mt-3">
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
