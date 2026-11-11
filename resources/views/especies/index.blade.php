
@extends('layouts.app')

@section('title', 'Especies')

@section('content')
    <div class="container-xl">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h1 class="mb-1">Especies</h1>
                <p class="text-secondary mb-0">Consulta y administra las especies registradas.</p>
            </div>
            <a href="{{ route('especies.create') }}" class="btn btn-primary">Agregar especie</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Especies registradas</h2>
                <div class="card-actions text-secondary">
                    {{ $especies->count() }} {{ $especies->count() === 1 ? 'especie' : 'especies' }}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th class="w-1">#</th>
                            <th>Nombre</th>
                            <th class="w-1">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($especies as $especie)
                            <tr>
                                <td class="text-secondary">{{ $especie->id }}</td>
                                <td>{{ $especie->nombre }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="{{ route('especies.edit', $especie->id) }}" class="btn btn-outline-primary btn-sm">
                                            Editar
                                        </a>
                                        <form
                                            action="{{ route('especies.destroy', $especie->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Eliminar esta especie?')"
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
                                <td colspan="3" class="text-center text-secondary py-4">
                                    No hay especies registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
