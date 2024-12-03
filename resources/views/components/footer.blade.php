<footer class="bg-primary-black p-12">
    <!-- Logo -->
    <div class="flex justify-center lg:justify-start">
        <img src="{{ asset('storage/images/Logo.svg') }}" alt="Logo JetVoyager" width="250" class="mb-6">
    </div>

    <!-- Grilla principal -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-9">
        <!-- Columna 1 -->
        <div class="flex flex-col">
            <h2 class="text-xl lg:text-xl text-white font-light mb-3">COMPAÑÍA</h2>
            <a href="#" class="text-gray-footer hover:underline">Acerca de</a>
            <a href="#" class="text-gray-footer hover:underline">Política de privacidad</a>
            <a href="#" class="text-gray-footer hover:underline">Política de cookies</a>
            <a href="#" class="text-gray-footer hover:underline">Condiciones de servicio</a>
            <a href="#" class="text-gray-footer hover:underline">Términos y condiciones</a>
        </div>

        <!-- Columna 2 -->
        <div class="flex flex-col">
            <h2 class="text-xl lg:text-md text-white font-light mb-3">¿NECESITAS AYUDA?</h2>
            <a href="#" class="text-gray-footer hover:underline">Centro de ayuda</a>
            <a href="#" class="text-gray-footer hover:underline">Telf: +34 681775864</a>
            <a href="#" class="text-gray-footer hover:underline">Correo: contact@jetvoyager.es</a>
            <p class="text-gray-footer">Avenida de la Innovación, <br> 45 28042 Madrid, España</p>
        </div>

        <!-- Columna 3 -->
        <div class="flex flex-col">
            <h2 class="text-xl lg:text-md text-white font-light mb-3">INFORMACIÓN ÚTIL</h2>
            <a href="#" class="text-gray-footer hover:underline">Clase Business</a>
            <a href="#" class="text-gray-footer hover:underline">Flota</a>
            <a href="#" class="text-gray-footer hover:underline">Sostenibilidad</a>
        </div>

        <!-- Columna 4 -->
        <div class="flex flex-col">
            <h2 class="text-xl lg:text-md text-white font-light mb-3">VUELOS</h2>
            <a href="#" class="text-gray-footer hover:underline">Vuelos a Milan</a>
            <a href="#" class="text-gray-footer hover:underline">Vuelos a Malta</a>
            <a href="#" class="text-gray-footer hover:underline">Vuelos a Venecia</a>
            <a href="#" class="text-gray-footer hover:underline">Vuelos a Islas Canarias</a>
            <a href="#" class="text-gray-footer hover:underline">Vuelos a Mallorca</a>
        </div>
    </div>

    <!-- Newsletter y redes sociales -->
    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Suscripción -->
        <div>
            <h2 class="text-lg lg:text-xl text-white font-semibold mb-2">¿Quieres recibir nuevas ofertas?</h2>
            <p class="text-gray-footer mb-3">Déjanos tu correo electrónico</p>
            <input type="email" placeholder="example@gmail.com" class="w-full p-3 rounded-lg text-white placeholder-gray-400">
        </div>

        <!-- Redes sociales -->
        <div class="flex justify-center space-x-5">
            <a href="#"><img src="{{ asset('storage/images/social-media/instagram.svg') }}" alt="Instagram" width="35"></a>
            <a href="#"><img src="{{ asset('storage/images/social-media/meta.svg') }}" alt="Meta" width="35"></a>
            <a href="#"><img src="{{ asset('storage/images/social-media/youtube.svg') }}" alt="YouTube" width="35"></a>
        </div>
    </div>

    <div class="w-full flex justify-center mt-9">
        <p class="text-white font-light">Todos los derechos reservados a <a href="https://requenaart.es/" class="font-semibold">requenaart.es</a></p>
    </div>
</footer>
