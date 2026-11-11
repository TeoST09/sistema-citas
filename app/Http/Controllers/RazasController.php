<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Especies;
use App\Models\Mascotas;
use App\Models\Razas;

class RazasController extends Controller
{
    public function index(){
        $razas = Razas::with('especie')->get();
        return view('razas.index', compact('razas'));
    }

    public function create(){
        $especies = Especies::all();
        return view('razas.create', compact('especies'));
    }

    public function store(Request $request){
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('razas')->where('especie_id', $request->input('especie_id')),
            ],
            'especie_id' => ['required', 'exists:especies,id'],
        ]);

        $raza = new Razas;
        $raza->nombre = $datos['nombre'];
        $raza->especie_id = $datos['especie_id'];
        $raza->save();

        return redirect()->route('razas.index')
            ->with('success', 'Raza agregada exitosamente.');
    }

    public function edit($id){
        $raza = Razas::findOrFail($id);
        $especies = Especies::all();

        return view('razas.edit', compact('raza', 'especies'));
    }

    public function update(Request $request, $id){
        $raza = Razas::findOrFail($id);

        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('razas')
                    ->where('especie_id', $request->input('especie_id'))
                    ->ignore($raza->id),
            ],
            'especie_id' => ['required', 'exists:especies,id'],
        ]);

        $raza->nombre = $datos['nombre'];
        $raza->especie_id = $datos['especie_id'];
        $raza->save();

        return redirect()->route('razas.index')
            ->with('success', 'Raza actualizada exitosamente.');
    }

    public function destroy($id){
        $raza = Razas::findOrFail($id);

        if (Mascotas::where('raza_id', $raza->id)->exists()) {
            return redirect()->route('razas.index')
                ->with('error', 'No se puede eliminar esta raza porque tiene mascotas asociadas.');
        }

        $raza->delete();

        return redirect()->route('razas.index')
            ->with('success', 'Raza eliminada exitosamente.');
    }
}
