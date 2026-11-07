@extends('layouts.app')

@section('title', 'Editar Mascota')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="h3 mb-0">Editar mascota</h1>
            </div>

            <div class="card-body">
                <form action="{{ route('mascotas.update', $mascota->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $mascota->nombre) }}" maxlength="100" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $mascota->fecha_nacimiento) }}">
                        @error('fecha_nacimiento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo">
                            <option value="">Seleccione el sexo</option>
                            <option value="Macho" {{ old('sexo', $mascota->sexo) === 'Macho' ? 'selected' : '' }}>Macho</option>
                            <option value="Hembra" {{ old('sexo', $mascota->sexo) === 'Hembra' ? 'selected' : '' }}>Hembra</option>
                        </select>
                        @error('sexo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="peso" class="form-label">Peso (kg)</label>
                        <input type="number" class="form-control @error('peso') is-invalid @enderror" id="peso" name="peso" value="{{ old('peso', $mascota->peso) }}" min="0" max="999.99" step="0.01">
                        @error('peso')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        @if($mascota->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $mascota->foto) }}" alt="Foto de {{ $mascota->nombre }}" width="120" class="rounded">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuario</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            @foreach($usuario as $item)
                                <option value="{{ $item->id }}" {{ (string) old('user_id', $mascota->user_id) === (string) $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="especie_id" class="form-label">Especie</label>
                        <select class="form-select @error('especie_id') is-invalid @enderror" id="especie_id" name="especie_id" required>
                            @foreach($especie as $item)
                                <option value="{{ $item->id }}" {{ (string) old('especie_id', $mascota->especie_id) === (string) $item->id ? 'selected' : '' }}>{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                        @error('especie_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="raza_id" class="form-label">Raza (opcional)</label>
                        <select class="form-select @error('raza_id') is-invalid @enderror" id="raza_id" name="raza_id">
                            <option value="">Seleccione una raza</option>
                            @foreach($raza as $item)
                                <option value="{{ $item->id }}" {{ (string) old('raza_id', $mascota->raza_id) === (string) $item->id ? 'selected' : '' }}>{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                        @error('raza_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
