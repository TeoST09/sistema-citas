@extends('layouts.app')

@section('title', 'Mascotas')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Panel de mascotas</h1>
            @if(auth()->user()->role_id == 2 or auth()->user()->role_id == 3)
                <a href="{{ route('mascotas.create') }}" class="btn btn-primary">Agregar mascota</a>
            @endif
        </div>

        <form action="{{ route('mascotas.index') }}" method="GET" class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="buscar" class="form-label">Buscar por nombre de mascota o usuario</label>
                        <input type="search" class="form-control" id="buscar" name="buscar" value="{{ request('buscar') }}" placeholder="Escribe un nombre">
                    </div>
                    <div class="col-md-3">
                        <label for="raza_id" class="form-label">Raza</label>
                        <select class="form-select" id="raza_id" name="raza_id">
                            <option value="">Todas las razas</option>
                            @foreach($razas as $raza)
                                <option value="{{ $raza->id }}" {{ request('raza_id') == $raza->id ? 'selected' : '' }}>
                                    {{ $raza->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="especie_id" class="form-label">Especie</label>
                        <select class="form-select" id="especie_id" name="especie_id">
                            <option value="">Todas las especies</option>
                            @foreach($especies as $especie)
                                <option value="{{ $especie->id }}" {{ request('especie_id') == $especie->id ? 'selected' : '' }}>
                                    {{ $especie->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" id="sexo" name="sexo">
                            <option value="">Todos</option>
                            <option value="Macho" {{ request('sexo') === 'Macho' ? 'selected' : '' }}>Macho</option>
                            <option value="Hembra" {{ request('sexo') === 'Hembra' ? 'selected' : '' }}>Hembra</option>
                        </select>
                    </div>
                    <div class="col-md-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Buscar y filtrar</button>
                        <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">Limpiar</a>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h4 mb-0">Mis mascotas</h2>
                    </div>
                    <div class="card-body">
                        @if($mi_pets->isEmpty())
                            <p class="mb-0">No tienes mascotas registradas.</p>
                        @else
                            @foreach($mi_pets as $mascota)
                                <div class="border rounded p-3 mb-3 d-flex align-items-start gap-3">
                                    <img
                                        src="{{ $mascota->foto ? asset('storage/' . $mascota->foto) : asset('images/veterinaria.png') }}"
                                        alt="Foto de {{ $mascota->nombre }}"
                                        width="80"
                                        height="80"
                                        class="rounded object-fit-cover flex-shrink-0"
                                    >
                                    <div class="min-w-0">
                                        <h3 class="h5 text-break mb-2">{{ $mascota->nombre }}</h3>
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="text-secondary"><strong>Raza:</strong> {{ $mascota->raza?->nombre ?? 'No especificada' }}</span>
                                            <span class="text-secondary"><strong>Sexo:</strong> {{ $mascota->sexo ?? 'No especificado' }}</span>
                                            <span class="text-secondary"><strong>Especie:</strong> {{ $mascota->especie?->nombre ?? 'No especificada' }}</span>
                                            <span class="text-secondary"><strong>Peso:</strong> {{ $mascota->peso !== null ? number_format((float) $mascota->peso, 2) : 'No especificado' }}</span>
                                            <span class="text-secondary"><strong>Nombre:</strong> {{ $mascota->usuario?->name ?? 'No especificado' }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            @if(auth()->user()->role_id == 2 or auth()->user()->role_id == 3)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h4 mb-0">Otras mascotas</h2>
                        </div>
                        <div class="card-body">
                            @if($mascotas->isEmpty())
                                <p class="mb-0">No hay otras mascotas registradas.</p>
                            @else
                                @foreach($mascotas as $mascota)
                                    <div class="border rounded p-3 mb-3">
                                        <div class="d-flex align-items-start gap-3 mb-3">
                                            <img
                                                src="{{ $mascota->foto ? asset('storage/' . $mascota->foto) : asset('images/veterinaria.png') }}"
                                                alt="Foto de {{ $mascota->nombre }}"
                                                width="80"
                                                height="80"
                                                class="rounded object-fit-cover flex-shrink-0"
                                            >
                                            <div class="min-w-0">
                                                <h3 class="h5 text-break mb-2">{{ $mascota->nombre }}</h3>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <span class="text-secondary"><strong>Raza:</strong> {{ $mascota->raza?->nombre ?? 'No especificada' }}</span>
                                                    <span class="text-secondary"><strong>Sexo:</strong> {{ $mascota->sexo ?? 'No especificado' }}</span>
                                                    <span class="text-secondary"><strong>Especie:</strong> {{ $mascota->especie?->nombre ?? 'No especificada' }}</span>
                                                    <span class="text-secondary"><strong>Peso:</strong> {{ $mascota->peso !== null ? number_format((float) $mascota->peso, 2) : 'No especificado' }}</span>
                                                    <span class="text-secondary"><strong>Nombre:</strong> {{ $mascota->usuario?->name ?? 'No especificado' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('mascotas.edit', $mascota->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST" class="d-inline form-eliminar-mascota">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.querySelectorAll('.form-eliminar-mascota').forEach((formulario) => {
            formulario.addEventListener('submit', (evento) => {
                if (!confirm('¿Estás seguro de que deseas eliminar esta mascota?')) {
                    evento.preventDefault();
                }
            });
        });
    </script>
@endsection
