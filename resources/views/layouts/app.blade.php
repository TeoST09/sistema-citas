
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>@yield('title', 'Pet')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="page">

        @auth
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                    </span>
                </button>
                <a href="{{ route('dashboard') }}" aria-label="PawlinaPet" class="navbar-brand navbar-brand-autodark me-3">
                    <img src="{{ asset('favicon.svg') }}" alt="PawlinaPet" height="32" class="navbar-brand-image">
                </a>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <span class="nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false" class="icon">
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Home
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mascotas.index') }}">
                                <span class="nav-link-icon">
                                    <span aria-hidden="true">🐾</span>
                                </span>
                                <span class="nav-link-title">Mascotas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false" class="icon">
                                        <path d="M9 11l3 3l8 -8" />
                                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Settings
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-nav flex-row order-md-last ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-image: url(/static/avatars/044m.jpg)">
                            </span>
                            <div class="d-none d-xl-block ps-2">
                                <div>
                                    {{ auth()->user()->name}}
                                </div>
                                <div class="mt-1 small text-secondary">
                                    @if(auth()->user()->role_id == 1)
                                        Usuario
                                    @elseif(auth()->user()->role_id == 3)
                                        Administrador
                                    @else
                                        Veterinario
                                    @endif
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="#" class="dropdown-item">
                                Status
                            </a>
                            <a href="#" class="dropdown-item">
                                Profile
                            </a>
                            <a href="#" class="dropdown-item">
                                Feedback
                            </a>
                            <div class="dropdown-divider">
                            </div>
                            <a href="#" class="dropdown-item">
                                Settings
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                @endauth
        </header>
        @guest
            <header class="navbar navbar-expand-md d-print-none">
                <div class="container-xl">
                    <a href="{{ url('/') }}" aria-label="PawlinaPet" class="navbar-brand navbar-brand-autodark">
                        <img src="{{ asset('favicon.svg') }}" alt="PawlinaPet" height="32" class="navbar-brand-image">
                    </a>
                    <div class="navbar-nav flex-row ms-auto gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                    </div>
                </div>
            </header>
        @endguest

        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl py-4">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>

</body>
</html>
