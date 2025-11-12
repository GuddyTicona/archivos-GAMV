<?php

namespace App\Http\Controllers;

use App\Models\PrestamoArchivocentral;
use App\Models\Archivo;
use Illuminate\Http\Request;

class PrestamoArchivocentralController extends Controller
{
    // Listado de préstamos
    public function index()
    {
        $prestamos = PrestamoArchivocentral::with('archivo')->paginate(10);
        return view('prestamo_central.index', compact('prestamos')); // Vista index de prestamo_central
    }

    // Formulario para crear préstamo
    public function create($archivo_id = null)
    {
        $archivo = null;
        if ($archivo_id) {
            $archivo = Archivo::find($archivo_id);
        }

        return view('prestamo_central.create', compact('archivo'));
    }

    // Guardar préstamo
    public function store(Request $request)
    {
        $request->validate([
            'archivo_id' => 'required|exists:archivos,id',
            'solicitante' => 'required|string|max:255',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'cargo_departamento' => 'nullable|string|max:255',
            'motivo_prestamo' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        PrestamoArchivocentral::create($request->all());

        return redirect()->route('prestamo_central.index')
            ->with('mensaje', 'Préstamo registrado correctamente.');
    }

    // Mostrar detalle de préstamo
    public function show(PrestamoArchivocentral $prestamo)
    {
        return view('prestamo_central.show', compact('prestamo'));
    }

    // Formulario para editar préstamo
    public function edit(PrestamoArchivocentral $prestamo)
    {
        $archivos = Archivo::pluck('codigo_archivo', 'id');
        return view('prestamo_central.edit', compact('prestamo', 'archivos'));
    }

    // Actualizar préstamo
    public function update(Request $request, PrestamoArchivocentral $prestamo)
    {
        $request->validate([
            'solicitante' => 'required|string|max:255',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'cargo_departamento' => 'nullable|string|max:255',
            'motivo_prestamo' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $prestamo->update($request->all());

        return redirect()->route('prestamo_central.index')
            ->with('mensaje', 'Préstamo actualizado correctamente.');
    }

    // Eliminar préstamo
    public function destroy(PrestamoArchivocentral $prestamo)
    {
        $prestamo->delete();
        return redirect()->route('prestamo_central.index')
            ->with('mensaje', 'Préstamo eliminado correctamente.');
    }

    // Marcar préstamo como devuelto
    public function devolver(PrestamoArchivocentral $prestamo)
    {
        $prestamo->fecha_devolucion = now();
        $prestamo->save();

        return redirect()->route('prestamo_central.index')
            ->with('mensaje', 'Préstamo marcado como devuelto.');
    }
}
