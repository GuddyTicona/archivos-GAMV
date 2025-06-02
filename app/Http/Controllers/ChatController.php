<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function respond(Request $request)
    {
        $userMessage = strtolower($request->input('message'));

        // Preguntas frecuentes
        $faq = [
            'subir archivo' => 'Para subir un archivo, haz clic en el botón "Subir archivo" en la parte superior derecha.',
            'buscar archivo' => 'Para buscar archivos, utiliza la barra de búsqueda en la parte superior.',
            'eliminar archivo' => 'Haz clic en el ícono de la papelera para eliminar un archivo.',
            'descargar archivo' => 'Haz clic sobre el nombre del archivo y selecciona "Descargar".',
            'ver archivos' => 'Tus archivos se muestran en la sección principal, organizados por fecha y tipo.',
            'carpetas' => 'Puedes organizar tus archivos en carpetas desde la barra lateral.',
        ];

        // Buscar coincidencia simple
        $respuesta = 'Lo siento, no entendí tu pregunta. Intenta con: subir archivo, buscar archivo, eliminar archivo...';

        foreach ($faq as $clave => $respuestaPosible) {
            if (str_contains($userMessage, $clave)) {
                $respuesta = $respuestaPosible;
                break;
            }
        }

        return response()->json(['reply' => $respuesta]);
    }
}
