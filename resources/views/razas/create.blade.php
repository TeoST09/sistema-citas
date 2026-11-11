@extends('layouts.app')

@section('title', 'Agregar raza')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Agregar raza</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('razas.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre') }}"
                            maxlength="100"
                            required
                        >
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="especie_id" class="form-label">Especie</label>
                        <select
                            id="especie_id"
                            name="especie_id"
                            class="form-select @error('especie_id') is-invalid @enderror"
                            required
                        >
                            <option value="">Selecciona una especie</option>
                            @foreach($especies as $especie)
                                <option value="{{ $especie->id }}" {{ old('especie_id') == $especie->id ? 'selected' : '' }}>
                                    {{ $especie->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('especie_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar raza</button>
                    <a href="{{ route('razas.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
