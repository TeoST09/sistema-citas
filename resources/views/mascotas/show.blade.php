@extends('layouts.app')

@section('title', 'Ver Mascota')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="h3 mb-0">{{ $mascota->nombre }}</h1>
            </div>
            <div class="card-body">
                @if($mascota->foto)
                    <img src="{{ asset('storage/' . $mascota->foto) }}" alt="Foto de {{ $mascota->nombre }}" class="img-fluid rounded mb-4" style="max-width: 300px;">
                @endif

                <dl class="row">
                    <dt class="col-sm-4">Fecha de nacimiento</dt>
                    <dd class="col-sm-8">{{ $mascota->fecha_nacimiento ?? 'No especificada' }}</dd>

                    <dt class="col-sm-4">Sexo</dt>
                    <dd class="col-sm-8">{{ $mascota->sexo ?? 'No especificado' }}</dd>

                    <dt class="col-sm-4">Peso</dt>
                    <dd class="col-sm-8">{{ $mascota->peso !== null ? $mascota->peso . ' kg' : 'No especificado' }}</dd>

                    <dt class="col-sm-4">Usuario</dt>
                    <dd class="col-sm-8">{{ $user->name ?? 'No especificado' }}</dd>

                    <dt class="col-sm-4">Especie</dt>
                    <dd class="col-sm-8">{{ $especie->nombre ?? 'No especificada' }}</dd>

                    <dt class="col-sm-4">Raza</dt>
                    <dd class="col-sm-8">{{ $raza->nombre ?? 'No especificada' }}</dd>
                </dl>

                <a href="{{ route('mascotas.edit', $mascota->id) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
