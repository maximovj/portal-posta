<div>
    <h2 class="mb-4">Comentarios</h2>

    @auth
        <div class="mb-3">
            <textarea class="form-control" wire:model="newComment" placeholder="Escribe un comentario..."></textarea>
            <button class="btn btn-primary mt-2" wire:click="addComment">
                <i class="bi bi-send"></i> Enviar
            </button>
        </div>
    @endauth

    <div class="list-group">
        @foreach ($comments as $comment)
            <div class="list-group-item">
                <strong>{{ $comment->moonshine_user->name }}</strong>
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
                        <strong>{{ $reply->moonshine_user->name }}</strong>
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

    {{-- Paginación de Livewire --}}
    <div class="mt-3">
        {{ $comments->links() }}
    </div>
</div>
