@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-4xl font-semibold mb-6">{{ $destino->city->name }}</h1>
    <p class="text-lg">{{ $destino->descripcion }}</p>

    <img src="{{ asset('storage/images/popular-destinations-cards/' . ($destino->imagen ?? 'default.jpg')) }}" 
         alt="{{ $destino->city->name }}" class="mt-6 rounded-lg shadow-md">
</div>
@endsection
