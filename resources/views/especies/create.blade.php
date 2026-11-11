@extends('layouts.app')

@section('title', 'Agregar especie')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Agregar especie</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('especies.store') }}" method="POST">
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

                    <button type="submit" class="btn btn-primary">Guardar especie</button>
                    <a href="{{ route('especies.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
