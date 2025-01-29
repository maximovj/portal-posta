<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('page_description')">
    <title>@yield('page_title')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @stack('custom_styles')
</head>
<body>
    <!-- Botón flotante -->
    <button id="backToTop" class="btn btn-primary btn-lg rounded-circle">
        <i class="bi bi-arrow-up"></i>
    </button>
    <div class="container">
        <header id="stickyHeader" class="mb-4 bg-sticky-header p-3 rounded-bottom">
            @include('partials.navbar')
            @yield('content_header')
        </header>

        @hasSection('content_header')
        <hr class="mx-0 my-4" />
        @endif
        
        <main>
            @yield('content_main')
        </main>
        
        <hr class="mx-0 my-4 " />
        
        <footer>
            @yield('content_footer')
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
            const navbarToggle = document.querySelector('.navbar-collapse'); // Selector del menú desplegable de Bootstrap
            const breakpoint = 768; // Ancho mínimo para aplicar sticky
            const stickyOffset = header.offsetTop; // Posición original del header
            let lastScrollY = 0; // Guardar la posición previa del scroll
            let isScrollingDown = false; // Bandera para determinar dirección
            let isHidden = false; // Estado del header
            let isNavbarInteracting = false; // Bandera para saber si el Navbar está desplegado

            // Escuchar eventos de Bootstrap para saber si el Navbar está desplegado
            navbarToggle.addEventListener('show.bs.collapse', () => {
                isNavbarInteracting = true;
            });

            navbarToggle.addEventListener('hide.bs.collapse', () => {
                isNavbarInteracting = false;
            });

            const toggleHeaderVisibility = () => {
                //console.log({ lastScrollY });
                //if (window.innerWidth < breakpoint) return; // No aplicar en pantallas pequeñas

                // Si la pantalla de dispositivo es grande, ocultar el header
                if (window.innerWidth > breakpoint) {
                    isNavbarInteracting = false;
                }

                // Si el Navbar está desplegado, no ocultar el header
                if (isNavbarInteracting) return;

                const currentScrollY = window.pageYOffset;
                isScrollingDown = currentScrollY > lastScrollY; // Determinar dirección

                if (isScrollingDown && currentScrollY > stickyOffset && !isHidden) {
                    // Deslizar hacia arriba y ocultar el header
                    header.classList.remove('slide-down');
                    header.classList.add('slide-up');
                    header.classList.add('shadow');
                    setTimeout(() => {
                        header.classList.add('hidden');
                    }, 500); // Coincide con la duración de la animación
                    isHidden = true;
                } else if (!isScrollingDown && isHidden) {
                    // Deslizar hacia abajo y mostrar el header
                    header.classList.remove('hidden', 'slide-up');
                    header.classList.add('slide-down');
                    header.classList.add('shadow');
                    isHidden = false;
                }

                if (lastScrollY <= 100) {
                    header.classList.remove('shadow');
                }

                lastScrollY = currentScrollY; // Actualizar la posición del scroll
            };

            window.addEventListener('scroll', toggleHeaderVisibility);

            // Opcional: manejar cambios de tamaño para reiniciar clases
            window.addEventListener('resize', () => {
                if (window.innerWidth < breakpoint) {
                    header.classList.remove('slide-up', 'shadow', 'slide-down', 'hidden');
                    isHidden = false;
                }
            });
        });
    </script>
    @stack('custom_script')
</body>
</html>