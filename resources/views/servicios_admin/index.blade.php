
@extends('layouts.app')

@section('title', 'Servicios Panel')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Panel de servicios</h1>
            <a href="{{ route('servicios_admin.create') }}" class="btn btn-primary">Agregar servicio</a>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="h4 mb-0">Servicios registrados</h2>
            </div>
            <div class="card-body">
                @forelse($servicios as $servicio)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex flex-wrap justify-content-between gap-3">
                            <div>
                                <h3 class="h5 mb-2">{{ $servicio->nombre }}</h3>
                                <p class="mb-2">{{ $servicio->descripcion ?: 'Sin descripción' }}</p>
                                <div class="d-flex flex-wrap gap-3 text-secondary">
                                    <span><strong>Precio:</strong> ${{ number_format((float) $servicio->precio, 2) }}</span>
                                    <span><strong>Duración:</strong> {{ $servicio->duracion_minutos }} minutos</span>
                                    <span><strong>Estado:</strong> {{ $servicio->is_active ? 'Activo' : 'Inactivo' }}</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-2">
                                <a href="{{ route('servicios_admin.edit', $servicio->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('servicios_admin.destroy', $servicio->id) }}" method="POST" class="form-eliminar-servicio">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="mb-0">No hay servicios registrados.</p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.form-eliminar-servicio').forEach((formulario) => {
            formulario.addEventListener('submit', (evento) => {
                if (!confirm('¿Estás seguro de que deseas eliminar este servicio?')) {
                    evento.preventDefault();
                }
            });
        });
    </script>
@endsection
