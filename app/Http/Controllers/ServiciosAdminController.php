<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;

class ServiciosAdminController extends Controller
{
    public function index()
    {
        $servicios = Servicios::all();

        return view('servicios_admin.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios_admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|decimal:0,2|min:0|max:99999999.99',
            'duracion_minutos' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        $servicio = new Servicios();
        $servicio->nombre = $request->input('nombre');
        $servicio->descripcion = $request->input('descripcion');
        $servicio->precio = $request->input('precio');
        $servicio->duracion_minutos = $request->input('duracion_minutos');
        $servicio->is_active = $request->input('is_active');
        $servicio->save();

        return redirect()->route('servicios_admin.index')->with('success', 'Servicio agregado exitosamente.');
    }

    public function edit($id)
    {
        $servicio = Servicios::findOrFail($id);

        return view('servicios_admin.edit', compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|decimal:0,2|min:0|max:99999999.99',
            'duracion_minutos' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        $servicio = Servicios::findOrFail($id);
        $servicio->nombre = $request->input('nombre');
        $servicio->descripcion = $request->input('descripcion');
        $servicio->precio = $request->input('precio');
        $servicio->duracion_minutos = $request->input('duracion_minutos');
        $servicio->is_active = $request->input('is_active');
        $servicio->save();

        return redirect()->route('servicios_admin.index')->with('success', 'Servicio actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $servicio = Servicios::findOrFail($id);
        $servicio->delete();

        return redirect()->route('servicios_admin.index')->with('success', 'Servicio eliminado exitosamente.');
    }
}
