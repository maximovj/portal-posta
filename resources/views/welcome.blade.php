@extends('layout.base')

@section('content_main')
<div id="carouselArticles" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($articles as $index => $article)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            <div class="card shadow-sm">
                @if($article->cover) 
                <img src="{{ asset("storage/$article->cover ") }}" class="card-img-top" alt="Imagen del artículo" style="height: 360px; object-fit: cover;">
                @else
                <img src="{{ asset("storage/posts/er4MgUJVMWPiSmpslmoJ8BegWaCO7emq5HCGXG0p.jpg") }}" class="card-img-top" alt="Imagen del artículo" style="height: 360px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h1 class="fs-3 fw-bold">{!! $article->title ?? '' !!}</h1>
                    <h2 class="fs-6 text-muted">{!! $article->subtitle ?? '' !!}</h2>
                    <p class="fs-6 text-secondary">{!! $article->author ?? '' !!}</p>
                    <p class="fs-6 text-muted">Publicado en: {{ $article->published_at->format('d/m/Y') }}</p>
                    <div class="d-flex flex-wrap">
                        @foreach (explode(',', $article->tags) as $tag)
                            <span class="badge bg-secondary me-1"><i class="bi bi-tag"></i>&nbsp;{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <a role="button" href="{{ route('portal.posta.article', ['article' => $article]) }}" class="btn btn-outline-success rounded-pill" data-bs-slide-to="false">
                        Seguir leyendo <i class="bi bi-arrow-right-circle ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselArticles" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselArticles" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

@foreach ($articles as $article)
<div class="card shadow-sm border-0 mb-4" style="border-radius: 10px;">
    
    @if($article->cover) 
    <img loading="lazy" src="{{ asset("storage/$article->cover ") }}" class="card-img-top" alt="Imagen del artículo" style="height: 420px; object-fit: cover; opacity: 1;">
    @else
    <img loading="lazy" src="{{ asset("storage/posts/er4MgUJVMWPiSmpslmoJ8BegWaCO7emq5HCGXG0p.jpg") }}" class="card-img-top" alt="Imagen del artículo" style="height: 420px; object-fit: cover; opacity: 1;">
    @endif

    <div class="card-body">
        <h1 class="fs-4 fw-bold text-dark">{!! $article->title ?? '' !!}</h1>
        <h2 class="fs-6 text-muted">{!! $article->subtitle ?? '' !!}</h2>
        <p class="fs-6 text-muted">{!! $article->author ?? '' !!} | {{ $article->published_at->format('d/m/Y') }}</p>

        <div class="d-flex flex-wrap">
            @foreach (explode(',', $article->tags) as $tag)
                <span class="badge bg-secondary me-2 mb-2">{{ $tag }}</span>
            @endforeach
        </div>

        <!-- Desplegar contenido con animación fade-in -->
        <div class="collapse mt-3 show" id="articleHeader{{ $article->id }}">
            <div class="card-body bg-light rounded-3">
                {!! $article->header !!}
            </div>
        </div>
        
        <button class="btn btn-link text-primary mt-3 text-decoration-none" type="button" data-btn-toggle="item-article-header" data-bs-toggle="collapse" data-bs-target="#articleHeader{{ $article->id }}" aria-expanded="false" aria-controls="articleHeader{{ $article->id }}">
            <span id="article-text-header-span">Ocultar introducción</span> <i class="bi bi-chevron-up ms-2"></i>
        </button>
    </div>
    
    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end bg-transparent">
        <a href="{{ route('portal.posta.article', ['article' => $article]) }}" class="btn btn-outline-dark rounded-pill ">
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