@extends('layout.base')


@if(count($articles) > 0)

@section('content_main')

@foreach ($articles as $article)
<div class="card mb-4 shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
    <div class="card-img-top" style="background-image: url('{{ asset(($article->cover ? "storage/$article->cover" : 'storage/articles/default_cover.jpg')) }}'); height: 250px; background-size: cover; background-position: center; transform: translateZ(0);">
        <div class="overlay" style="background-color: rgba(0, 0, 0, 0.5); height: 100%; width: 100%;"></div>
    </div>
    <div class="card-body position-relative">
        <h1 class="fs-4 fw-bold text-dark">{!! $article->title ?? '' !!}</h1>
        <h2 class="fs-6 text-muted">{!! $article->subtitle ?? '' !!}</h2>
        <p class="fs-6 text-muted mb-3">{!! $article->author ?? '' !!} | {{ $article->published_at->format('d/m/Y') }}</p>
        
        <div class="d-flex flex-wrap">
            @foreach (explode(',', $article->tags) as $tag)
                <span class="badge bg-secondary me-2 mb-2"><i class="bi bi-tag"></i>&nbsp;{{ $tag }}</span>
            @endforeach
        </div>

        <!-- Botón para mostrar el contenido -->
        <button class="btn btn-link text-primary p-0 mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#headerCollapse{{ $article->id }}" aria-expanded="false" aria-controls="headerCollapse{{ $article->id }}">
            Leer descripción <i class="bi bi-chevron-down ms-2"></i>
        </button>

        <div class="collapse mt-3 show" id="headerCollapse{{ $article->id }}">
            <div class="card-body bg-light rounded-3">
                {!! $article->summary !!}
            </div>
        </div>
    </div>
    <div class="card-footer text-center bg-white">
        <a href="{{ route('portal.posta.article', ['article' => $article]) }}" class="btn btn-outline-success rounded-pill w-100">
            Seguir leyendo <i class="bi bi-arrow-right-circle ms-2"></i>
        </a>
    </div>
</div>
@endforeach

    {{ $articles->links('pagination::bootstrap-5') }}
    @endsection

    @push('custom_script')
    <script>
        document.querySelectorAll('button[data-btn-toggle="item-article-header"').forEach(button => {
            button.addEventListener('click', () => {
                const isExpanded = button.getAttribute('aria-expanded') === 'true';
                const span = button.querySelector('#article-text-header-span');
                const icon = button.querySelector('i');

                // Cambiar texto e ícono según el estado
                if (isExpanded) {
                    span.textContent = 'Ocultar introducción';
                    icon.className = 'bi bi-chevron-up ms-2';
                } else {
                    span.textContent = 'Mostrar introducción';
                    icon.className = 'bi bi-chevron-down ms-2';
                }
            });
        });
    </script>
    @endpush

@else 

    @section('content_main')
    <div class="alert alert-warning text-center" role="alert">
        <p class="fw-bold m-0 p-0 b-0">Artículos no disponibles</p>
        <p class="m-0 p-0 b-0">Aún no hay artículos disponibles para leer</p>
    </div>
    @endsection

@endif
