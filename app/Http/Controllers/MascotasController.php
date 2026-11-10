<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use App\Models\User;
use App\Models\Especies;
use App\Models\Razas;
use Illuminate\Http\Request;

class MascotasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $validated = $request->validate([
        'buscar' => ['nullable', 'string', 'max:255'],
        'raza_id' => ['nullable', 'integer', 'exists:razas,id'],
        'especie_id' => ['nullable', 'integer', 'exists:especies,id'],
        'sexo' => ['nullable', 'in:Macho,Hembra'],
    ]);

    $consulta = Mascotas::with(['raza', 'especie', 'usuario']);

    if (!empty($validated['buscar'])) {
        $consulta->where(function ($query) {
            $query->where('nombre', 'like', '%'.request('buscar').'%')
                ->orWhereHas('usuario', function ($query) {
                    $query->where('name', 'like', '%'.request('buscar').'%');
                });
        });
    }

    if (!empty($validated['raza_id'])) {
        $consulta->where('raza_id', $validated['raza_id']);
    }

    if (!empty($validated['especie_id'])) {
        $consulta->where('especie_id', $validated['especie_id']);
    }

    if (!empty($validated['sexo'])) {
        $consulta->where('sexo', $validated['sexo']);
    }

    $mascotas = $consulta->get();
    $mi_pets = $mascotas->where('user_id', auth()->id());
    $usuarios = User::where('role_id', 1)->get();
    $razas = Razas::orderBy('nombre')->get();
    $especies = Especies::orderBy('nombre')->get();

    return view('mascotas.index', compact('mascotas', 'mi_pets', 'usuarios', 'razas', 'especies'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = User::where('role_id', 1)->get();
        $especie = Especies::all();
        $raza = Razas::all();
        return view('mascotas.create', compact('usuario', 'especie', 'raza'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|max:20',
            'peso' => 'required|decimal:2|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required|integer|exists:users,id',
            'especie_id' => 'required|integer|exists:especies,id',
            'raza_id' => 'nullable|integer|exists:razas,id',
        ]);



        $mascota = new Mascotas();
        $mascota->nombre = $request->input('nombre');
        $mascota->fecha_nacimiento = $request->input('fecha_nacimiento');
        $mascota->sexo = $request->input('sexo');
        $mascota->peso = $request->input('peso');
        $mascota->foto = $request->file('foto') ? $request->file('foto')->store('mascotas', 'public') : null;
        $mascota->user_id = $request->input('user_id');
        $mascota->especie_id = $request->input('especie_id');
        $mascota->raza_id = $request->input('raza_id') ?? null;
        $mascota->save();

        return redirect()->route('mascotas.index')->with('success', 'Mascota agregada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mascota = Mascotas::findOrFail($id);
        $especie = Especies::find($mascota->especie_id);
        $raza = Razas::find($mascota->raza_id);
        $user= User::find($mascota->user_id);

        return view('mascotas.show', compact('mascota', 'especie', 'raza', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $mascota = Mascotas::findOrFail($id);
    
        $usuario = User::where('role_id', 1)->get();
        $especie = Especies::all();
        $raza = Razas::all();

        return view('mascotas.edit', compact('mascota', 'usuario', 'especie', 'raza'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|max:20',
            'peso' => 'required|decimal:2|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required|integer|exists:users,id',
            'especie_id' => 'required|integer|exists:especies,id',
            'raza_id' => 'nullable|integer|exists:razas,id',
        ]);

        $mascota = Mascotas::findOrFail($id);

        $mascota->nombre = $request->input('nombre');
        $mascota->fecha_nacimiento = $request->input('fecha_nacimiento');
        $mascota->sexo = $request->input('sexo');
        $mascota->peso = $request->input('peso');
        $mascota->user_id = $request->input('user_id');
        $mascota->especie_id = $request->input('especie_id');
        $mascota->raza_id = $request->input('raza_id') ?? null;

        if($request->hasFile('foto')) {
            $mascota->foto = $request->file('foto')->store('mascotas', 'public');
        }

        $mascota->save();

        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $eliminar = Mascotas::where('id', $id)->first();
        if ($eliminar) {
            $eliminar->delete();
            return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada exitosamente.');
        } else {
            return redirect()->route('mascotas.index')->with('error', 'Mascota no encontrada.');
        }
    }
}
