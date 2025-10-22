<?php

namespace App\Http\Controllers;

use App\Models\AreaDespacho;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AreaDespachoController extends Controller
{
    public function index()
    {
        $areas = AreaDespacho::orderBy('created_at', 'desc')->paginate(10);
        return view('areas-despacho.index', compact('areas'));
    }

    public function create()
    {
        return view('areas-despacho.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        AreaDespacho::create($request->only('nombre', 'descripcion'));

        return redirect()->route('areas-despacho.index')->with('success', 'Área de despacho creada correctamente.');
    }

    public function edit(AreaDespacho $areaDespacho)
    {
        return view('areas-despacho.edit', compact('areaDespacho'));
    }

    public function update(Request $request, AreaDespacho $areaDespacho)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $areaDespacho->update($request->only('nombre', 'descripcion'));

        return redirect()->route('areas-despacho.index')->with('success', 'Área de despacho actualizada correctamente.');
    }

    public function destroy(AreaDespacho $areaDespacho)
    {
        $areaDespacho->delete();
        return redirect()->route('areas-despacho.index')->with('success', 'Área de despacho eliminada correctamente.');
    }


public function show($id, Request $request)
{
    $areaDespacho = AreaDespacho::findOrFail($id);

    // Fecha más reciente de registros
    $fecha_reciente = $areaDespacho->financieras()
        ->orderBy('fecha_documento', 'desc')
        ->pluck('fecha_documento')
        ->first();

    // Determinar la fecha a mostrar
    $fecha_acta = $request->filled('fecha') ? $request->fecha : $fecha_reciente;

    // Últimos registros: registros de la fecha más reciente
    $ultimos_registros = $areaDespacho->financieras()->with('unidad')
        ->whereDate('fecha_documento', $fecha_reciente)
        ->orderBy('fecha_documento', 'desc')
        ->get();

    // Fechas anteriores (actas previas)
    $fechas_anteriores = $areaDespacho->financieras()
        ->whereDate('fecha_documento', '<', $fecha_reciente)
        ->orderBy('fecha_documento', 'desc')
        ->distinct()
        ->pluck('fecha_documento');

    // Query principal: registros filtrados por la fecha seleccionada o búsqueda
    $query = $areaDespacho->financieras()->with('unidad', 'preventivos');

    if ($request->filled('buscar')) {
        $busqueda = $request->buscar;
        $query->where(function ($q) use ($busqueda) {
            $q->where('entidad', 'like', "%$busqueda%")
              ->orWhere('tipo_documento', 'like', "%$busqueda%")
              ->orWhere('tipo_ejecucion', 'like', "%$busqueda%")
              ->orWhere('estado_documento', 'like', "%$busqueda%")
              ->orWhere('estado_administrativo', 'like', "%$busqueda%")
              ->orWhere('fecha_documento', 'like', "%$busqueda%")
              ->orWhere('numero_hoja_ruta', 'like', "%$busqueda%")
              ->orWhere('numero_pago', 'like', "%$busqueda%")
              ->orWhere('numero_compromiso', 'like', "%$busqueda%")
              ->orWhere('numero_devengado', 'like', "%$busqueda%")
              ->orWhereHas('preventivos', function($q2) use ($busqueda) {
                  $q2->where('descripcion_gasto', 'like', "%$busqueda%")
                     ->orWhere('numero_preventivo', 'like', "%$busqueda%");
              })
              ->orWhereHas('unidad', fn($sub) => $sub->where('nombre_unidad', 'like', "%$busqueda%"));
        });
    } else {
        // Filtrar por fecha seleccionada si no hay búsqueda
        $query->whereDate('fecha_documento', $fecha_acta);
    }

    // Obtener registros con paginación
    $registros_actuales = $query->orderBy('fecha_documento', 'desc')->paginate(5)->withQueryString();

    return view('areas-despacho.show', compact(
        'areaDespacho',
        'ultimos_registros',
        'fechas_anteriores',
        'registros_actuales',
        'fecha_acta',
        'fecha_reciente'
    ));
}



  public function reporteFinanciera($areaId, $financieraId)
    {
        $areaDespacho = AreaDespacho::findOrFail($areaId);

        $financiera = $areaDespacho->financieras()
            ->with('unidad', 'areaDespacho', 'preventivos')
            ->findOrFail($financieraId);

        // Número de acta (opcional)
        $actaNumero = $areaDespacho->financieras()->where('id', '<=', $financiera->id)->count();


        // Generar PDF
        $pdf = PDF::loadView('areas-despacho.reporte_financiera', compact('financiera', 'actaNumero'));

        return $pdf->download('reporte_financiera_'.$financiera->id.'.pdf');
    }
    
public function generarReporte(Request $request, $id)
{
    // 1. Obtener el área despacho
    $areaDespacho = AreaDespacho::findOrFail($id);

    // 2. Todas las fechas únicas de registros de esta área despacho, ordenadas ascendentemente
    $fechasOrdenadas = $areaDespacho->financieras()
        ->selectRaw("DATE(fecha_documento) as fecha")
        ->distinct()
        ->orderBy('fecha', 'asc')
        ->pluck('fecha')
        ->toArray();

    // 3. Obtener fecha seleccionada (desde la vista) o usar la última
    $fecha = $request->input('fecha');
    if (!$fecha && !empty($fechasOrdenadas)) {
        $fecha = end($fechasOrdenadas);
    }

    // 4. Calcular número de acta
    $actaNumero = 1;
    if ($fecha && in_array($fecha, $fechasOrdenadas)) {
        $actaNumero = array_search($fecha, $fechasOrdenadas) + 1;
    }

    // 5. Filtrar financieras por la fecha seleccionada
    $financieras = $fecha
        ? $areaDespacho->financieras()->with(['unidad', 'preventivos'])
            ->whereDate('fecha_documento', $fecha)
            ->get()
        : collect();

   $todosPreventivos = $financieras->flatMap(function($financiera) {
    return $financiera->preventivos->map(function($preventivo) use ($financiera) {
        // Agregar info de la financiera al preventivo
        $preventivo->numero_hoja_ruta = $financiera->numero_hoja_ruta;
        $preventivo->numero_foja      = $financiera->numero_foja;
        return $preventivo;
    });
});


    // 7. Generar PDF usando la vista
    $pdf = Pdf::loadView('areas-despacho.reporte_area', [
        'areaDespacho' => $areaDespacho,
        'financieras' => $financieras,
        'todosPreventivos' => $todosPreventivos,
        'fecha' => $fecha,
        'actaNumero' => $actaNumero
    ])->setPaper('a4', 'portrait');

    // 8. Descargar PDF con nombre descriptivo
    $safeArea = \Illuminate\Support\Str::slug($areaDespacho->nombre ?? 'despacho');
    $fileName = "Reporte_Despacho_{$safeArea}_Acta_{$actaNumero}.pdf";

    return $pdf->download($fileName);
}




}
