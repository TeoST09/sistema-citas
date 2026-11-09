@extends('layouts.app')

@section('title', 'Agendar servicio')

@section('content')
    <div class="container">
        <h1 class="mb-4">Agendar servicio</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="h4">{{ $servicio->nombre }}</h2>
                <p>{{ $servicio->descripcion ?: 'Sin descripción.' }}</p>
                <p class="mb-1"><strong>Precio:</strong> ${{ number_format((float) $servicio->precio, 2) }}</p>
                <p class="mb-0"><strong>Duración:</strong> {{ $servicio->duracion_minutos }} minutos</p>
            </div>
        </div>

        <form action="{{ route('reservas.store') }}" method="POST" class="card">
            @csrf
            <input type="hidden" name="servicio_id" value="{{ $servicio->id }}">

            <div class="card-body">
                <div class="mb-3">
                    <label for="mascota_id" class="form-label">Mi perro</label>
                    <select class="form-select @error('mascota_id') is-invalid @enderror" id="mascota_id" name="mascota_id" required>
                        <option value="">Selecciona tu mascota</option>
                        @foreach($mascotas as $mascota)
                            <option value="{{ $mascota->id }}" {{ old('mascota_id') == $mascota->id ? 'selected' : '' }}>
                                {{ $mascota->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('mascota_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($mascotas->isEmpty())
                        <small class="text-secondary">No tienes mascotas registradas.</small>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="veterinario_id" class="form-label">Veterinario</label>
                    <select class="form-select @error('veterinario_id') is-invalid @enderror" id="veterinario_id" name="veterinario_id" required>
                        <option value="">Selecciona un veterinario</option>
                        @foreach($veterinarios as $veterinario)
                            <option value="{{ $veterinario->id }}" {{ old('veterinario_id') == $veterinario->id ? 'selected' : '' }}>
                                {{ $veterinario->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('veterinario_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha') }}" min="{{ now()->toDateString() }}" required>
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hora_inicio" class="form-label">Hora de inicio</label>
                    <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}" required>
                    @error('hora_inicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-secondary">La hora de finalización se calcula según la duración del servicio.</small>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" @disabled($mascotas->isEmpty() || $veterinarios->isEmpty())>Confirmar reserva</button>
                <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
