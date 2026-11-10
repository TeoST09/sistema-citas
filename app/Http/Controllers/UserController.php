<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function editSettings()
    {
        $usuario = auth()->user();

        return view('auth.settings', compact('usuario'));
    }

    public function updateSettings(Request $request)
    {
        $usuario = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'current_password' => ['required_with:password', 'current_password'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $usuario->name = $validated['name'];
        $usuario->phone = $validated['phone'] ?? null;

        if (!empty($validated['password'])) {
            $usuario->password = $validated['password'];
        }

        $usuario->save();

        return redirect()->route('settings')->with('success', 'Tu cuenta se actualizó correctamente.');
    }

    public function comprobar(){
       return auth()->user()->role_id;
    }

    public function index(Request $request){

        if ($this->comprobar() != 3) {
            return view('dashboard');
        }

        $validated = $request->validate([
            'buscar' => ['nullable', 'string', 'max:255'],
        ]);

        $busqueda = User::query();

        if (!empty($validated['buscar'])) {
            $termino = $validated['buscar'];
            $busqueda->where(function ($query) use ($termino) {
                $query->where('name', 'like', '%'.$termino.'%');
            });
        }

        $usuarios = $busqueda->orderBy('name')->get();
        $buscar = $validated['buscar'] ?? '';

        $roles = DB::table('roles')->pluck('nombre', 'id');

        return view('usuarios.index', compact('usuarios', 'roles', 'buscar'));
    }

    public function create(){
        if ($this->comprobar() != 3) {
            return view('dashboard');
        }

        $roles = DB::table('roles')->pluck('nombre', 'id');
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {

        if ($this->comprobar() != 3) {
            return view('dashboard');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $usuario = new User();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->phone = $request->input('phone');
        $usuario->password = $request->input('password');
        $usuario->role_id = $request->input('role_id');
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario agregado exitosamente.');
    }

    public function edit($id){
        if ($this->comprobar() != 3) {
            return view('dashboard');
        }

        $usuario = User::findOrFail($id);
        $roles = DB::table('roles')->pluck('nombre', 'id');

        return view('usuarios.edit', compact('usuario', 'roles')); 
    }

    public function update(Request $request, $id)
    {
        if ($this->comprobar() != 3) {
            return view('dashboard');
        }

        $usuario = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$usuario->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $usuario->name = $validated['name'];
        $usuario->email = $validated['email'];
        $usuario->phone = $validated['phone'] ?? null;
        $usuario->role_id = $validated['role_id'];

        if (!empty($validated['password'])) {
            $usuario->password = $validated['password'];
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id){

        if ($this->comprobar() != 3) {
            return view('dashboard');
        }

        $usuario = User::find($id);
        if (!$usuario) {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }

        $tieneMascotas = DB::table('mascotas')->where('user_id', $usuario->id)->exists();
        $tieneReservas = DB::table('reservas')
            ->where('user_id', $usuario->id)
            ->orWhere('veterinario_id', $usuario->id)
            ->exists();

        if ($tieneMascotas || $tieneReservas) {
            return redirect()->route('usuarios.index')->with(
                'error',
                'No se puede eliminar este usuario porque tiene mascotas o reservas asociadas.'
            );
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

}
