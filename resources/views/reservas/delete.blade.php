@extends('layouts.app')

@section('title', 'Eliminar reserva')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="h3 mb-0">Eliminar reserva</h1>
            </div>
            <div class="card-body">
                <p>¿Seguro que deseas eliminar esta reserva?</p>
                <p class="mb-1"><strong>Servicio:</strong> {{ $reserva->servicio_nombre }}</p>
                <p class="mb-1"><strong>Mascota:</strong> {{ $reserva->mascota_nombre }}</p>
                <p class="mb-0"><strong>Fecha:</strong> {{ $reserva->fecha }} — {{ substr($reserva->hora_inicio, 0, 5) }}</p>
            </div>
            <div class="card-footer">
                <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sí, eliminar reserva</button>
                </form>
                <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </div>
@endsection
