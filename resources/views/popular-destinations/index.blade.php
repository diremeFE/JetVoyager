@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-4">
        @foreach ($destinos as $destino)
            <x-popular-destinations class="col-span-12 md:col-span-6 xl:col-span-4" :imagenURL="asset('storage/images/popular-destinations-cards/' . ($destino->imagen ?? 'default.jpg'))" :destino="$destino->city->name"
                :descripcion="$destino->descripcion" :id="$destino->city->id"
            />
        @endforeach
    </div>
@endsection
