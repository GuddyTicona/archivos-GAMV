<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Area::create($request->all());

        return redirect()->route('areas.index')->with('mensaje', 'Área registrada correctamente.');
    }
public function show($id, Request $request)
{
    $area = Area::findOrFail($id);

    // Fecha más reciente de registros
    $ultimoRegistro = $area->financieras()->orderBy('fecha_envio', 'desc')->first();
    $fecha_reciente = $ultimoRegistro ? \Carbon\Carbon::parse($ultimoRegistro->fecha_envio)->startOfDay() : null;

    // Fecha seleccionada por el usuario o la más reciente
    $fecha_acta = $request->filled('fecha') 
        ? \Carbon\Carbon::parse($request->fecha)->startOfDay() 
        : $fecha_reciente;

    // Todas las fechas disponibles para el selector
    $fechas_anteriores = $area->financieras()
        ->selectRaw("DATE(fecha_envio) as fecha")
        ->distinct()
        ->orderBy('fecha', 'desc')
        ->pluck('fecha');

    // Construir query principal
    $query = $area->financieras()->with(['unidad', 'preventivos']);

    //  Aplicar filtro de fecha (siempre, excepto cuando hay búsqueda de texto sin fecha)
    if ($fecha_acta && !($request->filled('buscar') && !$request->filled('fecha'))) {
        $query->whereBetween('fecha_envio', [
            $fecha_acta->copy()->startOfDay(),
            $fecha_acta->copy()->endOfDay()
        ]);
    }

    // Aplicar búsqueda de texto si existe
    if ($request->filled('buscar')) {
        $busqueda = $request->buscar;
        $query->where(function ($q) use ($busqueda) {
            $q->where('entidad', 'like', "%$busqueda%")
              ->orWhere('tipo_documento', 'like', "%$busqueda%")
              ->orWhere('tipo_ejecucion', 'like', "%$busqueda%")
              ->orWhere('estado_administrativo', 'like', "%$busqueda%")
              ->orWhereHas('unidad', fn($sub) => $sub->where('nombre_unidad', 'like', "%$busqueda%"))
              ->orWhereHas('preventivos', fn($sub) => $sub
                  ->where('numero_preventivo', 'like', "%$busqueda%")
                  ->orWhere('descripcion_gasto', 'like', "%$busqueda%")
                  ->orWhere('empresa', 'like', "%$busqueda%"));
        });
    }

    // Obtener registros finales
    $registros_actuales = $query->orderBy('fecha_envio', 'desc')->get();

    return view('areas.show', compact(
        'area',
        'fechas_anteriores',
        'registros_actuales',
        'fecha_acta',
        'fecha_reciente'
    ));
}

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $area->update($request->all());

        return redirect()->route('areas.index')->with('mensaje', 'Área actualizada correctamente.');
    }
public function destroy($id)
{
    Area::findOrFail($id)->delete();

  
    $nextId = DB::table('areas')->max('id') + 1;
    DB::statement("ALTER TABLE areas AUTO_INCREMENT = {$nextId}");

    return redirect()->route('areas.index')->with('mensaje', 'Área eliminada correctamente ');
}



public function reporteFinanciera(Request $request, Area $area)
{
   
    $fecha = $request->input('registro') ?? $request->input('fecha');
    $fechasOrdenadas = \App\Models\Financiera::where('area_id', $area->id)
        ->selectRaw("DATE(fecha_envio) as fecha")
        ->distinct()
        ->orderBy('fecha', 'asc')
        ->pluck('fecha')
        ->toArray();
    if (!$fecha && !empty($fechasOrdenadas)) {
        $fecha = end($fechasOrdenadas);
    }
    $actaNumero = 1;
    if ($fecha && in_array($fecha, $fechasOrdenadas)) {
        $actaNumero = array_search($fecha, $fechasOrdenadas) + 1;
    }
    $financieras = $fecha
        ? \App\Models\Financiera::with('unidad', 'preventivos')
            ->where('area_id', $area->id)
            ->whereDate('fecha_envio', $fecha)
            ->get()
        : collect();
         $todosPreventivos = $financieras->flatMap(function($financiera) {
        return $financiera->preventivos;
    });
    $pdf = \PDF::loadView('areas.reporte_area', [
        'financieras' => $financieras,
        'actaNumero'  => $actaNumero,
        'fecha'       => $fecha,
        'area'        => $area,
         'todosPreventivos' => $todosPreventivos,
    ]);
    $safeArea = \Illuminate\Support\Str::slug($area->nombre ?? 'area');
    $fileName = "Reporte_Financiera_{$safeArea}_Acta_{$actaNumero}.pdf";
    return $pdf->download($fileName);
}



public function generarReporte(Request $request, $id)
{
    $area = Area::findOrFail($id);

  
    $fechasOrdenadas = $area->financieras()
        ->selectRaw("DATE(fecha_envio) as fecha")
        ->distinct()
        ->orderBy('fecha', 'asc')
        ->pluck('fecha')
        ->toArray();


    $fecha = $request->input('fecha') ?: end($fechasOrdenadas);
    $actaNumero = 1;
    if ($fecha && in_array($fecha, $fechasOrdenadas)) {
        $actaNumero = array_search($fecha, $fechasOrdenadas) + 1;
    }
    $financieras = $fecha
        ? $area->financieras()->with(['unidad', 'preventivos'])
            ->whereDate('fecha_envio', $fecha)
            ->get()
        : collect();
    $todosPreventivos = $financieras->flatMap(function($financiera) {
        return $financiera->preventivos->map(function($preventivo) use ($financiera) {
            $preventivo->numero_hoja_ruta = $financiera->numero_hoja_ruta ?? null;
            return $preventivo;
        });
    });

    // Generar PDF
    $pdf = Pdf::loadView('areas.reporte_area', [
        'area' => $area,
        'financieras' => $financieras,
        'todosPreventivos' => $todosPreventivos,
        'fecha' => $fecha,
        'actaNumero' => $actaNumero,
    ])->setPaper('a4', 'portrait');

    $safeArea = \Illuminate\Support\Str::slug($area->nombre ?? 'area');
    $fileName = "Reporte_Financiera_{$safeArea}_Acta_{$actaNumero}.pdf";

    return $pdf->download($fileName);
}

}
