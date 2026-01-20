<?php

namespace App\Http\Controllers;

use App\Models\AreaArchivo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Financiera;

class AreaArchivoController extends Controller
{
    public function index()
    {
        $areas = AreaArchivo::orderBy('created_at', 'desc')->paginate(10);
        return view('areas-archivos.index', compact('areas'));
    }

    public function create()
    {
        return view('areas-archivos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        AreaArchivo::create($request->only('nombre', 'descripcion'));

        return redirect()->route('areas-archivos.index')->with('success', 'Área de archivo creada correctamente.');
    }

    public function edit(AreaArchivo $areaArchivo)
    {
        return view('areas-archivos.edit', compact('areaArchivo'));
    }

    public function update(Request $request, AreaArchivo $areaArchivo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $areaArchivo->update($request->only('nombre', 'descripcion'));

        return redirect()->route('areas-archivos.index')->with('success', 'Área de archivo actualizada correctamente.');
    }

    public function destroy(AreaArchivo $areaArchivo)
    {
        $areaArchivo->delete();
        return redirect()->route('areas-archivos.index')->with('success', 'Área de archivo eliminada correctamente.');
    }
public function show($id, Request $request)
{
    $areaArchivo = AreaArchivo::findOrFail($id);

    // Fecha más reciente de registros - CORREGIDO: agregar whereNotNull
    $fecha_reciente = $areaArchivo->financieras()
        ->whereNotNull('fecha_documento')  // Evitar nulls
        ->orderBy('fecha_documento', 'desc')
        ->value('fecha_documento');  // Usar value() es más eficiente que pluck()->first()

    // Determinar la fecha a mostrar: seleccionada por el usuario o la más reciente
    $fecha_acta = $request->filled('fecha') ? $request->fecha : $fecha_reciente;

    // Últimos registros: registros de la fecha más reciente
    $ultimos_registros = collect();
    if ($fecha_reciente) {  // CORREGIDO: verificar que no sea null
        $ultimos_registros = $areaArchivo->financieras()
            ->with('unidad', 'preventivos')
            ->whereDate('fecha_documento', $fecha_reciente)
            ->orderBy('fecha_documento', 'desc')
            ->get();
    }

    // Fechas anteriores (actas previas) - CORREGIDO
    $fechas_anteriores = collect();
    if ($fecha_reciente) {  // Solo buscar fechas anteriores si hay una fecha reciente
        $fechas_anteriores = $areaArchivo->financieras()
            ->whereNotNull('fecha_documento')  // Evitar nulls
            ->whereDate('fecha_documento', '<', $fecha_reciente)
            ->orderBy('fecha_documento', 'desc')
            ->distinct()
            ->pluck('fecha_documento');
    }

    // Query principal
    $query = $areaArchivo->financieras()->with('unidad', 'preventivos');

    if ($request->filled('buscar')) {
        $busqueda = $request->buscar;
        $query->where(function ($q) use ($busqueda) {
            $q->where('entidad', 'like', "%$busqueda%")
              ->orWhere('tipo_documento', 'like', "%$busqueda%")
              ->orWhere('tipo_ejecucion', 'like', "%$busqueda%")
              ->orWhere('estado_documento', 'like', "%$busqueda%")
              ->orWhere('estado_administrativo', 'like', "%$busqueda%")
              ->orWhere('fecha_envio', 'like', "%$busqueda%")
              ->orWhere('numero_hoja_ruta', 'like', "%$busqueda%")
              ->orWhere('numero_pago', 'like', "%$busqueda%")
              ->orWhere('numero_compromiso', 'like', "%$busqueda%")
              ->orWhere('numero_devengado', 'like', "%$busqueda%")
              ->orWhere('numero_preventivo', 'like', "%$busqueda%")
              ->orWhere('numero_secuencia', 'like', "%$busqueda%")
              ->orWhereHas('preventivos', function ($q2) use ($busqueda) {
                  $q2->where('descripcion_gasto', 'like', "%$busqueda%")
                     ->orWhere('numero_preventivo', 'like', "%$busqueda%");
              })
              ->orWhereHas('unidad', fn($sub) => $sub->where('nombre_unidad', 'like', "%$busqueda%"));
        });
    } else {
        // Filtrar por la fecha seleccionada si no hay búsqueda - CORREGIDO
        if ($fecha_acta) {  // Verificar que la fecha no sea null
            $query->whereDate('fecha_documento', $fecha_acta);
        }
    }

    // Obtener registros con paginación
    $registros_actuales = $query->orderBy('fecha_documento', 'desc')
        ->paginate(5)
        ->withQueryString();

    return view('areas-archivos.show', compact(
        'areaArchivo',
        'ultimos_registros',
        'fechas_anteriores',
        'registros_actuales',
        'fecha_acta',
        'fecha_reciente'
    ));
}



public function generarReporte(Request $request, $id)
{
    $areaArchivo = AreaArchivo::with('financieras.preventivos', 'financieras.unidad', 'financieras.area')->findOrFail($id);
     $fechasOrdenadas = $areaArchivo->financieras()
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
        ? $areaArchivo->financieras()->with(['unidad', 'preventivos'])
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
    $pdf = Pdf::loadView('areas-archivos.reporte_area', [
        'areaArchivo' => $areaArchivo,
        'financieras' => $financieras,
        'todosPreventivos' => $todosPreventivos,
        'fecha' => $fecha,
        'actaNumero' => $actaNumero
    ])->setPaper('a4', 'portrait');

    // 8. Descargar PDF con nombre descriptivo
    $safeArea = \Illuminate\Support\Str::slug($areaArchivo->nombre ?? 'tesoreria');
    $fileName = "Reporte_Tesoreria_{$safeArea}_Acta_{$actaNumero}.pdf";

    return $pdf->download($fileName);

   
}



// AreaArchivoController.php
public function reporteFinanciera($areaId, $financieraId)
{
    // Obtener el área de archivo
    $areaArchivo = AreaArchivo::findOrFail($areaId);

    // Obtener la financiera específica dentro de esa área
    $financiera = $areaArchivo->financieras()->with('unidad', 'areaArchivo', 'preventivos')
                     ->findOrFail($financieraId);

    // Número de acta (opcional, puedes ajustarlo)
    $actaNumero = $areaArchivo->financieras()->where('id', '<=', $financiera->id)->count();

    // Generar PDF
    $pdf = \PDF::loadView('areas-archivos.reporte_financiera', compact('financiera','actaNumero'));

    return $pdf->download('reporte_financiera_'.$financiera->id.'.pdf');
}

}
