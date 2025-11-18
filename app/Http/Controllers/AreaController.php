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
    $fecha_reciente = $area->financieras()
        ->orderBy('fecha_documento', 'desc')
        ->pluck('fecha_documento')
        ->first();

    // Determinar la fecha a mostrar
    $fecha_acta = $request->filled('fecha') ? $request->fecha : $fecha_reciente;

    // Últimos registros: registros de la fecha más reciente
    $ultimos_registros = $area->financieras()->with(['unidad', 'preventivos'])
        ->whereDate('fecha_documento', $fecha_reciente)
        ->orderBy('fecha_documento', 'desc')
        ->get();

    // Fechas anteriores (actas previas)
    $fechas_anteriores = $area->financieras()
        ->whereDate('fecha_documento', '<', $fecha_reciente)
        ->orderBy('fecha_documento', 'desc')
        ->distinct()
        ->pluck('fecha_documento');

 // Query principal: registros filtrados por la fecha seleccionada
$query = $area->financieras()->with(['unidad', 'preventivos']);

// Filtro de búsqueda
if ($request->filled('buscar')) {
    $busqueda = $request->buscar;
    $query->where(function ($q) use ($busqueda) {
        $q->where('entidad', 'like', "%$busqueda%")
          ->orWhere('tipo_documento', 'like', "%$busqueda%")
          ->orWhere('tipo_ejecucion', 'like', "%$busqueda%")
          ->orWhere('estado_documento', 'like', "%$busqueda%")
          ->orWhere('estado_administrativo', 'like', "%$busqueda%")
          ->orWhereHas('unidad', fn($sub) => $sub->where('nombre_unidad', 'like', "%$busqueda%"))
          ->orWhereHas('preventivos', fn($sub) => $sub
              ->where('numero_preventivo', 'like', "%$busqueda%")
              ->orWhere('descripcion_gasto', 'like', "%$busqueda%")
              ->orWhere('empresa', 'like', "%$busqueda%"));
    });
} else {
    // Si no hay búsqueda, filtrar por la fecha seleccionada
    $query->whereDate('fecha_documento', $fecha_acta);
}

$registros_actuales = $query->orderBy('fecha_documento', 'desc')->get();


    // Retornar vista con todas las variables necesarias
    return view('areas.show', compact(
        'area',
        'ultimos_registros',
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

    // Ajustar AUTO_INCREMENT al siguiente ID
    $nextId = DB::table('areas')->max('id') + 1;
    DB::statement("ALTER TABLE areas AUTO_INCREMENT = {$nextId}");

    return redirect()->route('areas.index')->with('mensaje', 'Área eliminada correctamente ');
}




public function reporteFinanciera(Request $request, Area $area)
{
    // 1. Obtener la fecha seleccionada desde la vista (botón de descarga o selección de acta)
    $fecha = $request->input('registro') ?? $request->input('fecha');

    // 2. Obtener todas las fechas únicas de registros para esta área, ordenadas ascendentemente
    $fechasOrdenadas = \App\Models\Financiera::where('area_id', $area->id)
        ->selectRaw("DATE(fecha_envio) as fecha")
        ->distinct()
        ->orderBy('fecha', 'asc')
        ->pluck('fecha')
        ->toArray();

    // 3. Si no hay fecha seleccionada, usar la última fecha disponible
    if (!$fecha && !empty($fechasOrdenadas)) {
        $fecha = end($fechasOrdenadas);
    }

    // 4. Determinar el número de acta según la posición de la fecha en la lista de fechas
    $actaNumero = 1;
    if ($fecha && in_array($fecha, $fechasOrdenadas)) {
        $actaNumero = array_search($fecha, $fechasOrdenadas) + 1;
    }

    // 5. Obtener los registros financieros de esta área para la fecha seleccionada
    $financieras = $fecha
        ? \App\Models\Financiera::with('unidad', 'preventivos')
            ->where('area_id', $area->id)
            ->whereDate('fecha_envio', $fecha)
            ->get()
        : collect();
         $todosPreventivos = $financieras->flatMap(function($financiera) {
        return $financiera->preventivos;
    });
    // 6. Generar el PDF usando la vista correspondiente
    $pdf = \PDF::loadView('areas.reporte_area', [
        'financieras' => $financieras,
        'actaNumero'  => $actaNumero,
        'fecha'       => $fecha,
        'area'        => $area,
         'todosPreventivos' => $todosPreventivos,
    ]);

    // 7. Crear un nombre de archivo seguro y descriptivo
    $safeArea = \Illuminate\Support\Str::slug($area->nombre ?? 'area');
    $fileName = "Reporte_Financiera_{$safeArea}_Acta_{$actaNumero}.pdf";

    // 8. Descargar el PDF
    return $pdf->download($fileName);
}






//reporte general

}
