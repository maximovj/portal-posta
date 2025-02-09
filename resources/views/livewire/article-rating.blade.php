<div class="mt-3">
    <p class="h5">Puntaje: {{ number_format($averageRating, 1) }} ⭐ ({{ $totalVotes }} votos)</p>

    @auth
        @if (Auth::user()->canVote())
            <div class="d-flex gap-2" wire:target="rate" wire:loading.class="d-none">
                @for ($i = 1; $i <= 5; $i++)
                    <button wire:click="rate({{ $i }})"
                        class="btn btn-outline-warning btn-sm {{ $userRating >= $i ? 'text-warning' : 'text-secondary' }}">
                        <i class="bi bi-star-fill"></i>
                    </button>
                @endfor
                
                <!-- Botón para eliminar voto -->
                @if ($userRating)
                <button wire:click="removeVote" class="btn btn-danger btn-sm">
                    <i class="bi bi-x-circle"></i> 
                </button>
                @endif
            </div>

             <!-- Mostrar mensaje "Deja tu voto" -->
             @if (!$userRating)
                <p class="mt-2 text-secondary" wire:loading.class="d-none">Deja tu voto para este artículo.</p>
            @endif

            <!-- Spinner de carga -->
            <div wire:loading wire:target="rate" class="mt-2 text-warning">
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div> Enviando tu calificación...
            </div>
        @else
            <p class="text-danger mt-2">No tienes permisos para calificar este artículo.</p>
        @endif
    @else
        <p class="mt-2">
            <span class="bg-light rounded fs-6 p-1">
                <a href="{{ route('moonshine.login') }}" target="_blank" rel="alternate" referrerpolicy="origin" class="d-inline-block text-primary text-decoration-none">Inicia sesión</a>    
            </span> 
            <span>
                para calificar artículo.
            </span>
        </p>
    @endauth
</div>
