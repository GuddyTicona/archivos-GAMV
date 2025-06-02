<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidad;
use App\Models\Categoria;
use App\Models\Archivo;
use App\Models\Financiera;
use App\Models\HistorialArchivo;
use App\Models\User;
class AdminController extends Controller
{
    //
    public function index(){
        

    $unidades = Unidad::all();
    $archivos = Archivo::all();
    $categorias = Categoria::all();
    $financieras = Financiera::all();
    $historialArchivos = HistorialArchivo::all(); 
    $usuarios = User::all();

    return view('index', [
        'unidades' => $unidades,
        'archivos' => $archivos,
        'categorias' => $categorias,
        'financieras' => $financieras,
        'historialArchivos' => $historialArchivos, 
        'usuarios' => $usuarios
    ]);
}


}
