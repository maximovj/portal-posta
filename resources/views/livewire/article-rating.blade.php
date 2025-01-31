<div class="mt-3">
    <p class="h5">Puntaje: {{ number_format($averageRating, 1) }} ⭐ ({{ $totalVotes }} votos)</p>

    @auth
        @if (in_array(moonshine_role_name(), ['Blogger', 'Guest']))
            <!-- Estrellas de calificación (se ocultan cuando se envía el voto) -->
            <div class="d-flex gap-2" wire:target="rate" wire:loading.class="d-none">
                @for ($i = 1; $i <= 5; $i++)
                    <button wire:click="rate({{ $i }})"
                        class="btn btn-outline-warning btn-sm {{ $userRating >= $i ? 'text-warning' : 'text-secondary' }}">
                        <i class="bi bi-star-fill"></i>
                    </button>
                @endfor
            </div>

            <!-- Spinner de carga (se muestra mientras se envía el voto) -->
            <div wire:loading wire:target="rate" class="mt-2 text-warning">
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div> Enviando tu calificación...
            </div>
        @else
            <p class="text-danger mt-2">No tienes permisos para calificar este artículo.</p>
        @endif
    @else
        <p class="mt-2"><a href="{{ route('login') }}" class="text-primary">Inicia sesión</a> para calificar.</p>
    @endauth
</div>
