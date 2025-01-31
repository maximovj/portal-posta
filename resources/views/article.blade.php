@extends('layout.base')

@section('page_title')
Artículo | {{ $article->title ?? ('Artículo No. #' . $article->id) }}
@endsection

@section('page_description')
{{ $article->summary ?? 'Resumen del artículo' }}
@endsection

@section('content_header')
<div class="d-none d-lg-block shadow-sm p-3 bg-body rounded-bottom">
    <div class="d-none d-lg-flex article-header">
        <div>
            <h1 class="inline fs-3 fw-bold">{!! $article->title ?? ''  !!}</h1>
            <h2 class="fs-6">{!! $article->subtitle ?? ''  !!}</h2>
            <span class="inline-block lead fw-bold fs-6">{!! $article->author ?? ''  !!}</span>
            @can('update', $article)
                <div class="my-2">
                    <a 
                    target="_blank" 
                    rel="alternate" 
                    referrerpolicy="origin"
                    class="btn btn-danger btn-sm"
                    href="{{ route('moonshine.resource.page', [
                        'resourceUri' => 'article-resource',
                        'pageUri' => 'form-page',
                        'resourceItem' => $article->id,
                    ]) }}">Modificar mi artículo</a>
                </div>
            @endcan
        </div>
        <div>
            <p style="font-size:14px;">Publicado en: {{ $article->published_at->format('d/m/Y') }}</p>
            @foreach (explode(',', $article->tags) as $tag)
                <span class="badge bg-secondary"><i class="bi bi-tag"></i>&nbsp;{{ $tag }}</span>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('content_main')
{!! $article->header  !!}
{!! $article->content  !!}
{!! $article->footer  !!}
@endsection

@section('content_footer')
<div class="shadow-sm p-3 mb-5 bg-body rounded">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <p class="inline-block lead fw-bold">{!! $article->author ?? $article->moonshine_user->name ?? 'Desconocido' !!}</p>
            <p style="font-size:14px;">Publicado en: {{ $article->published_at->format('d/m/Y') }}</p>
            <div>
                @foreach (explode(',', $article->tags) as $tag)
                <span class="badge bg-secondary"><i class="bi bi-tag"></i>&nbsp;{{ $tag }}</span>
                @endforeach
            </div>
        </div>
        <ul class="list-unstyled grid">
            @foreach ($article->network_social as $social )
            @if($social['active'])
            <li class="g-col-4 ">
                <span class="me-1"><i class="bi bi-{{ strtolower($social['social']) }}"></i></span>
                <span class="fw-bold fs-6">{{ $social['social'] }}</span>
                <span>:</span>
                <span>{{ $social['username'] }}</span>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
    <livewire:article-rating :article="$article" />
</div>
@endsection

@push('custom_script')
<script>
    function rateArticle(element, rating) {
        const route = element.getAttribute('data-route');

        fetch(`${route}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ rating })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('current-rating').innerText = `Puntaje: ${data.rating} ⭐ (${data.rating_count} votos)`;
        });
    }
</script>
@endpush