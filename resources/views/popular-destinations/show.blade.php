@extends('layouts.app')

@section('content')
<h1>Destino: {{ $destino->city->name }}</h1>
<p>Descripción: {{ $destino->descripcion }}</p>

<h2>Aeropuertos:</h2>
<p>Origen: {{ $origenAirport->name }} - {{ $origenAirport->city->name }}</p>
<p>Destino: {{ $destinoAirport->name }} - {{ $destinoAirport->city->name }}</p>

<h2>Vuelos Disponibles:</h2>
<ul>
    @foreach($vuelos as $vuelo)
        <li>{{ $vuelo->flight_number }} - {{ $vuelo->departure_time }}</li>
    @endforeach
</ul>
@endsection
