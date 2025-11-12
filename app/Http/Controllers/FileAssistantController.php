<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class FileAssistantController extends Controller
{
    public function welcome()
    {
        $respuesta = '
        <div style="font-family: Arial, sans-serif; line-height: 1.6;">
            <p><strong>👋 ¡Hola!</strong> Bienvenido/a al <strong>Sistema de Gestión de Archivos Virtual (GAMV)</strong>.</p>
            <p>Puedes escribir el nombre, descripción o fecha de creación de una unidad en lenguaje natural, y te mostraré la información relacionada.</p>
            <p>También puedo guiarte sobre cómo registrar una nueva unidad si no existe.</p>
        </div>';
        return response()->json(['reply' => $respuesta]);
    }

    public function handleMessage(Request $request)
    {
        $message = trim($request->input('message', ''));
        if (empty($message)) return response()->json(['reply' => 'Por favor, escribe un mensaje.']);

        if (preg_match('/\b(hola|buenas|inicio|ayuda|empezar)\b/i', $message)) {
            return $this->welcome();
        }

        if (preg_match('/\blistar unidades\b/i', $message)) {
            return response()->json(['reply' => $this->listarUnidades()]);
        }

        // Procesar lenguaje natural para buscar unidades
        $criterios = $this->interpretarMensajeIA($message);

        $unidades = $this->buscarUnidadesDB($criterios);

        if ($unidades->isEmpty()) {
            // No hay coincidencias → guiar con IA
            $iaReply = $this->askDeepSeek($message);
            return response()->json(['reply' => $iaReply]);
        }

        // Mostrar resultados reales
        return response()->json(['reply' => $this->formatearUnidades($unidades, '📋 Unidades encontradas')]);
    }

    private function listarUnidades()
    {
        $unidades = DB::table('unidades')->limit(10)->get();
        if ($unidades->isEmpty()) return '<p>No hay unidades registradas.</p>';
        return $this->formatearUnidades($unidades, '📋 Unidades registradas');
    }

    // --- Interpretar mensaje con IA y retornar criterios de búsqueda ---
    private function interpretarMensajeIA($mensaje)
    {
        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) return [];

        $prompt = "
Eres un asistente que interpreta consultas en lenguaje natural para buscar en la tabla 'unidades' (campos: nombre_unidad, descripcion, fecha_creacion). 
Recibe un mensaje del usuario y devuelve un JSON con los criterios de búsqueda para cada campo.
Ejemplo de salida: {\"nombre_unidad\":\"Educacion\", \"descripcion\":\"archivos\", \"fecha_creacion\":\"2025-07\"}
Usuario mensaje: '{$mensaje}'
";

        $client = new Client();
        try {
            $response = $client->post('https://openrouter.ai/api/v1/chat/completions', [
                'headers' => [
                    'Authorization' => "Bearer {$apiKey}",
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'model' => 'deepseek/deepseek-chat-v3.1:free',
                    'messages' => [
                        ['role' => 'system', 'content' => $prompt],
                        ['role' => 'user', 'content' => $mensaje]
                    ],
                    'temperature' => 0.3
                ],
                'timeout' => 60
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            $text = $result['choices'][0]['message']['content'] ?? '{}';
            $json = json_decode($text, true);
            return is_array($json) ? $json : [];

        } catch (\Exception $e) {
            Log::error('Error IA interpretación: ' . $e->getMessage());
            return [];
        }
    }

    // --- Buscar unidades en DB según criterios de IA ---
    private function buscarUnidadesDB(array $criterios)
    {
        $query = DB::table('unidades');

        if (!empty($criterios['nombre_unidad'])) {
            $query->where('nombre_unidad', 'like', "%{$criterios['nombre_unidad']}%");
        }
        if (!empty($criterios['descripcion'])) {
            $query->where('descripcion', 'like', "%{$criterios['descripcion']}%");
        }
        if (!empty($criterios['fecha_creacion'])) {
            $query->where('fecha_creacion', 'like', "%{$criterios['fecha_creacion']}%");
        }

        return $query->limit(10)->get();
    }

    private function formatearUnidades($unidades, $titulo)
    {
        $html = "<div style='font-family: Arial, sans-serif; line-height: 1.6;'>";
        $html .= "<h4>{$titulo}</h4><ol>";
        foreach ($unidades as $u) {
            $html .= "<li>
                <strong>ID:</strong> {$u->id} <br>
                <strong>Nombre:</strong> {$u->nombre_unidad} <br>
                <strong>Descripción:</strong> {$u->descripcion} <br>
                <strong>Fecha creación:</strong> {$u->fecha_creacion}
            </li><br>";
        }
        $html .= "</ol></div>";
        return $html;
    }

    private function askDeepSeek(string $message)
    {
        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) return '⚠️ Falta configurar la API Key de OpenRouter.';

        $contexto = "
Eres un asistente del Sistema GAMV. 
No se encontraron registros en la tabla 'unidades'. Guía cómo crear una unidad y qué campos se necesitan.
Usuario preguntó: '{$message}'
";

        $payload = [
            'model' => 'deepseek/deepseek-chat-v3.1:free',
            'messages' => [
                ['role' => 'system', 'content' => $contexto],
                ['role' => 'user', 'content' => $message]
            ],
            'temperature' => 0.7
        ];

        $client = new Client();
        try {
            $response = $client->post('https://openrouter.ai/api/v1/chat/completions', [
                'headers' => [
                    'Authorization' => "Bearer {$apiKey}",
                    'Content-Type' => 'application/json'
                ],
                'json' => $payload,
                'timeout' => 60
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            $iaReply = $result['choices'][0]['message']['content'] ?? 'No obtuve respuesta de la IA.';

            $iaReplyClean = preg_replace_callback('/<[^>]*?>/', function ($matches) {
                $allowed = ['p', 'ol', 'li', 'strong', 'br'];
                preg_match('/<\/?(\w+)/', $matches[0], $tag);
                return isset($tag[1]) && in_array($tag[1], $allowed) ? $matches[0] : '';
            }, $iaReply);

            return $iaReplyClean;

        } catch (\Exception $e) {
            Log::error('Error IA guía: ' . $e->getMessage());
            return '⚠️ No fue posible conectarse con el servidor de IA.';
        }
    }
}
