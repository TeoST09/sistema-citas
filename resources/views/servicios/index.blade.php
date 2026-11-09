@extends('layouts.app')

@section('title', 'Servicios')

@section('content')
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <h1 class="mb-0">Servicios disponibles</h1>
            <a href="{{ route('reservas.index') }}" class="btn btn-outline-primary">Mis reservas</a>
        </div>

        <div class="row">
            @forelse($servicios as $servicio)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="h4">{{ $servicio->nombre }}</h2>
                            <p>{{ $servicio->descripcion ?: 'Sin descripción.' }}</p>
                            <p class="mb-1"><strong>Precio:</strong> ${{ number_format((float) $servicio->precio, 2) }}</p>
                            <p class="mb-0"><strong>Duración:</strong> {{ $servicio->duracion_minutos }} minutos</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('reservas.create', ['servicio_id' => $servicio->id]) }}" class="btn btn-primary">Agendar para mi perro</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="mb-0">No hay servicios disponibles en este momento.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
