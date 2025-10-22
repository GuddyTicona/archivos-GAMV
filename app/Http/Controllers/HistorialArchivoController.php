<?php

namespace App\Http\Controllers;

use App\Models\HistorialArchivo;
use App\Models\Archivo;
use App\Models\Financiera;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class HistorialArchivoController extends Controller
{
    public function index(Request $request): View
    {
        $historialArchivos = HistorialArchivo::paginate();

        return view('historial-archivo.index', compact('historialArchivos'))
            ->with('i', ($request->input('page', 1) - 1) * $historialArchivos->perPage());
    }

    public function create(): View
    {
        $historialArchivo = new HistorialArchivo();
        $archivos = Archivo::pluck('codigo_archivo', 'id');
        $usuarios = User::pluck('name', 'id');
        $financieras = Financiera::pluck('entidad', 'id');

        return view('historial-archivo.create', compact('historialArchivo', 'archivos', 'usuarios', 'financieras'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'archivo_id'     => 'required|exists:archivos,id',
            'user_id'        => 'required|exists:users,id',
            'tipo_evento'    => 'required|string|max:255',
            'observaciones'  => 'nullable|string|max:255',
            'id_financiera'  => 'required|exists:financieras,id',
            'fecha'          => 'required|date',
        ]);

        HistorialArchivo::create($validated);

        return Redirect::route('historial-archivos.index')
            ->with('mensaje', 'HistorialArchivo creado correctamente.');
    }

    public function show($id): View
    {
        $historialArchivo = HistorialArchivo::findOrFail($id);
        return view('historial-archivo.show', compact('historialArchivo'));
    }

    public function edit($id): View
    {
        $historialArchivo = HistorialArchivo::findOrFail($id);
        $archivos = Archivo::pluck('codigo_archivo', 'id');
        $usuarios = User::pluck('name', 'id');
        $financieras = Financiera::pluck('entidad', 'id');

        return view('historial-archivo.edit', compact('historialArchivo', 'archivos', 'usuarios', 'financieras'));
    }

    public function update(Request $request, HistorialArchivo $historialArchivo): RedirectResponse
    {
        $validated = $request->validate([
            'archivo_id'     => 'required|exists:archivos,id',
            'user_id'        => 'required|exists:users,id',
            'tipo_evento'    => 'required|string|max:255',
            'observaciones'  => 'nullable|string|max:255',
            'id_financiera'  => 'required|exists:financieras,id',
            'fecha'          => 'required|date',
        ]);

        $historialArchivo->update($validated);

        return Redirect::route('historial-archivos.index')
            ->with('mensaje', 'HistorialArchivo actualizado correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        HistorialArchivo::findOrFail($id)->delete();
        return Redirect::route('historial-archivos.index')->with('mensaje', 'HistorialArchivo eliminado correctamente.');
    }
}
