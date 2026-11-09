@extends('layouts.app')

@section('title', 'Editar reserva')

@section('content')
    <div class="container">
        <h1 class="mb-4">Editar reserva</h1>

        <div class="card mb-4">
            <div class="card-body">
                <p class="mb-0"><strong>Precio actual:</strong> ${{ number_format((float) $reserva->precio, 2) }}</p>
            </div>
        </div>

        <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="card">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="mb-3">
                    <label for="servicio_id" class="form-label">Servicio</label>
                    <select class="form-select @error('servicio_id') is-invalid @enderror" id="servicio_id" name="servicio_id" required>
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->id }}" {{ old('servicio_id', $reserva->servicio_id) == $servicio->id ? 'selected' : '' }}>
                                {{ $servicio->nombre }} — ${{ number_format((float) $servicio->precio, 2) }}
                            </option>
                        @endforeach
                    </select>
                    @error('servicio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mascota_id" class="form-label">Mi perro</label>
                    <select class="form-select @error('mascota_id') is-invalid @enderror" id="mascota_id" name="mascota_id" required>
                        @foreach($mascotas as $mascota)
                            <option value="{{ $mascota->id }}" {{ old('mascota_id', $reserva->mascota_id) == $mascota->id ? 'selected' : '' }}>
                                {{ $mascota->nombre }} — {{ $mascota->usuario?->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('mascota_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="veterinario_id" class="form-label">Veterinario</label>
                    <select class="form-select @error('veterinario_id') is-invalid @enderror" id="veterinario_id" name="veterinario_id" required>
                        @foreach($veterinarios as $veterinario)
                            <option value="{{ $veterinario->id }}" {{ old('veterinario_id', $reserva->veterinario_id) == $veterinario->id ? 'selected' : '' }}>
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
                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha', $reserva->fecha) }}" required>
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hora_inicio" class="form-label">Hora de inicio</label>
                    <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio', substr($reserva->hora_inicio, 0, 5)) }}" required>
                    @error('hora_inicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-secondary">La hora de finalización se calcula según la duración del servicio.</small>
                </div>

                @if($esAdmin)
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                        <option value="pendiente" {{ old('estado', $reserva->estado) === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="confirmada" {{ old('estado', $reserva->estado) === 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                        <option value="cancelada" {{ old('estado', $reserva->estado) === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endif
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
