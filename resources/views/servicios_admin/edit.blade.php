
@extends('layouts.app')

@section('title', 'Editar servicio')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Editar servicio</h1>

        <form action="{{ route('servicios_admin.update', $servicio->id) }}" method="POST" class="card">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                        type="text"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        name="nombre"
                        value="{{ old('nombre', $servicio->nombre) }}"
                        maxlength="100"
                        required
                    >
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción (opcional)</label>
                    <textarea
                        class="form-control @error('descripcion') is-invalid @enderror"
                        id="descripcion"
                        name="descripcion"
                        rows="4"
                    >{{ old('descripcion', $servicio->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input
                        type="number"
                        class="form-control @error('precio') is-invalid @enderror"
                        id="precio"
                        name="precio"
                        value="{{ old('precio', $servicio->precio) }}"
                        min="0"
                        max="99999999.99"
                        step="0.01"
                        required
                    >
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="duracion_minutos" class="form-label">Duración (minutos)</label>
                    <input
                        type="number"
                        class="form-control @error('duracion_minutos') is-invalid @enderror"
                        id="duracion_minutos"
                        name="duracion_minutos"
                        value="{{ old('duracion_minutos', $servicio->duracion_minutos) }}"
                        min="1"
                        required
                    >
                    @error('duracion_minutos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">Estado</label>
                    <select
                        class="form-select @error('is_active') is-invalid @enderror"
                        id="is_active"
                        name="is_active"
                        required
                    >
                        <option value="1" {{ (string) old('is_active', (int) $servicio->is_active) === '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ (string) old('is_active', (int) $servicio->is_active) === '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('servicios_admin.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
