@extends('layouts.app')

@section('title', 'Editar usuario | PawlinaPet')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Editar usuario</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $usuario->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $usuario->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $usuario->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Rol</label>
                        <select id="role_id" name="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                            <option value="1" {{ (string) old('role_id', $usuario->role_id) === '1' ? 'selected' : '' }}>Usuario</option>
                            <option value="2" {{ (string) old('role_id', $usuario->role_id) === '2' ? 'selected' : '' }}>Veterinario</option>
                            <option value="3" {{ (string) old('role_id', $usuario->role_id) === '3' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva contraseña <span class="text-secondary">(opcional)</span></label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
