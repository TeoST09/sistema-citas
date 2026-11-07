@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            @if (session('success'))
                <x-alert type="success" title="Registro exitoso." class="mb-3">
                    {{ session('success') }}
                </x-alert>
            @endif

            @if (session('error'))
                <x-alert type="danger" title="No se pudo iniciar sesión." class="mb-3">
                    {{ session('error') }}
                </x-alert>
            @endif

            <div class="card">
                <div class="card-body">
                    <h1 class="h2 text-center mb-2">Iniciar sesión</h1>
                    <p class="text-secondary text-center mb-4">Ingresa con tu correo y contraseña.</p>

                    <form method="POST" action="{{ url('/logueado') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
                                autofocus
                            >
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                autocomplete="current-password"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                    </form>

                    <p class="text-center text-secondary mt-4 mb-0">
                        ¿No tienes una cuenta? <a href="{{ url('/register') }}">Regístrate</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
