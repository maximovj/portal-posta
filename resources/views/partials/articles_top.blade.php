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