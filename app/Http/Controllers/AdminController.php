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
    // Método principal - vista del dashboard
    public function index() {
        $unidades = Unidad::all();
        $archivos = Archivo::all();
        $categorias = Categoria::all();
        $financieras = Financiera::all();
        $historialArchivos = HistorialArchivo::all(); 
        $usuarios = User::all();

        // Duplicamos la colección para cada tarjeta, sin necesidad de campo "área"
        $financierasSmaf = $financieras;
        $financierasDespacho = $financieras;
        $financierasTesoreria = $financieras;
        $financierasArchivos = $financieras;

        return view('index', [
            'unidades' => $unidades,
            'archivos' => $archivos,
            'categorias' => $categorias,
            'financierasSmaf' => $financierasSmaf,
            'financierasDespacho' => $financierasDespacho,
            'financierasTesoreria' => $financierasTesoreria,
            'financierasArchivos' => $financierasArchivos,
            'historialArchivos' => $historialArchivos, 
            'usuarios' => $usuarios
        ]);
    }

    // Método para SMAF con paginación
    public function smaf() {
        $financieras = Financiera::paginate(10); // Cambia el número según prefieras
        return view('financiera.smaf.index', ['financieras' => $financieras]);
    }

    // Método para Despacho con paginación
    public function despacho() {
        $financieras = Financiera::paginate(10);
        return view('financiera.despacho.index', ['financieras' => $financieras]);
    }

    // Método para Tesorería con paginación
    public function tesoreria() {
        $financieras = Financiera::paginate(10);
        return view('financiera.tesoreria.index', ['financieras' => $financieras]);
    }

    // Método para Archivos con paginación
    public function archivos() {
        $financieras = Financiera::paginate(10);
        return view('financiera.archivos.index', ['financieras' => $financieras]);
    }
}
