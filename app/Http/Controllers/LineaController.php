<?php

namespace App\Http\Controllers;

use App\Models\Linea;
use Illuminate\Http\Request;

class LineaController extends Controller
{
    public function index()
    {
        $lineas = Linea::all();
        return view('admin.lineas.index', compact('lineas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:lineas',
            'descuento' => 'required',
            'activa' => 'boolean',
        ]);

        Linea::create($request->all());

        return redirect()->route('admin.lineas.index')
                         ->with('success', 'Línea creada correctamente');
    }

    public function update(Request $request, Linea $linea)
    {
        $request->validate([
            'nombre' => 'required|unique:lineas,nombre,' . $linea->id,
            'descuento' => 'required',
            'activa' => 'boolean',
        ]);

        $linea->update($request->all());

        return redirect()->route('admin.lineas.index')
                         ->with('success', 'Línea actualizada correctamente');
    }

    public function destroy(Linea $linea)
    {
        $linea->delete();
        return redirect()->route('admin.lineas.index')
                         ->with('success', 'Línea eliminada correctamente');
    }
}