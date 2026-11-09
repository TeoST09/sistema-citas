@extends('layouts.app')

@section('title', 'Mis reservas')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $esAdmin ? 'Reservas' : 'Mis reservas' }}</h1>
            <a href="{{ route('servicios.index') }}" class="btn btn-primary">Ver servicios</a>
        </div>

        <div class="card">
            <div class="card-body">
                @if($esAdmin)
                    <h2 class="h4 mb-3">Panel de administración</h2>
                    <form action="{{ route('reservas.index') }}" method="GET" class="row g-2 mb-3">
                        <div class="col-auto">
                            <select name="estado" class="form-select" aria-label="Filtrar por estado">
                                <option value="">Todos los estados</option>
                                <option value="confirmada" {{ request('estado') === 'confirmada' ? 'selected' : '' }}>Confirmadas</option>
                                <option value="pendiente" {{ request('estado') === 'pendiente' ? 'selected' : '' }}>Pendientes</option>
                                <option value="cancelada" {{ request('estado') === 'cancelada' ? 'selected' : '' }}>Canceladas</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Servicio</th>
                                    <th>Mascota</th>
                                    <th>Veterinario</th>
                                    <th>Fecha</th>
                                    <th>Horario</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($todas as $reserva)
                                    <tr>
                                        <td>{{ $reserva->usuario->name }}</td>
                                        <td>{{ $reserva->servicio->nombre }}</td>
                                        <td>{{ $reserva->mascota->nombre }}</td>
                                        <td>{{ $reserva->veterinario->name }}</td>
                                        <td>{{ $reserva->fecha }}</td>
                                        <td>{{ substr($reserva->hora_inicio, 0, 5) }}–{{ substr($reserva->hora_fin, 0, 5) }}</td>
                                        <td>{{ ucfirst($reserva->estado) }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" class="form-eliminar-reserva">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No hay reservas registradas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    @forelse($reservas_user as $reserva)
                        <div class="border rounded p-3 mb-3">
                            <div class="d-flex flex-wrap justify-content-between gap-3">
                                <div>
                                    <h2 class="h5">{{ $reserva->servicio->nombre }} — {{ $reserva->mascota->nombre }}</h2>
                                    <p class="mb-1"><strong>Veterinario:</strong> {{ $reserva->veterinario->name }}</p>
                                    <p class="mb-1"><strong>Fecha:</strong> {{ $reserva->fecha }}</p>
                                    <p class="mb-1"><strong>Horario:</strong> {{ substr($reserva->hora_inicio, 0, 5) }}–{{ substr($reserva->hora_fin, 0, 5) }}</p>
                                    <p class="mb-0"><strong>Estado:</strong> {{ ucfirst($reserva->estado) }}</p>
                                </div>
                                @if(strtolower($reserva->estado) !== 'confirmada')
                                    <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-warning btn-sm align-self-start">Editar</a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="mb-0">Todavía no tienes reservas.</p>
                    @endforelse
                @endif
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.form-eliminar-reserva').forEach((formulario) => {
            formulario.addEventListener('submit', (evento) => {
                if (!confirm('¿Estás seguro de que deseas eliminar esta reserva?')) {
                    evento.preventDefault();
                }
            });
        });
    </script>
@endsection
