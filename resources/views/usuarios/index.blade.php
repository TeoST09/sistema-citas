@extends('layouts.app')

@section('title', 'Usuarios | PawlinaPet')

@section('content')
    <div class="container-xl">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="mb-1">Usuarios</h1>
                <p class="text-secondary mb-0">Administra las cuentas registradas.</p>
            </div>
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Agregar usuario</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Todos los usuarios</h2>
                <div class="card-actions text-secondary">{{ $usuarios->count() }} usuarios</div>
            </div>
            <div class="card-body border-bottom py-3">
                <form action="{{ route('usuarios.index') }}" method="GET" class="d-flex gap-2">
                    <input
                        type="search"
                        name="buscar"
                        class="form-control"
                        value="{{ $buscar }}"
                        placeholder="Buscar por nombre, correo o teléfono"
                        aria-label="Buscar usuarios"
                    >
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    @if($buscar)
                        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                    @endif
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th class="w-1">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->phone ?: '—' }}</td>
                                <td>{{ $roles[$usuario->role_id] ?? 'Sin rol' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-4">Todavía no hay usuarios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
