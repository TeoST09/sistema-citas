@extends('layouts.app')

@section('title', 'Razas')

@section('content')
    <div class="container-xl">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h1 class="mb-1">Razas</h1>
                <p class="text-secondary mb-0">Consulta y administra las razas registradas.</p>
            </div>
            <a href="{{ route('razas.create') }}" class="btn btn-primary">Agregar raza</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Razas registradas</h2>
                <div class="card-actions text-secondary">
                    {{ $razas->count() }} {{ $razas->count() === 1 ? 'raza' : 'razas' }}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th class="w-1">#</th>
                            <th>Raza</th>
                            <th>Especie</th>
                            <th class="w-1">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($razas as $raza)
                            <tr>
                                <td class="text-secondary">{{ $raza->id }}</td>
                                <td>{{ $raza->nombre }}</td>
                                <td>{{ $raza->especie?->nombre ?? 'Sin especie' }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="{{ route('razas.edit', $raza->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                        <form
                                            action="{{ route('razas.destroy', $raza->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Eliminar esta raza?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-secondary py-4">
                                    No hay razas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection