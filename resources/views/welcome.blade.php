
@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="container-xl">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center p-4 p-md-5">
                <img
                    src="{{ asset('images/veterinaria.png') }}"
                    alt="PawlinaPet"
                    class="img-fluid mb-4"
                    style="max-width: 220px;"
                >
                <h1 class="mb-3">Bienvenido a PawlinaPet</h1>
                <p class="lead text-secondary mb-0">
                
                </p>
            </div>
        </div>
    </div>
@endsection
