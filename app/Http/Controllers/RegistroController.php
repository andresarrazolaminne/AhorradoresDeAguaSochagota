<?php

namespace App\Http\Controllers;

use App\Models\RegistroInteres;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'regex:/^[0-9]{6,10}$/'],
            'email' => ['required', 'email', 'max:255'],
            'household_size' => ['nullable', 'integer', 'min:1', 'max:30'],
            'age_range' => ['nullable', 'in:ninos_jovenes,adultos,adultos_mayores'],
        ]);

        RegistroInteres::create($validated);

        return redirect()->route('registro.expectativa')->with('status', '¡Gracias! Recibimos tu intención de participación. Pronto te contactaremos.');
    }
}
