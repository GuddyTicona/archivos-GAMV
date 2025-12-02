<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    
    public function view()
    {
        return view('chat');
    }

   
    public function handle(Request $request)
    {
        $mensaje = $request->input('message');

       
        $respuesta = "Recibí tu mensaje: " . $mensaje;

        return response()->json([
            'response' => $respuesta
        ]);
    }
}
