<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Unidad;
use App\Models\Categoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ArchivoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $archivos = Archivo::paginate();
     
        return view('archivo.index', compact('archivos'))
            ->with('i', ($request->input('page', 1) - 1) * $archivos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $archivo = new Archivo();
        $unidades = Unidad::pluck('nombre_unidad','id');
        $categorias = Categoria::pluck('nombre_categoria', 'id');


        return view('archivo.create', compact('archivo','unidades','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArchivoRequest $request): RedirectResponse
    {
         $request->validate([
        // validaciones aquí...
        'unidad_id' => 'required|exists:unidades,id',
         'documento_adjunto' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:20480', // 20 MB
       
    ]);

    $archivo = new Archivo();
    $archivo->codigo_archivo = $request->codigo_archivo;
    $archivo->descripcion_documento = $request->descripcion_documento;
    $archivo->tomo = $request->tomo;
    $archivo->numero_foja = $request->numero_foja;
    $archivo->gestion = $request->gestion;
    $archivo->unidad_instalacion = $request->unidad_instalacion;
    $archivo->observaciones = $request->observaciones;
    $archivo->fecha_registro = $request->fecha_registro;

   
    $archivo->unidad_id = $request->unidad_id;

    $archivo->estado = $request->estado;
    $archivo->categoria_id = $request->categoria_id;

         // archivo adjunto
        if ($request->hasFile('documento_adjunto')) {
            $file = $request->file('documento_adjunto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('documentos_adjuntos', $filename, 'public');
            $archivo->documento_adjunto = $filePath;
        }

    $archivo->save();

    return redirect()->route('archivos.index')
        ->with('mensaje', 'Archivo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $archivo = Archivo::find($id);

        return view('archivo.show', compact('archivo'));
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
       $archivo = Archivo::findOrFail($id); 
     $unidades = Unidad::pluck('nombre_unidad', 'id');
     $categorias = Categoria::pluck('nombre_categoria', 'id');

    return view('archivo.edit', compact('archivo', 'unidades', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArchivoRequest $request, Archivo $archivo): RedirectResponse
{
    $datos = $request->validated();

    // Manejo del archivo adjunto
    if ($request->hasFile('documento_adjunto')) {
        $file = $request->file('documento_adjunto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documentos_adjuntos', $filename, 'public');
        $datos['documento_adjunto'] = $filePath;

       
        
    }

    $archivo->update($datos);

    return redirect()->route('archivos.index')
        ->with('mensaje', 'Archivo actualizado correctamente.');
}


    public function destroy($id): RedirectResponse
    {
        Archivo::find($id)->delete();

        return Redirect::route('archivos.index')
            ->with('mensaje', 'Archivo eliminado correctamente');
    }
}