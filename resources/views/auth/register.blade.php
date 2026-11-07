@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            @if ($errors->any())
                <x-alert type="danger" title="Revisa los datos del formulario." class="mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert>
            @endif

            <div class="card">
                <div class="card-body">
                    <h1 class="h2 text-center mb-2">Crear cuenta</h1>
                    <p class="text-secondary text-center mb-4">Completa tus datos para registrarte.</p>

                    <form method="POST" action="{{ url('/register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre completo</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                autocomplete="name"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono <span class="text-secondary"></span></label>
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone') }}"
                                autocomplete="tel"
                            >
                        </div>

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
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                autocomplete="new-password"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                autocomplete="new-password"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Crear cuenta</button>
                    </form>

                    <p class="text-center text-secondary mt-4 mb-0">
                        ¿Ya tienes una cuenta? <a href="{{ url('/login') }}">Inicia sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
