@extends('layouts.app') <!-- Aquí se extiende la plantilla base -->

@section('content')
<section class="h-64 bg-center bg-no-repeat bg-contain relative"
style="background-image: url('{{ asset('storage/images/Logo-black.svg') }}');">
<div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Busca tu vuelo</h2>

        <!-- Formulario de búsqueda de vuelos -->
        <form class="grid grid-cols-1 md:grid-cols-4 gap-4" action="{{ url('/search-flights') }}" method="GET">

            <!-- Opciones de solo ida o ida y vuelta -->
            <div class="md:col-span-4 flex justify-center space-x-4">
                <label class="flex items-center">
                    <input type="radio" name="tipo_viaje" value="ida" class="mr-2" checked>
                    Solo ida
                </label>
                <label class="flex items-center">
                    <input type="radio" name="tipo_viaje" value="ida_vuelta" class="mr-2">
                    Ida y vuelta
                </label>
            </div>

            <!-- Campo de Origen -->
            <div>
                <label for="origin" class="block text-sm font-medium text-gray-700">Origen</label>
                <select id="origin" name="origin" class="mt-1 block w-full rounded-md border-gray-300">
                    <option value="">Ciudad de origen</option>
                    <option value="MAD">Madrid (MAD)</option>
                    <option value="BCN">Barcelona (BCN)</option>
                    <option value="SVQ">Sevilla (SVQ)</option>
                    <option value="VLC">Manises (VLC)</option>
                </select>
            </div>

            <!-- Campo de Destino -->
            <div>
                <label for="destination" class="block text-sm font-medium text-gray-700">Destino</label>
                <select id="destination" name="destination" class="mt-1 block w-full rounded-md border-gray-300">
                    <option value="">Ciudad de destino</option>
                    <option value="CDG">París (CDG)</option>
                    <option value="LHR">Londres (LHR)</option>
                    <option value="FCO">Roma (FCO)</option>
                    <option value="VLC">Manises (VLC)</option>
                </select>
            </div>

            <!-- Campo de Fecha de Salida -->
            <div>
                <label for="departure" class="block text-sm font-medium text-gray-700">Salida</label>
                <input type="date" id="departure" name="departure"
                    class="block w-full rounded-md border-gray-300">
            </div>

            <!-- Campo de Fecha de Regreso (solo se muestra si es "Ida y vuelta") -->
            <div id="returnField">
                <label for="return_date" class="block text-sm font-medium text-gray-700">Regreso</label>
                <input type="date" id="return_date" name="return_date" class="block w-full rounded-md border-gray-300">
            </div>

            <!-- Botón de búsqueda -->
            <div class="md:col-span-4">
                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md">
                    Buscar Vuelos
                </button>
            </div>
        </form>

    </div>
</div>
</section>



    <!-- DESTINOS POPULARES -->
    <section class="p-6 flex flex-col max-w-7xl mx-auto">
        <h2 class="text-4xl font-semibold mb-9">Destinos populares</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 h-[600px]">
            <x-destination-card class="md:row-span-2" :imagenURL="asset('storage/images/popular-destinations-cards/estambul.jpg')" :destino="'Estambul'" :descripcion="'Turquía'" />
            <x-destination-card :imagenURL="asset('storage/images/popular-destinations-cards/kioto.jpg')" :destino="'Kioto '" :descripcion="'Japón'" />
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-destination-card :imagenURL="asset('storage/images/popular-destinations-cards/rio-de-janeiro.jpg')" :destino="'Río de Janeiro'" :descripcion="'Brasil'" />
                <x-destination-card :imagenURL="asset('storage/images/popular-destinations-cards/amsterdam.jpg')" :destino="'Ámsterdam '" :descripcion="'Países Bajos'" />
            </div>
        </div>
    </section>

    <!-- OFERTAS ESPECIALES A DESTINOS POPULARES -->
    <section class="p-6 flex flex-col max-w-7xl mx-auto">
        <div class="flex justify-between">
            <h2 class="text-4xl font-semibold mb-9">Ofertas a destinos populares</h2>
            <a href="popular-destinations" class="font-medium flex">Ver todos
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-12 gap-4">
            @foreach ($destinos as $destino)
                <x-popular-destinations class="col-span-12 md:col-span-6 xl:col-span-4" :imagenURL="asset('storage/images/popular-destinations-cards/' . ($destino->imagen ?? 'default.jpg'))"
                    :destino="$destino->city->name" :descripcion="$destino->descripcion" :id="$destino->city_id" />
            @endforeach

        </div>
    </section>


    <section class="p-6 flex flex-col max-w-7xl mx-auto">
        <div class="{{ $class ?? '' }} relative h-80 p-6 shadow-lg rounded-3xl overflow-hidden"
            style="background-image: url('{{ $imagenURL ?? asset('storage/images/family.jpg') }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-black bg-opacity-60"></div>
            <div class="relative z-10 text-white p-4 rounded-lg flex flex-col justify-center h-full space-y-10">
                <h3 class="text-3xl font-light">Explora el mundo en familia</h3>
                <p class="text-sm font-medium">Viajar con niños puede ser una aventura increíble, y estamos aquí para
                    hacerlo más
                    sencillo. <br> Disfruta de servicios personalizados y comodidades pensadas especialmente para el
                    bienestar y la diversión de toda tu familia.</p>
                <button
                    class="w-[200px] mt-5 bg-yellow text-black font-semibold px-4 py-2 rounded-full flex items-center justify-center space-x-2 hover:bg-yellow-500 transition duration-300">
                    <span>Descubre más</span>
                </button>
            </div>
        </div>
    </section>

    <!--ENLACES ÚTILES-->
    <section class="p-6 mb-10 flex flex-col max-w-7xl mx-auto">
        <h2 class="text-3xl font-semibold mb-9">Enlaces útiles</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-helpful-link-card tittle="Estado del vuelo" description="Lorem Ipsum is simply dummy text of the printing" />
            <x-helpful-link-card tittle="Requisitos de equipaje"
                description="Lorem Ipsum is simply dummy text of the printing" />
            <x-helpful-link-card tittle="Políticas de la aerolínea"
                description="Lorem Ipsum is simply dummy text of the printing" />
            <x-helpful-link-card tittle="Ofertas y descuentos"
                description="Lorem Ipsum is simply dummy text of the printing" />
        </div>
    </section>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', () => {
    const tipoViajeRadios = document.querySelectorAll('input[name="tipo_viaje"]');
    const returnField = document.getElementById('returnField');

    tipoViajeRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.value === 'ida') {
                returnField.style.display = 'none';
            } else {
                returnField.style.display = 'block';
            }
        });
    });

    const tipoViajeSeleccionado = document.querySelector('input[name="tipo_viaje"]:checked');
    if (tipoViajeSeleccionado && tipoViajeSeleccionado.value === 'ida') {
        returnField.style.display = 'none';
    }
});

</script>