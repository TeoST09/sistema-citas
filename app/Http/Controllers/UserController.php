<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {
        $usuario = auth()->user();

        return view('auth.settings', compact('usuario'));
    }

    public function update(Request $request)
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
}
