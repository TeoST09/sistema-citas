<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use App\Models\Reservas;
use App\Models\Servicios;
use App\Models\User;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function index(Request $request)
    {
        $usuario = auth()->user();
        $esAdmin = (int) $usuario->role_id >= 2;

        $todas = Reservas::all();
        
        $validated = $request->validate([
            'estado' => ['nullable', 'in:confirmada,pendiente,cancelada'],
        ]);


        $estado = Reservas::query();

        if (!empty($validated['estado'])) {
            $estado->where('estado', $validated['estado']);
        }

        $todas = $estado->get();

        $consulta = Reservas::with(['usuario', 'mascota', 'veterinario', 'servicio'])
            ->orderByDesc('fecha')
            ->orderByDesc('hora_inicio');

        if (!$esAdmin) {
            $consulta->where('user_id', $usuario->id);
        }

        $reservas_user = $consulta->get();

        return view('reservas.index', compact('reservas_user', 'esAdmin', 'todas'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'servicio_id' => ['required', 'integer', 'exists:servicios,id'],
        ]);

        $servicio = Servicios::where('is_active', true)
            ->findOrFail($validated['servicio_id']);
        $mascotas = Mascotas::where('user_id', $request->user()->id)
            ->orderBy('nombre')
            ->get();
        $veterinarios = User::where('role_id', 2)
            ->orderBy('name')
            ->get();

        return view('reservas.create', compact('servicio', 'mascotas', 'veterinarios'));
    }

    public function edit($id)
    {
        $reserva = Reservas::findOrFail($id);
        $esAdmin = (int) auth()->user()->role_id >= 2;

        if (!$esAdmin && (int) $reserva->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$esAdmin && strtolower($reserva->estado) === 'confirmada') {
            abort(403);
        }

        if ($esAdmin) {
            $mascotas = Mascotas::all();
        } else {
            $mascotas = Mascotas::where('user_id', auth()->id())->get();
        }

        $servicios = Servicios::all();
        $veterinarios = User::where('role_id', 2)
            ->orderBy('name')
            ->get();

        return view('reservas.edit', compact('servicios', 'mascotas', 'veterinarios', 'reserva', 'esAdmin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|integer|exists:mascotas,id,user_id,'.auth()->id(),
            'veterinario_id' => 'required|integer|exists:users,id,role_id,2',
            'servicio_id' => 'required|integer|exists:servicios,id,is_active,1',
            'fecha' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|date_format:H:i',
        ]);

        $servicio = Servicios::findOrFail($request->input('servicio_id'));
        $horaFin = date(
            'H:i:s',
            strtotime($request->input('hora_inicio').' + '.$servicio->duracion_minutos.' minutes')
        );

        $reserva = new Reservas();
        $reserva->user_id = auth()->id();
        $reserva->mascota_id = $request->input('mascota_id');
        $reserva->veterinario_id = $request->input('veterinario_id');
        $reserva->servicio_id = $servicio->id;
        $reserva->fecha = $request->input('fecha');
        $reserva->hora_inicio = $request->input('hora_inicio');
        $reserva->hora_fin = $horaFin;
        $reserva->precio = $servicio->precio;
        $reserva->estado = 'pendiente';
        $reserva->save();

        return redirect()->route('reservas.index')->with('success', 'Reserva agendada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $reserva = Reservas::findOrFail($id);
        $esAdmin = (int) auth()->user()->role_id >= 2;

        if (!$esAdmin && (int) $reserva->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$esAdmin && strtolower($reserva->estado) === 'confirmada') {
            abort(403);
        }

        $request->validate([
            'mascota_id' => 'required|integer|exists:mascotas,id,user_id,'.$reserva->user_id,
            'veterinario_id' => 'required|integer|exists:users,id,role_id,2',
            'servicio_id' => 'required|integer|exists:servicios,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|date_format:H:i',
            'estado' => $esAdmin ? 'required|in:pendiente,confirmada,cancelada' : 'prohibited',
        ]);

        $servicio = Servicios::findOrFail($request->input('servicio_id'));
        $horaFin = date(
            'H:i:s',
            strtotime($request->input('hora_inicio').' + '.$servicio->duracion_minutos.' minutes')
        );

        $reserva->mascota_id = $request->input('mascota_id');
        $reserva->veterinario_id = $request->input('veterinario_id');
        $reserva->servicio_id = $servicio->id;
        $reserva->fecha = $request->input('fecha');
        $reserva->hora_inicio = $request->input('hora_inicio');
        $reserva->hora_fin = $horaFin;
        $reserva->precio = $servicio->precio;

        if ($esAdmin) {
            $reserva->estado = $request->input('estado');
        }

        $reserva->save();

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada exitosamente.');
    }

    public function destroy($id){
        $eliminar = Reservas::where('id', $id)->first();
        if ($eliminar) {
            $eliminar->delete();
            return redirect()->route('reservas.index')->with('success', 'Servicio eliminada exitosamente.');
        } else {
            return redirect()->route('reservas.index')->with('error', 'Servicio no encontrada.');
        }
    }
}
