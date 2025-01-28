<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{!! $article->meta_description ?? 'Resumen del artículo' !!}">
    <title>Article</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <!-- Añadir estilos adicionales -->
    <style>
        /* Hacer que el body ocupe toda la altura de la ventana */
        html, body {
            height: 100%;
        }
        /* Flexbox para el contenedor */
        .container {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }
        /* Empujar el footer hacia abajo */
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <header id="stickyHeader" class="mb-4 bg-sticky-header p-3 rounded">
            @include('partials.navbar')
        </header>
        <main>
            @yield('main_content')
        </main>
        <footer>
            <blockquote class="blockquote text-center">
                <p>Creado por: <a href="https://github.com/maximovj" target="_blank">Víctor J.</a></p>
            </blockquote>
        </footer>
    </div>

    <script>
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
