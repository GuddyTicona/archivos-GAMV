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
    $ultimoRegistro = $areaDespacho->financieras()
        ->orderBy('fecha_documento', 'desc')
        ->first();
    
    $fecha_reciente = $ultimoRegistro ? \Carbon\Carbon::parse($ultimoRegistro->fecha_documento)->startOfDay() : null;

    // Fecha seleccionada por el usuario o la más reciente
    $fecha_acta = $request->filled('fecha') 
        ? \Carbon\Carbon::parse($request->fecha)->startOfDay() 
        : $fecha_reciente;

    // Todas las fechas disponibles para el selector
    $fechas_anteriores = $areaDespacho->financieras()
        ->selectRaw("DATE(fecha_documento) as fecha")
        ->distinct()
        ->orderBy('fecha', 'desc')
        ->pluck('fecha');

    // Query principal
    $query = $areaDespacho->financieras()->with(['unidad', 'preventivos']);

    // PRIMERO: Aplicar filtro de fecha (excepto cuando hay búsqueda sin fecha específica)
    if ($fecha_acta && !($request->filled('buscar') && !$request->filled('fecha'))) {
        $query->whereDate('fecha_documento', $fecha_acta->toDateString());
    }

    // SEGUNDO: Aplicar búsqueda de texto si existe
    if ($request->filled('buscar')) {
        $busqueda = $request->buscar;
        $query->where(function ($q) use ($busqueda) {
            $q->where('entidad', 'like', "%$busqueda%")
              ->orWhere('tipo_documento', 'like', "%$busqueda%")
              ->orWhere('tipo_ejecucion', 'like', "%$busqueda%")
              ->orWhere('estado_administrativo', 'like', "%$busqueda%")
              ->orWhere('numero_hoja_ruta', 'like', "%$busqueda%")
              ->orWhere('numero_pago', 'like', "%$busqueda%")
              ->orWhere('numero_compromiso', 'like', "%$busqueda%")
              ->orWhere('numero_devengado', 'like', "%$busqueda%")
              ->orWhereHas('unidad', fn($sub) => $sub->where('nombre_unidad', 'like', "%$busqueda%"))
              ->orWhereHas('preventivos', fn($sub) => $sub
                  ->where('numero_preventivo', 'like', "%$busqueda%")
                  ->orWhere('descripcion_gasto', 'like', "%$busqueda%"));
        });
    }

    // Obtener registros con paginación
    $registros_actuales = $query->orderBy('fecha_documento', 'desc')
        ->paginate(5)
        ->withQueryString();

    return view('areas-despacho.show', compact(
        'areaDespacho',
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
