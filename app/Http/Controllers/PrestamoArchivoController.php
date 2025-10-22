<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestamoArchivo;

class PrestamoArchivoController extends Controller
{
    // Mostrar todos los préstamos
    public function index()
    {
        $prestamos = PrestamoArchivo::with('financiera')->latest()->get();
        return view('prestamos.index', compact('prestamos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'financiera_id' => 'required|exists:financieras,id',
            'solicitante' => 'required|string|max:255',
            'cargo_departamento' => 'nullable|string|max:255',
            'fecha_prestamo' => 'required|date',
            'motivo_prestamo' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        PrestamoArchivo::create($request->only(
            'financiera_id',
            'solicitante',
            'cargo_departamento',
            'fecha_prestamo',
            'motivo_prestamo',
            'observaciones'
        ));

        return redirect()->back()->with('success', 'Préstamo registrado correctamente.');
    }

    // Marcar un archivo como devuelto
    public function devolver(PrestamoArchivo $prestamo)
    {
        $prestamo->update(['fecha_devolucion' => now()]);
        return redirect()->back()->with('success', 'Archivo devuelto correctamente.');
    }
}
