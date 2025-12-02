<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class FileAssistantController extends Controller
{
    public function welcome()
    {
        $respuesta = '
        <div style="font-family: Arial, sans-serif; line-height: 1.6;">
            <p><strong>👋 ¡Hola!</strong> Bienvenido/a al asistente de prueba.</p>
            <p>Puedes escribir cualquier pregunta y verás cómo responde la IA.</p>
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
 

        // Enviamos la pregunta directamente a la IA para cualquier tema
        $iaReply = $this->askDeepSeek($message);
        return response()->json(['reply' => $iaReply]);
    }

    
    public function askDeepSeek(string $message)
    {
        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) return '⚠️ Falta configurar la API Key de OpenRouter.';

       
        $contexto = "
Eres un asistente conversacional capaz de responder cualquier pregunta de manera útil y clara.
Usuario preguntó: '{$message}'
";

        $payload = [
           'model' => 'deepseek/deepseek-chat-v3.1:fast',

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

            // Limpiar HTML, permitiendo solo etiquetas básicas
            $iaReplyClean = preg_replace_callback('/<[^>]*?>/', function ($matches) {
                $allowed = ['p', 'ol', 'li', 'strong', 'br'];
                preg_match('/<\/?(\w+)/', $matches[0], $tag);
                return isset($tag[1]) && in_array($tag[1], $allowed) ? $matches[0] : '';
            }, $iaReply);

            return $iaReplyClean;

        } catch (\Exception $e) {
            Log::error('Error IA prueba: ' . $e->getMessage());
            return '⚠️ No fue posible conectarse con el servidor de IA. Detalle: ' . $e->getMessage();
        }
    }
}
