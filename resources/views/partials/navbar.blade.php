<nav class="navbar navbar-expand-lg navbar-dark bg-navbar-header">
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
                    @if(moonshine_role_name() === 'Admin')          Admin
                    @elseif(moonshine_role_name() === 'Blogger')    Blogger
                    @else                                           Cuenta
                    @endif
                    </a>

                    @unless(moonshine_user())
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" target="_blank" rel="alternate" referrerpolicy="origin" href="/admin">Acceder</a></li>
                    </ul>
                    @else
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" target="_blank" rel="alternate" referrerpolicy="origin" href="/admin">Ver panel</a></li>
                        @if(moonshine_role_name() === 'Admin')
                        <li><a class="dropdown-item" target="_blank" rel="alternate" referrerpolicy="origin" href="{{ route('moonshine.resource.page', [
                            'resourceUri' => 'moon-shine-user-resource',
                            'pageUri' => 'index-page',
                        ]) }}">Administrar usuarios</a></li>
                        <li><a class="dropdown-item" target="_blank" rel="alternate" referrerpolicy="origin" href="{{ route('moonshine.resource.page', [
                            'resourceUri' => 'moon-shine-user-role-resource',
                            'pageUri' => 'index-page',
                        ]) }}">Administrar roles</a></li>
                        @elseif(moonshine_role_name() === 'Blogger')
                        <li><a class="dropdown-item" target="_blank" rel="alternate" referrerpolicy="origin" href="{{ route('moonshine.resource.page', [
                            'resourceUri' => 'article-resource',
                            'pageUri' => 'index-page',
                        ]) }}">Administrar artículos</a></li>
                        <li><a class="dropdown-item" href="#">Administrar comentarios</a></li>
                        @endif
                    </ul>
                    @endunless
                </li>
            </ul>
        </div>
    </div>
</nav>
