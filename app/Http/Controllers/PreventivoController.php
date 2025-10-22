<?php

namespace App\Http\Controllers;

use App\Models\Preventivo;
use Illuminate\Http\Request;

class PreventivoController extends Controller
{
    public function index()
    {
   $preventivos = Preventivo::with('financiera')->orderBy('created_at', 'asc')->paginate(10);

        return view('preventivos.index', compact('preventivos'));
    }
}
