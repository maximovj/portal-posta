<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{!! $article->summary ?? 'Resumen del artículo' !!}">
    <title>Article</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <!-- Botón flotante -->
    <button id="backToTop" class="btn btn-primary btn-lg rounded-circle">
        <i class="bi bi-arrow-up"></i>
    </button>
    <div class="container">
        <header id="stickyHeader" class="mb-4 bg-sticky-header p-3 rounded">
            <nav class="navbar navbar-expand-lg navbar-dark bg-navbar-header" >
                <div class="container-fluid">
                  <a class="navbar-brand" href="/">Portal Posta</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Inicio</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Noticias</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Artículos</a>
                      </li>
                    </ul>
                    <form class="d-flex ms-auto">
                      <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                      <button class="btn btn-outline-light" type="submit">Buscar</button>
                    </form>
                    <ul class="navbar-nav ms-3">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Más
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="#">Opción 1</a></li>
                          <li><a class="dropdown-item" href="#">Opción 2</a></li>
                          <li><a class="dropdown-item" href="#">Opción 3</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
            </nav>
            <div class="d-flex justify-content-between align-items-center mt-5">
                <div>
                    <h1 class="inline fs-3 fw-bold">{!! $article->title ?? ''  !!}</h1>
                    <h2 class="fs-6">{!! $article->subtitle ?? ''  !!}</h2>
                    <span class="inline-block lead fw-bold fs-6">{!! $article->author ?? ''  !!}</span>
                    @can('update', $article)
                        <div class="my-2">
                            <a 
                            role="button" 
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
        </header>
        <hr class="mx-0 my-4" />
        <main>
            {!! $article->header  !!}
            {!! $article->content  !!}
            {!! $article->footer  !!}
        </main>
        <hr class="mx-0 my-4 " />
        <footer class="shadow-sm p-3 mb-5 bg-body rounded">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="inline-block lead fw-bold">{!! $article->author ?? $article->moonshine_user->name  ?? 'Desconocido' !!}</p>
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
                                <span class="me-1"><i class="bi bi-{{ strtolower($social['title']) }}"></i></span>
                                <span class="fw-bold fs-6">{{ $social['title'] }}</span> 
                                <span>:</span> 
                                <span>{{ $social['value'] }}</span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </footer>
    </div>
    <script>
        // Obtener el botón
        const backToTopButton = document.getElementById('backToTop');

        // Mostrar el botón cuando el usuario se desplaza hacia abajo
        window.addEventListener('scroll', () => {
        if (window.scrollY > 300) { // Si ha bajado más de 300px
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
        });

        // Volver al inicio al hacer clic en el botón
        backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Animación suave
        });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const header = document.getElementById('stickyHeader');
            const breakpoint = 768; // Ancho mínimo para aplicar sticky
            const stickyOffset = header.offsetTop; // Posición original del header

            window.addEventListener('scroll', () => {
                if (window.innerWidth >= breakpoint) {
                    if (window.pageYOffset > stickyOffset) {
                        header.classList.add('shadow', 'sticky-lg-top');
                    } else {
                        header.classList.remove('shadow', 'sticky-lg-top');
                    }
                } else {
                    header.classList.remove('shadow', 'sticky-lg-top'); // Quitar sticky en pantallas pequeñas
                }
            });
        });
    </script>
</body>
</html>