@extends('layout.base')

@section('main_content')
@foreach ($articles as $article)
<div class="d-flex flex-row justify-content-between align-items-center mt-5">
    <div>
        <div>
            <h1 class="inline fs-3 fw-bold">{!! $article->title ?? '' !!}</h1>
            <h2 class="fs-6">{!! $article->subtitle ?? '' !!}</h2>
            <span class="inline-block lead fw-bold fs-6">{!! $article->author ?? '' !!}</span>
        </div>
        <div>
            <p style="font-size:14px;">Publicado en: {{ $article->published_at->format('d/m/Y') }}</p>
            @foreach (explode(',', $article->tags) as $tag)
            <span class="badge bg-secondary"><i class="bi bi-tag"></i>&nbsp;{{ $tag }}</span>
            @endforeach
        </div>
    </div>
</div>
<hr class="mx-0 my-4" />
<main>
    {!! $article->header !!}
    <a href="{{ route('portal.posta.article', ['article' => $article]) }}">Leer más</a>
</main>
@endforeach

{{ $articles->links('pagination::bootstrap-5') }}
@endsection
