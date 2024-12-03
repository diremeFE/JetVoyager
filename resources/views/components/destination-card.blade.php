<div class="{{ $class ?? '' }} relative  p-2 shadow-lg rounded-lg overflow-hidden transition-transform duration-300 ease-in-out hover:scale-95"
     style="background-image: url('{{ $imagenURL ?? asset('storage/images/default.jpg') }}'); background-size: cover; background-position: center;">

    <div class="relative  text-white p-4 rounded-lg flex flex-col justify-end h-full">
        <p class="text-sm">{{ $descripcion ?? 'Sin descripción disponible.' }}</p>
        <h3 class="text-3xl font-semibold">{{ $destino ?? 'Destino desconocido' }}</h3>
    </div>
</div>
