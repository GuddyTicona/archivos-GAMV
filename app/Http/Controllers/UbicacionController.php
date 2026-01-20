<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Models\Financiera;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $archivo = $request->input('archivo_id') 
            ? \App\Models\ArchivoFinanciero::find($request->input('archivo_id'))
            : null;

        $ubicaciones = Ubicacion::when($search, function ($query, $search) {
                $query->where('estante', 'like', "%{$search}%")
                      ->orWhere('fila', 'like', "%{$search}%")
                      ->orWhere('columna', 'like', "%{$search}%");
            })
            ->orderBy('estante')
            ->orderBy('fila')
            ->orderBy('columna')
            ->get();

        return view('ubicaciones.index', compact('ubicaciones', 'search', 'archivo'));
    }

   public function generar(Request $request)
{
    $request->validate([
        'estante' => 'required|string'
    ]);

    $estante = strtoupper($request->input('estante')); // toma el nombre del input
    $filas = 7;
    $columnas = 9;

    // verificar si ya existe ese estante
    if (Ubicacion::where('estante', $estante)->exists()) {
        return redirect()->route('ubicaciones.index')
            ->with('success', "El estante {$estante} ya existe.");
    }

    // crear ubicaciones del nuevo estante
    for ($fila = 1; $fila <= $filas; $fila++) {
        for ($columna = 1; $columna <= $columnas; $columna++) {
            Ubicacion::create([
                'estante' => $estante,
                'fila' => $fila,
                'columna' => $columna,
            ]);
        }
    }

    return redirect()->route('ubicaciones.index')
        ->with('success', "Estante {$estante} carpetas generado correctamente.");
}

        public function eliminarEstante($estante)
    {
        $cantidad = Ubicacion::where('estante', $estante)->count();

        if ($cantidad > 0) {
            Ubicacion::where('estante', $estante)->delete();
            return redirect()->route('ubicaciones.index')
                ->with('success', "Se eliminaron correctamente las ubicaciones {$estante} ({$cantidad} registros).");
        }

        return redirect()->route('ubicaciones.index')
            ->with('success', "No hay ubicaciones registradas en el estante {$estante}.");
    }

    //detalles de ubicaciones
public function verEstante($estante)
{
    $ubicaciones = Ubicacion::where('estante', $estante)
        ->with('financieras')
        ->orderBy('fila')
        ->orderBy('columna')
        ->paginate(10); // Cambiado de get() a paginate()

    if ($ubicaciones->isEmpty()) {
        return redirect()->route('ubicaciones.index')->with('error', 'El estante no existe.');
    }

    $maxFila = $ubicaciones->max('fila');
    $maxColumna = $ubicaciones->max('columna');

    return view('ubicaciones.show_estante', compact('estante', 'ubicaciones', 'maxFila', 'maxColumna'));
}
public function showEstante(Request $request, $estante)
{
    $search = $request->input('search');

    $ubicaciones = Ubicacion::with('financieras')
        ->where('estante', $estante)
        ->when($search, function($query, $search) {
            $query->where(function($q) use ($search) {
                
                $q->where('fila', 'like', "%{$search}%")
                  ->orWhere('columna', 'like', "%{$search}%")
                  ->orWhereHas('financieras', function($q2) use ($search) {
                      $q2->where('codigo', 'like', "%{$search}%");
                  })
              
                  ->orWhereRaw("CONCAT(estante, fila, '-', columna) LIKE ?", ["%{$search}%"]);
            });
        })
        ->orderBy('fila')
        ->orderBy('columna')
        ->paginate(10) 
        ->withQueryString(); 

    return view('ubicaciones.show_estante', compact('ubicaciones', 'estante'));
}

    public function create()
    {
        return view('ubicaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'estante' => 'required|string',
            'fila' => 'required|integer',
            'columna' => 'required|integer',
        ]);

        Ubicacion::create($request->all());
        return redirect()->route('ubicaciones.index')->with('success', 'Ubicación creada exitosamente.');
    }

    public function destroy($id)
    {
        Ubicacion::findOrFail($id)->delete();
        return redirect()->route('ubicaciones.index')->with('success', 'Ubicación eliminada correctamente.');
    }

    public function seleccionarEstante($archivoId)
{
    $archivo = Financiera::findOrFail($archivoId);
    $estantes = Ubicacion::select('estante')->distinct()->orderBy('estante')->get();

    return view('ubicaciones.seleccionar', compact('archivo', 'estantes'));
}

public function asignarUbicacion(Request $request, $archivoId)
{
    $request->validate([
        'estante' => 'required|string',
    ]);

    $archivo = Financiera::findOrFail($archivoId);

 
    $ubicacionLibre = Ubicacion::where('estante', $request->estante)
        ->whereDoesntHave('financieras') 
        ->first();

    if (!$ubicacionLibre) {
        return back()->with('error', 'No hay ubicaciones disponibles en este estante.');
    }


    $ubicacionLibre->financieras()->save($archivo);

    return redirect()->route('ubicaciones.index')
        ->with('success', 'El archivo se asignó correctamente al estante ' . $request->estante);
}

public function showRegistro($id)
{
    $financiera = Financiera::with(['preventivos', 'unidad', 'ubicacion'])
        ->findOrFail($id);

    return view('ubicaciones.show_registro', compact('financiera'));
}


}
