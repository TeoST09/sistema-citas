@extends('layouts.app')

@section('title', 'Inicio | PawlinaPet')

@section('content')
    @php
        $usuario = auth()->user();
        $esAdmin = (int) $usuario->role_id === 3;
        $esVeterinario = (int) $usuario->role_id === 2;
    @endphp

    <div class="container-xl">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col">
                        <span class="badge bg-primary-lt mb-3">
                            {{ $esAdmin ? 'Administración' : ($esVeterinario ? 'Veterinaria' : 'Tu espacio para mascotas') }}
                        </span>
                        <h1 class="display-6 fw-bold mb-2">¡Hola, {{ $usuario->name }}!</h1>
                        <p class="text-secondary mb-4">
                            {{ $esAdmin
                                ? 'Administra las citas, servicios y mascotas desde un solo lugar.'
                                : ($esVeterinario
                                    ? 'Consulta las citas y la información de las mascotas.'
                                    : 'Organiza el cuidado de tus mascotas de forma fácil y rápida.') }}
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('servicios.index') }}" class="btn btn-primary">Agendar un servicio</a>
                            <a href="{{ route('reservas.index') }}" class="btn btn-outline-primary">Ver reservas</a>
                        </div>
                    </div>
                    <div class="col-auto d-none d-md-block">
                        <img src="{{ asset('images/veterinaria.png') }}" alt="PawlinaPet" width="180" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <h2 class="h3 mb-1">Accesos rápidos</h2>
            <p class="text-secondary mb-0">Elige qué quieres hacer.</p>
        </div>

        <div class="row row-cards">
            <div class="col-sm-6 col-lg-4">
                <a href="{{ route('mascotas.index') }}" class="card card-link card-link-rotate h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="avatar bg-green-lt">🐾</span>
                            <h3 class="card-title mb-0">Mascotas</h3>
                        </div>
                        <p class="text-secondary mb-0">Consulta la información de tus mascotas.</p>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-lg-4">
                <a href="{{ route('servicios.index') }}" class="card card-link card-link-rotate h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="avatar bg-azure-lt">🩺</span>
                            <h3 class="card-title mb-0">Servicios</h3>
                        </div>
                        <p class="text-secondary mb-0">Explora los servicios y agenda una cita.</p>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-lg-4">
                <a href="{{ route('reservas.index') }}" class="card card-link card-link-rotate h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="avatar bg-yellow-lt">📅</span>
                            <h3 class="card-title mb-0">Reservas</h3>
                        </div>
                        <p class="text-secondary mb-0">Revisa el estado y horario de tus citas.</p>
                    </div>
                </a>
            </div>

            @if($esAdmin || $esVeterinario)
                <div class="col-sm-6 col-lg-4">
                    <a href="{{ route('servicios_admin.index') }}" class="card card-link card-link-rotate h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="avatar bg-purple-lt">⚙️</span>
                                <h3 class="card-title mb-0">Administrar servicios</h3>
                            </div>
                            <p class="text-secondary mb-0">Gestiona el catálogo de servicios veterinarios.</p>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
