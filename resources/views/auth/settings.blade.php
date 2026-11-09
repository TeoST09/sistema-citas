@extends('layouts.app')

@section('title', 'Configuración | PawlinaPet')

@section('content')
    @php
        $rol = match ((int) $usuario->role_id) {
            3 => 'Administrador',
            2 => 'Veterinario',
            default => 'Usuario',
        };
    @endphp

    <div class="container-xl">
        <div class="mb-4">
            <h1 class="mb-1">Configuración</h1>
            <p class="text-secondary mb-0">Actualiza tu nombre, teléfono y contraseña.</p>
        </div>

        <div class="row row-cards">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Mi cuenta</h2>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <img src="{{ asset('images/veterinaria.png') }}" alt="Imagen de perfil" class="avatar avatar-lg" style="object-fit: cover;">
                            <div>
                                <h3 class="h2 mb-1">{{ $usuario->name }}</h3>
                                <span class="text-secondary">{{ $rol }}</span>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('settings.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $usuario->name) }}"
                                    autocomplete="name"
                                    required
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" id="email" class="form-control" value="{{ $usuario->email }}" disabled>
                                <small class="form-hint">El correo no se puede cambiar desde esta pantalla.</small>
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $usuario->phone) }}"
                                    autocomplete="tel"
                                >
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <h3 class="h3 mb-1">Cambiar contraseña</h3>
                            <p class="text-secondary">Déjala vacía si no quieres cambiarla.</p>

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Contraseña actual</label>
                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    autocomplete="current-password"
                                >
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva contraseña</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    autocomplete="new-password"
                                >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    autocomplete="new-password"
                                >
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
