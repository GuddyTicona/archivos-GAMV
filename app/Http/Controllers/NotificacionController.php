<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Marcar una notificación como leída
     */
    public function marcarLeida($id)
{
    try {
        // Buscar la notificación por ID
        $notificacion = Notificacion::findOrFail($id);
        
        // Log antes
        \Log::info('Antes de marcar:', ['leido' => $notificacion->leido]);
        
        // Marcar como leída
        $notificacion->leido = true;
        $notificacion->save();
        
        // Log después
        \Log::info('Después de marcar:', ['leido' => $notificacion->leido]);
        
        // Verificar en BD
        $verificacion = Notificacion::find($id);
        \Log::info('Verificación BD:', ['leido' => $verificacion->leido]);

        // Respuesta JSON para AJAX
        return response()->json([
            'success' => true,
            'notificacion_id' => $id,
            'leido' => $notificacion->leido,
            'verificacion' => $verificacion->leido
        ]);
    } catch (\Exception $e) {
        \Log::error('Error al marcar notificación:', ['error' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
}
    /**
     * Listar notificaciones no leídas (opcional, para dropdown)
     */
    public function index()
    {
        $notificaciones = Notificacion::where('para_area', 'Despacho')
            ->where('leido', false)
            ->latest()
            ->get();

        return view('notificaciones.index', compact('notificaciones'));
    }
}
