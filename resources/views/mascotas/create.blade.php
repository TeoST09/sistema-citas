@extends('layouts.app')

@section('title', 'Crear Mascota')

@section('content')

    <div class="container">
        <h1 class="text-center">Agregar mascota</h1>

        <form action="{{ route('mascotas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input
                    type="text"
                    class="form-control @error('nombre') is-invalid @enderror"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    maxlength="100"
                    required
                >
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                <input
                    type="date"
                    class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                    id="fecha_nacimiento"
                    name="fecha_nacimiento"
                    value="{{ old('fecha_nacimiento') }}"
                >
                @error('fecha_nacimiento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select name="sexo" id="sexo">
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>
                @error('sexo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="peso" class="form-label">Peso (kg)</label>
                <input
                    type="number"
                    class="form-control @error('peso') is-invalid @enderror"
                    id="peso"
                    name="peso"
                    value="{{ old('peso') }}"
                    min="0"
                    max="999.99"
                    step="0.01"
                >
                @error('peso')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input
                    type="file"
                    class="form-control @error('foto') is-invalid @enderror"
                    id="foto"
                    name="foto"
                    accept="image/*"
                >
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">ID de usuario</label>
                <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="">Seleccione un usuario</option>
                    @foreach ($usuario as $item)
                        <option value="{{ $item->id }}" {{ old('user_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="especie_id" class="form-label">ID de especie</label>
                <select class="form-control @error('especie_id') is-invalid @enderror" id="especie_id" name="especie_id" required>
                    <option value="">Seleccione una especie</option>
                    @foreach ($especie as $item)
                        <option value="{{ $item->id }}" {{ old('especie_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('especie_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="raza_id" class="form-label">ID de raza (opcional)</label>
                <select class="form-control @error('raza_id') is-invalid @enderror" id="raza_id" name="raza_id">
                    <option value="">Seleccione una raza</option>
                    @foreach ($raza as $item)
                        <option value="{{ $item->id }}" {{ old('raza_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('raza_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar mascota</button>
            <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection