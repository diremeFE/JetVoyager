<div class="{{ $class ?? '' }} relative h-80 p-2 shadow-lg rounded-3xl overflow-hidden transition-transform duration-300 ease-in-out hover:scale-95"
    style="background-image: url('{{ $imagenURL }}'); background-size: cover; background-position: center;">

    <!-- Capa de opacidad -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <!-- Contenido del destino -->
    <div class="relative z-10 text-white p-4 rounded-lg flex flex-col justify-end h-full">
        <!-- Título del destino -->
        <h3 class="text-3xl font-semibold">{{ $destino ?? 'Destino desconocido' }}</h3>
        <p class="text-sm">{{ $descripcion ?? 'Sin descripción disponible.' }}</p>

        <!-- Botón -->
        <a href="{{ route('popular-destinations.show', $id) }}"
            class="w-[200px] mt-5 bg-yellow text-black font-semibold px-4 py-2 rounded-full flex items-center justify-center space-x-2 hover:bg-yellow-500 transition duration-300">
            <span class="font-medium">Reservar vuelo</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>
