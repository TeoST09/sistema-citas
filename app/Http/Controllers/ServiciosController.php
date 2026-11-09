<?php

namespace App\Http\Controllers;

use App\Models\Servicios;

class ServiciosController extends Controller
{
    public function index()
    {
        $servicios = Servicios::where('is_active', true)->get();

        return view('servicios.index', compact('servicios'));
    }
}
