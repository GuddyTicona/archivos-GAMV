<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Supports\Facades\Storage;
use Illuminate\Supports\Facades\DB;
use App\Models\Unidad;
class UnidadController extends Controller
{
    public function index(){
        $unidades = Unidad:: all();
        return view('unidades.index', ['unidades' => $unidades]);


    }

    public function create(){
        $unidades = Unidad:: all();
        return view('unidades.create');


    }
    public function store(Request $request){
       // $unidad = request()->all();
        //return response()-> json($unidad);
       $request ->validate([
        'nombre_unidad'=>'required',
        'descripcion'=>'required',
        'fecha_creacion'=>'required',
      ]);
        $unidad = new Unidad();
        $unidad ->nombre_unidad = $request->nombre_unidad;
        $unidad ->descripcion = $request->descripcion;
        $unidad ->fecha_creacion = $request->fecha_creacion;

        $unidad->save();
        return redirect()->route(route:'unidades.index')->with('mensaje','Se registro la unidad correctamente');


    }
    public function show($id){
        $unidad = Unidad:: findOrfail($id);
        //return response()-> json($unidad);
        return view('unidades.show', ['unidad' => $unidad]);
    }
    public function edit($id){
        $unidad = Unidad:: findOrfail($id);
        return view('unidades.edit',['unidad' => $unidad]);
    }
    public function update(Request $request, $id){
        $request ->validate([
            'nombre_unidad'=>'required',
            'descripcion'=>'required',
            'fecha_creacion'=>'required',
           ]);
           $unidad = Unidad:: findOrfail($id);
           $unidad ->nombre_unidad = $request->nombre_unidad;
           $unidad ->descripcion = $request->descripcion;
           $unidad ->fecha_creacion = $request->fecha_creacion;
           
        $unidad->save();
         return redirect()->route(route:'unidades.index')->with('mensaje','Se actualizo la unidad correctamente');

    }
    public function destroy($id){
        Unidad::destroy($id);
         return redirect()->route(route:'unidades.index')->with('mensaje','Se elimino la unidad correctamente');

    }
}