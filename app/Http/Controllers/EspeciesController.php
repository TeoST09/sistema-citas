<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especies;
use App\Models\Mascotas;
use App\Models\Razas;

class EspeciesController extends Controller
{
    public function index(){
        $especies = Especies::all();
        return view('especies.index', compact('especies'));
    }

    public function create(){
        return view('especies.create');
    }

    public function store(Request $request){
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:especies,nombre'],
        ]);

        $especie = new Especies;
        $especie->nombre = $datos['nombre'];
        $especie->save();

        return redirect()->route('especies.index')
            ->with('success', 'Especie agregada exitosamente.');
    }

    public function edit($id){
        $especie = Especies::findOrFail($id);
        return view('especies.edit', compact('especie'));
    }

    public function update(Request $request, $id){
        $especie = Especies::findOrFail($id);

        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:especies,nombre,' . $especie->id],
        ]);

        $especie->nombre = $datos['nombre'];
        $especie->save();

        return redirect()->route('especies.index')
            ->with('success', 'Especie actualizada exitosamente.');
    }

    public function destroy($id){
        $especie = Especies::findOrFail($id);

        $tieneRazas = Razas::where('especie_id', $especie->id)->exists();
        $tieneMascotas = Mascotas::where('especie_id', $especie->id)->exists();

        if ($tieneRazas || $tieneMascotas) {
            return redirect()->route('especies.index')
                ->with('error', 'No se puede eliminar esta especie porque tiene razas o mascotas asociadas.');
        }

        $especie->delete();

        return redirect()->route('especies.index')
            ->with('success', 'Especie eliminada exitosamente.');
    }
}
