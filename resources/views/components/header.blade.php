<header class="bg-primary-black text-white">
    <!-- Primera fila -->
    <div class="flex justify-between p-5 items-center ">
        <!-- Logo -->
        <a href="/">
            <img src="{{ asset('storage/images/Logo.svg') }}" alt="Logo JetVoyager" width="200px">
        </a>

        <!-- Botón de menú hamburguesa (visible en móvil) -->
        <button id="menu-toggle" class="lg:hidden text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Idioma, moneda y sesión (oculto en móvil) -->
        <div class="hidden lg:flex items-center gap-6">
            <!-- Selector de idioma y moneda -->
            <div class="relative">
                <button id="language-toggle" class="flex items-center gap-2 text-white  focus:outline-none">
                    <img src="{{ asset('storage/images/flags/flag-es.png') }}" alt="Bandera España" class="w-5 h-5">
                    <span>Español - ES€</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Menú desplegable de idiomas y monedas -->
                <ul id="language-menu"
                    class="absolute right-0 mt-2 bg-white text-black rounded-md shadow-md hidden">
                    <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer flex items-center gap-2">
                        <img src="{{ asset('storage/images/flags/flag-us.png') }}" alt="Bandera USA"
                            class="w-5 h-5">
                        <span>Inglés - US$</span>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer flex items-center gap-2">
                        <img src="{{ asset('storage/images/flags/flag-fr.png') }}" alt="Bandera Francia"
                            class="w-5 h-5">
                        <span>Francés - FR€</span>
                    </li>
                </ul>
            </div>

            <!-- Enlaces de sesión -->
            <div class="flex items-center gap-4">
                @auth
                    <!-- Usuario autenticado -->
                    <div class="relative">
                        <button id="user-menu-toggle" class="flex items-center gap-2 text-white focus:outline-none">
                            <span>Hola!, {{ Auth::user()->name }}</span> <!-- Nombre del usuario -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
            
                        <!-- Menú desplegable del usuario -->
                        <ul id="user-menu"
                            class="absolute right-0 mt-2 bg-white text-black rounded-md shadow-md hidden">
                            <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer">
                                <a href="{{ route('profile.show') }}">Perfil</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Usuario no autenticado -->
                    <a href="{{ route('register') }}" class="text-white">Registrarse</a>
                    <a href="{{ route('login') }}"
                        class="bg-yellow text-[#1D223F] px-4 py-2 rounded-md font-semibold hover:bg-yellow-400">Iniciar
                        Sesión</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Segunda fila (navegación) -->
    <nav id="menu" class=" p-5 hidden lg:flex justify-end items-center space-x-6 text-md">
        <a href="/" class="text-yellow font-semibold">Inicio</a>
        <a href="/flights" class="hover:text-yellow">Explorar</a>
        <a href="/reservations" class="hover:text-yellow">Mis vuelos</a>
        <a href="/offers" class="hover:text-yellow">Promociones exclusivas</a>
        <a href="/airport-info" class="hover:text-yellow">Antes de despegar</a>
    </nav>
</header>




<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');

        const languageToggle = document.getElementById('language-toggle');
        const languageMenu = document.getElementById('language-menu');

        // Menú hamburguesa (móvil)
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');
            menu.classList.toggle('flex-col'); // Cambia a disposición columna en móvil
        });

        // Selector de idioma y moneda
        languageToggle.addEventListener('click', () => {
            languageMenu.classList.toggle('hidden');
        });

        // Cerrar el selector si se hace clic fuera
        document.addEventListener('click', (e) => {
            if (!languageToggle.contains(e.target) && !languageMenu.contains(e.target)) {
                languageMenu.classList.add('hidden');
            }
        });

        const userMenuToggle = document.getElementById('user-menu-toggle');
        const userMenu = document.getElementById('user-menu');

        if (userMenuToggle && userMenu) {
            userMenuToggle.addEventListener('click', () => {
                userMenu.classList.toggle('hidden');
            });

            // Cerrar el menú si se hace clic fuera
            document.addEventListener('click', (e) => {
                if (!userMenuToggle.contains(e.target) && !userMenu.contains(e.target)) {
                    userMenu.classList.add('hidden');
                }
            });
        }
    });
</script>
