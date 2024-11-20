@extends('layouts.app') <!-- Aquí se extiende la plantilla base -->

@section('content')
    <!-- Aquí se inyecta el contenido específico -->
    <!-- Tu contenido específico de la página de bienvenida va aquí -->
    <h1>Bienvenido a JetVoyager</h1>

    <!--DESTINOS POPULARES-->
    <section class="p-6 flex flex-col max-w-7xl mx-auto">
        <h2 class="text-3xl font-semibold mb-9">Destinos populares</h2>

    </section>

 
    <!--OFERTAS ESPECIALES A DESTINOS POPULARES-->
    <section class="p-6 flex flex-col max-w-7xl mx-auto">
        <h2 class="text-3xl font-semibold mb-9">Ofertas a destinos populares</h2>
        <div class="grid grid-cols-12 gap-4">
            <x-popular-destinations class="col-span-12 md:col-span-6 xl:col-span-4" :imagenURL="asset('storage/images/popular-destinations-cards/chicago.jpg')" :destino="'Chicago'" :descripcion="'Precio de vuelo más hotel 780 $'" />
            <x-popular-destinations class="col-span-12 md:col-span-6 xl:col-span-4" :imagenURL="asset('storage/images/popular-destinations-cards/sevilla.jpg')" :destino="'Sevilla'" :descripcion="'Precio de vuelo más hotel 350 $'" />
            <x-popular-destinations class="col-span-12 md:col-span-12 xl:col-span-4" :imagenURL="asset('storage/images/popular-destinations-cards/roma.jpg')" :destino="'Roma'" :descripcion="'Precio de vuelo más hotel 1600 $'" />
        </div>
    </section>

    <!--ENLACES ÚTILES-->
    <section class="p-6 flex flex-col max-w-7xl mx-auto">
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
