<?php

namespace App\Http\Controllers;

use App\Models\Financiera;
use App\Models\Unidad;
use App\Models\Area;
use App\Models\AreaDespacho;  
use App\Models\AreaArchivo;  
use App\Models\Notificacion;
use Illuminate\Http\Request;
use App\Http\Requests\FinancieraRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class FinancieraController extends Controller

{
    
    // LISTADO GENERAL
    
    public function index(Request $request): View
    
    {
        
        $financieras = Financiera::with(['unidad', 'area', 'pr
        eventivos'])
            ->orderBy('created_at', 'asc')
            
            ->paginate();

        return view('financiera.index', compact('financieras'))
            ->with('i', ($request->input('page', 1) - 1) * $financieras->perPage());
    }

    // CREAR — SMAF
        public function create(): View
    {
        $financiera = new Financiera();
        $unidades = Unidad::pluck('nombre_unidad', 'id');
        $areas = Area::all();
        return view('financiera.smaf.create', compact('financiera', 'unidades', 'areas'));
    }

    // GUARDAR — SMAF
  public function store(FinancieraRequest $request): RedirectResponse
{
    $request->validate([
        'unidad_id' => 'required|exists:unidades,id',
        'area_id' => 'required|exists:areas,id',
        'preventivos.*.numero_preventivo' => 'required|string|max:50',
        'preventivos.*.total_pago' => 'required|numeric',
        'numero_foja' => 'nullable|string|max:100',
    ]);

    // Crear financiera sin enviar
    $financiera = new Financiera($request->except('preventivos', 'documento_adjunto'));

    
    $financiera->save();

    // Guardar documento adjunto si existe
    if ($request->hasFile('documento_adjunto')) {
        $financiera->documento_adjunto = $request->file('documento_adjunto')
            ->store('documentos_adjuntos', 'public');
        $financiera->save();
    }

    // Guardar preventivos
    $this->actualizarPreventivos($financiera, $request->preventivos);

    return redirect()->route('smaf.financieras.index')
        ->with('mensaje', 'Financiera registrada correctamente.');
}


    // SHOW
    public function show($id): View
    {
        $financiera = Financiera::with('unidad', 'preventivos')->findOrFail($id);
        return view('financiera.show', compact('financiera'));
    }

    // EDIT — SMAF
    public function editSmaf($id): View
    {
        $financiera = Financiera::with('preventivos')->findOrFail($id);
        $unidades = Unidad::pluck('nombre_unidad', 'id');
        $areas = Area::all();
        return view('financiera.smaf.edit', compact('financiera', 'unidades', 'areas'));
    }

    // UPDATE — SMAF
   public function updateSmaf(FinancieraRequest $request, $id): RedirectResponse
{
    // Cargar la financiera con preventivos
    $financiera = Financiera::with('preventivos')->findOrFail($id);

    // Validación
    $request->validate([
        'unidad_id' => 'required|exists:unidades,id',
        'area_id' => 'required|exists:areas,id',
        'preventivos.*.numero_preventivo' => 'required|string|max:50',
        'preventivos.*.total_pago' => 'required|numeric',
        'numero_foja' => 'nullable|string|max:100',
    ]);

    // Actualizar financiera
    $financiera->update($request->except('preventivos', 'documento_adjunto'));

    // Guardar documento adjunto si existe
    if ($request->hasFile('documento_adjunto')) {
        $financiera->update([
            'documento_adjunto' => $request->file('documento_adjunto')->store('documentos_adjuntos', 'public')
        ]);
    }

    // Actualizar preventivos solo si vienen en el request
    if (!empty($request->preventivos) && is_array($request->preventivos)) {
        $this->actualizarPreventivos($financiera, $request->preventivos);
    }

    return redirect()
        ->route('smaf.financieras.index')
        ->with('mensaje', 'Datos actualizados correctamente (SMAF).');
}

 public function enviar($id)
{
    $financiera = Financiera::with('preventivos', 'unidad')->findOrFail($id);

    // Marcar como enviado y actualizar fecha de envío
    $financiera->enviado_a_despacho = true;
    $financiera->fecha_envio = now();
    $financiera->save();

    $preventivo = $financiera->preventivos->first();
    $numeroPreventivo = $preventivo ? $preventivo->numero_preventivo : 'SIN PREVENTIVO';

    // Determinar si es primer envío o reenvío
    $mensajeAccion = $financiera->wasChanged('fecha_envio') ? 'Se reenvió' : 'Se envió';
    $mensaje = "{$mensajeAccion} una financiera: Entidad: {$financiera->entidad}, Unidad: "
             . ($financiera->unidad->nombre_unidad ?? 'N/A')
             . ", Preventivo: {$numeroPreventivo}";

    Notificacion::create([
        'financiera_id' => $financiera->id,
        'de_area'       => 'SMAF',
        'para_area'     => 'Despacho',
        'mensaje'       => $mensaje,
        'leido'         => false,
    ]);

    return redirect()
        ->route('smaf.financieras.index')
        ->with('mensaje', 'Financiera enviada correctamente a Despacho.');
}








    // EDIT — DESPACHO
    public function editDespacho($id): View
    {
        $financiera = Financiera::with('preventivos')->findOrFail($id);
          
           $areasDespacho = AreaDespacho::all();
        return view('financiera.despacho.edit', compact('financiera','areasDespacho'));
    }
    //UPDATE DESPACHO
    public function updateDespacho(Request $request, Financiera $financiera): RedirectResponse
    {
        $request->validate([
         
            'area_despacho_id' => 'nullable|exists:areas_despacho,id',  
            'numero_foja' => 'required|string|max:100',
            'numero_hoja_ruta' => 'required|string|max:50',
        ]);

   
        $financiera->area_despacho_id = $request->area_despacho_id;
        $financiera->numero_hoja_ruta = $request->numero_hoja_ruta;
        $financiera->numero_foja = $request->numero_foja;
         $financiera->enviado_a_tesoreria = false;

        $financiera->save();

        return redirect()
            ->route('despacho.financieras.index')
            ->with('mensaje', 'Datos guardados correctamente en Despacho.');
    }

  public function enviarTesoreria($id)
{
    $financiera = Financiera::with(['preventivos', 'unidad', 'areaDespacho'])->findOrFail($id);

    if (!$financiera->enviado_a_tesoreria) {
        $financiera->enviado_a_tesoreria = true;
        $financiera->save();
        $preventivo = $financiera->preventivos->first();
        $numeroPreventivo = $preventivo ? $preventivo->numero_preventivo : 'SIN PREVENTIVO';

        $mensaje = "Se envió una financiera a Tesorería: Entidad: {$financiera->entidad}, "
                 . "Unidad: " . ($financiera->unidad->nombre_unidad ?? 'N/A') . ", "
                 . "Preventivo: {$numeroPreventivo}, "
                 . "N° Foja: {$financiera->numero_foja}, "
                 . "N° Hoja Ruta: {$financiera->numero_hoja_ruta}";
        $notificacion = Notificacion::create([
            'financiera_id' => $financiera->id,
            'de_area'       => 'Despacho',
            'para_area'     => 'Tesoreria',
            'mensaje'       => $mensaje,
            'leido'         => false,
        ]);

        return redirect()
            ->route('despacho.financieras.index')
            ->with('nueva_notificacion', [
                'id'      => $notificacion->id,
                'de_area' => $notificacion->de_area,
                'mensaje' => $notificacion->mensaje,
            ]);
    }

    return redirect()->back()->with('mensaje', 'Esta financiera ya fue enviada a Tesorería.');
}






    // ELIMINAR
public function destroy($id): RedirectResponse
{
    Financiera::findOrFail($id)->delete();

    // Ajustar AUTO_INCREMENT al siguiente ID disponible
    $nextId = DB::table('financieras')->max('id') + 1;
    DB::statement("ALTER TABLE financieras AUTO_INCREMENT = {$nextId}");

    return Redirect::route('smaf.financieras.index')->with('mensaje', 'Financiera eliminada correctamente.');
}

    // CAMBIO DE ESTADO
    public function actualizarEstado(Request $request, $id)
    {
        $request->validate([
            'estado_administrativo' => 'required|in:enviado,pendiente,recibido,rechazado,tesoreria',
        ]);

        $financiera = Financiera::findOrFail($id);
        $financiera->estado_administrativo = $request->estado_administrativo;
        $financiera->estado_actualizado = now();
        $financiera->save();

        return back()->with('mensaje', 'Estado actualizado correctamente.');
    }

    // SMAF 
    public function indexSmaf(Request $request)
    {
        $financieras = Financiera::with(['unidad', 'area', 'preventivos'])
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('financiera.smaf.index', compact('financieras'));
    }


  // DESPACHO 
    public function indexDespacho(Request $request)
    {
        $financieras = Financiera::with(['unidad', 'area', 'preventivos', 'notificaciones'])
            ->where('enviado_a_despacho', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $notificaciones = Notificacion::where('para_area', 'Despacho')
                                    ->where('leido', false)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('financiera.despacho.index', compact('financieras', 'notificaciones'));
    }






    // PDF REPORTE
    public function reporte($id)
{
    $financiera = Financiera::with('unidad', 'areaArchivo', 'preventivos')->findOrFail($id);

    $actaNumero = Financiera::where('id', '<=', $id)->count();

    $pdf = Pdf::loadView('reportes.financiera', compact('financiera','actaNumero'));
    return $pdf->download('reporte_financiera_' . $id . '.pdf');
}


    

    // CAMBIAR ESTADO ADMINISTRATIVO DESDE DESPACHO
    public function cambiarEstadoAdministrativo(Request $request, $id)
    {
        $request->validate([
            'estado_administrativo' => 'required|in:pendiente,recibido,rechazado'
        ]);

        $financiera = Financiera::findOrFail($id);
        $financiera->estado_administrativo = $request->estado_administrativo;
        $financiera->estado_actualizado = now();
        $financiera->save();

        return redirect()->back()->with('success', 'Estado administrativo actualizado correctamente.');
    }

    // DEVOLVER A DESPACHO DE TESORERIA
        public function actualizarEstadoDespacho(Request $request, $id)
    {
        $request->validate([
            'estado_despacho' => 'required|in:pendiente,recibido,rechazado',
        ]);

        $financiera = \App\Models\Financiera::findOrFail($id);

        $financiera->estado_despacho = $request->estado_despacho;
        $financiera->despacho_actualizado = now();
        $financiera->save();

        return back()->with('mensaje', 'Estado de despacho actualizado correctamente.');
    }

// TESORERIA - LISTAR
public function indexTesoreria(Request $request): View
{
    $financieras = Financiera::with(['unidad', 'area', 'preventivos', 'areaDespacho', 'notificaciones'])
        ->where('enviado_a_tesoreria', true)
        ->orderBy('created_at', 'desc')
        ->paginate();

    // Obtener notificaciones solo para Tesorería
    $notificaciones = Notificacion::where('para_area', 'Tesoreria')
                                  ->orderBy('created_at', 'desc')
                                  ->get();

    return view('financiera.tesoreria.index', compact('financieras', 'notificaciones'));
}




    // EDIT TESORERÍA
    public function editTesoreria($id): View
    {
        $financiera = Financiera::with('preventivos')->findOrFail($id);
         $areasArchivos = AreaArchivo::all();
        return view('financiera.tesoreria.edit', compact('financiera','areasArchivos'));
    }
//DEVOLVER DE ARCHIVOS A TESORERIA
        public function actualizarEstadoTesoreria(Request $request, $id)
    {
        $request->validate([
            'estado_tesoreria' => 'required|in:pendiente,recibido,rechazado',
        ]);

        $financiera = \App\Models\Financiera::findOrFail($id);

        $financiera->estado_tesoreria = $request->estado_tesoreria;
        $financiera->tesoreria_actualizado = now();
        $financiera->save();

        return back()->with('mensaje', 'Estado de despacho actualizado correctamente.');
    }

    // UPDATE TESORERÍA
  // UPDATE TESORERÍA
    public function updateTesoreria(Request $request, Financiera $financiera): RedirectResponse
    {
        // Validación de preventivos
        $request->validate([
            'preventivos.*.id' => 'required|exists:preventivos,id',
            'preventivos.*.numero_preventivo' => 'required|string|max:50',
            'preventivos.*.numero_secuencia' => 'nullable|string|max:50',
            'preventivos.*.empresa' => 'nullable|string|max:100',
            'preventivos.*.beneficiario' => 'nullable|string|max:150',
            'preventivos.*.descripcion_gasto' => 'nullable|string|max:255',
            'preventivos.*.total_pago' => 'required|numeric',
             'area_archivo_id' => 'nullable|exists:areas_archivos,id',
        ]);

        // Actualizar preventivos
          $financiera->area_archivo_id = $request->area_archivo_id;
          $financiera->save();
        $this->actualizarPreventivos($financiera, $request->preventivos);

        return redirect()->route('tesoreria.financieras.index')
            ->with('mensaje', 'Preventivos actualizados correctamente por Tesorería.');
    }

// FINANCIERA - Enviar a Archivos
  public function enviarArchivo($id)
{
    $financiera = Financiera::with(['preventivos', 'unidad', 'areaDespacho'])->findOrFail($id);

    // Generar código único si no existe
    if (!$financiera->codigo) {
        $anioMes = date('Ym');
        $contador = 1;

        do {
            $codigo = 'FIN-' . $anioMes . '-' . str_pad($contador, 3, '0', STR_PAD_LEFT);
            $existe = Financiera::where('codigo', $codigo)->exists();
            $contador++;
        } while ($existe);

        $financiera->codigo = $codigo;
    }

    // Marcar como enviado
    $financiera->enviado_archivo = 'enviado';
    $financiera->fecha_envio = now();
    $financiera->save();

    // Construir lista de preventivos
    $listaPreventivos = $financiera->preventivos->map(function($p){
        return "N° Preventivo: {$p->numero_preventivo}, Secuencia: {$p->numero_secuencia}, Beneficiario: {$p->beneficiario}";
    })->implode(' | ');

    // Crear mensaje de notificación
    $mensaje = "Se envió una financiera a Archivos: Entidad: {$financiera->entidad}, "
             . "Unidad: " . ($financiera->unidad->nombre_unidad ?? 'N/A') . ", "
             . "Preventivos: {$listaPreventivos}, "
             . "N° Foja: {$financiera->numero_foja}, "
             . "N° Hoja Ruta: {$financiera->numero_hoja_ruta}";

    // Crear notificación
    $notificacion = Notificacion::create([
        'financiera_id' => $financiera->id,
        'de_area'       => 'Tesoreria',
        'para_area'     => 'Archivo',
        'mensaje'       => $mensaje,
        'leido'         => false,
    ]);

    return redirect()
        ->route('tesoreria.financieras.index')
        ->with('nueva_notificacion', [
            'id'      => $notificacion->id,
            'de_area' => $notificacion->de_area,
            'mensaje' => $notificacion->mensaje,
        ])
        ->with('mensaje', 'Documento enviado a Archivos correctamente.');
}

    // Mostrar registros enviados a Archivos
public function archivos(Request $request)
{
    $search = $request->input('search');

    $financieras = Financiera::with(['unidad', 'area', 'areaDespacho', 'preventivos'])
        ->where('enviado_archivo', 'enviado')
        ->when($search, function($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('codigo', 'like', "%{$search}%")
                  ->orWhere('entidad', 'like', "%{$search}%")
                  ->orWhere('tipo_documento', 'like', "%{$search}%")
                  ->orWhere('tipo_ejecucion', 'like', "%{$search}%")
                  ->orWhere('numero_compromiso', 'like', "%{$search}%")
                  ->orWhere('numero_devengado', 'like', "%{$search}%")
                  ->orWhere('numero_pago', 'like', "%{$search}%")
                  ->orWhere('numero_foja', 'like', "%{$search}%")
                  ->orWhere('numero_hoja_ruta', 'like', "%{$search}%")
                  ->orWhereHas('unidad', function($u) use ($search) {
                      $u->where('nombre_unidad', 'like', "%{$search}%");
                  })
                  ->orWhereHas('area', function($a) use ($search) {
                      $a->where('nombre', 'like', "%{$search}%");
                  })
                  ->orWhereHas('areaDespacho', function($d) use ($search) {
                      $d->where('nombre', 'like', "%{$search}%");
                  })
                  ->orWhereHas('preventivos', function($p) use ($search) {
                      $p->where('numero_preventivo', 'like', "%{$search}%")
                        ->orWhere('empresa', 'like', "%{$search}%")
                        ->orWhere('descripcion_gasto', 'like', "%{$search}%");
                  });
            });
        })
        ->orderBy('id', 'desc')
        ->paginate(12);
    $notificaciones = Notificacion::where('para_area', 'Archivo')
                                  ->where('leido', false)
                                  ->orderBy('created_at', 'desc')
                                  ->get();

    return view('financiera.archivos.index', compact('financieras', 'notificaciones'));

}

public function showArchivos($id)
{
    $financiera = Financiera::with(['area', 'unidad', 'preventivos'])->findOrFail($id);
    return view('financiera.archivos.show', compact('financiera'));
}

public function updateArchivo(Request $request, Financiera $financiera): RedirectResponse
{

    $request->validate([
        'preventivos.*.id' => 'required|exists:preventivos,id',
        'preventivos.*.numero_preventivo' => 'required|string|max:50',
        'preventivos.*.numero_secuencia' => 'nullable|string|max:50',
        'preventivos.*.empresa' => 'nullable|string|max:100',
        'preventivos.*.beneficiario' => 'nullable|string|max:150',
        'preventivos.*.descripcion_gasto' => 'nullable|string|max:255',
        'preventivos.*.total_pago' => 'required|numeric',
        //'area_archivo_id' => 'nullable|exists:areas_archivos,id',

        'documento_adjunto' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:20480',
    ]);

   // $financiera->area_archivo_id = $request->area_archivo_id;
    //$financiera->save();

   $this->actualizarPreventivos($financiera, $request->preventivos);

    if ($request->hasFile('documento_adjunto')) {

       
        if ($financiera->documento_adjunto && Storage::disk('public')->exists($financiera->documento_adjunto)) {
            Storage::disk('public')->delete($financiera->documento_adjunto);
        }

        $path = $request->file('documento_adjunto')->store('documentos_adjuntos', 'public');

        $financiera->update([
            'documento_adjunto' => $path
        ]);
    }

    return redirect()->route('tesoreria.financieras.index')
        ->with('mensaje', 'Preventivos y archivo actualizados correctamente por Tesorería.');
}
    public function editArchivo($id): View
    {
        $financiera = Financiera::with('preventivos')->findOrFail($id);
        // $areasArchivos = AreaArchivo::all();
        return view('financiera.archivos.edit', compact('financiera'));

    }
   protected function actualizarPreventivos(Financiera $financiera, ?array $preventivos = null): void
{
    if (empty($preventivos)) return;

    foreach ($preventivos as $data) {
        $numeroPreventivo = $data['numero_preventivo'] ?? null;
        $totalPago        = $data['total_pago']        ?? null;

        if ($numeroPreventivo === null || $totalPago === null) {
            continue;
        }

        if (!empty($data['id'])) {
         
            $preventivo = $financiera->preventivos()->find($data['id']);
            if ($preventivo) {
                $preventivo->numero_preventivo = (string) $numeroPreventivo;
                $preventivo->numero_secuencia  = $data['numero_secuencia']  ?? null;
                $preventivo->empresa           = $data['empresa']           ?? null;
                $preventivo->beneficiario      = $data['beneficiario']      ?? null;
                $preventivo->descripcion_gasto = $data['descripcion_gasto'] ?? null;
                $preventivo->total_pago        = $totalPago;
                $preventivo->save();
            }
        } else {
            $financiera->preventivos()->create([
                'numero_preventivo' => (string) $numeroPreventivo,
                'numero_secuencia'  => $data['numero_secuencia']  ?? null,
                'empresa'           => $data['empresa']           ?? null,
                'beneficiario'      => $data['beneficiario']      ?? null,
                'descripcion_gasto' => $data['descripcion_gasto'] ?? null,
                'total_pago'        => $totalPago,
            ]);
        }
    }
}


    
}