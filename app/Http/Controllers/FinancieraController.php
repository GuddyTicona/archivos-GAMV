<?php

namespace App\Http\Controllers;

use App\Models\Financiera;
use App\Models\Unidad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\FinancieraRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class FinancieraController extends Controller
{
    public function index(Request $request): View
    {
        $financieras = Financiera::with('unidad')->paginate();
        return view('financiera.index', compact('financieras'))
            ->with('i', ($request->input('page', 1) - 1) * $financieras->perPage());
    }

    public function create(): View
    {
        $financiera = new Financiera();
        $unidades = Unidad::pluck('nombre_unidad', 'id');
        return view('financiera.create', compact('financiera', 'unidades'));
    }

    public function store(FinancieraRequest $request): RedirectResponse
    {
        $request->validate([
            'unidad_id' => 'required|exists:unidades,id',
        ]);

        $financiera = new Financiera();
        $financiera->entidad = $request->entidad;
        $financiera->unidad_id = $request->unidad_id;
        $financiera->descripcion_gasto = $request->descripcion_gasto;
        $financiera->total_pago = $request->total_pago;
        $financiera->estado_documento = $request->estado_documento;
        $financiera->tipo_documento = $request->tipo_documento;
        $financiera->tipo_ejecucion = $request->tipo_ejecucion;
        $financiera->fecha_documento = $request->fecha_documento;
        $financiera->documento_adjunto = $request->documento_adjunto;
        $financiera->numero_hoja_ruta = $request->numero_hoja_ruta;
        $financiera->numero_preventivo = $request->numero_preventivo;
        $financiera->numero_compromiso = $request->numero_compromiso;
        $financiera->numero_devengado = $request->numero_devengado;
        $financiera->numero_pago = $request->numero_pago;
        $financiera->numero_secuencia = $request->numero_secuencia;

        $financiera->save();

        return redirect()->route('financieras.index')
            ->with('mensaje', 'Financiera creada correctamente.');
    }

    public function show($id): View
    {
        $financiera = Financiera::with('unidad')->findOrFail($id);
        return view('financiera.show', compact('financiera'));
    }

    public function edit($id): View
    {
        $financiera = Financiera::findOrFail($id);
        $unidades = Unidad::pluck('nombre_unidad', 'id');
        return view('financiera.edit', compact('financiera', 'unidades'));
    }

    public function update(FinancieraRequest $request, Financiera $financiera): RedirectResponse
    {
        $request->validate([
            'unidad_id' => 'required|exists:unidades,id',
        ]);

        $financiera->update([
            'entidad' => $request->entidad,
            'unidad_id' => $request->unidad_id,
            'descripcion_gasto' => $request->descripcion_gasto,
            'total_pago' => $request->total_pago,
            'estado_documento' => $request->estado_documento,
            'tipo_documento' => $request->tipo_documento,
            'tipo_ejecucion' => $request->tipo_ejecucion,
            'fecha_documento' => $request->fecha_documento,
            'documento_adjunto' => $request->documento_adjunto,
            'numero_hoja_ruta' => $request->numero_hoja_ruta,
            'numero_preventivo' => $request->numero_preventivo,
            'numero_compromiso' => $request->numero_compromiso,
            'numero_devengado' => $request->numero_devengado,
            'numero_pago' => $request->numero_pago,
            'numero_secuencia' => $request->numero_secuencia,
        ]);

        return Redirect::route('financieras.index')
            ->with('mensaje', 'Financiera actualizada correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Financiera::findOrFail($id)->delete();
        return Redirect::route('financieras.index')
            ->with('mensaje', 'Financiera eliminada correctamente.');
    }
}
