<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FileAssistantController extends Controller
{
    public function index()
    {
        return view('assistant');
    }

    private function normalizeText($text)
    {
        $text = strtolower(trim($text));
        $text = str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ'],
            ['a', 'e', 'i', 'o', 'u', 'u', 'n'],
            $text
        );
        $text = preg_replace('/[^a-z0-9\s]/', '', $text);
        return $text;
    }

    public function handleMessage(Request $request)
    {
        $message = $this->normalizeText($request->input('message'));

        // 1️⃣ Patrones predefinidos
        $patterns = [
            ['pattern' => '/\b(hola|buenos dias|buenas tardes|buenas noches|que tal|hey)\b/', 
             'reply' => '¡Hola! Soy tu asistente del sistema de archivos. ¿Cómo puedo ayudarte?'],
            ['pattern' => '/\b(como|donde)?\b.*(buscar|encuentro|localizo).*\b(archivo|documento)\b/', 
             'reply' => 'En el listado de archivos puedes buscar por nombre, fecha o tipo de archivo utilizando la barra de búsqueda.'],
            ['pattern' => '/\b(como|donde|a donde)?\b.*\b(agrego|anado|añadir|subo|registro|creo).*\b(documento|archivo|archivos)?\b/', 
             'reply' => 'Ve a la sección de "Archivos", llena el formulario con los datos requeridos y haz clic en guardar.'],
            ['pattern' => '/\b(ver|mostrar|listar|consultar)\b/', 
             'reply' => 'Puedes ir a la sección "Mis Archivos" donde verás la lista completa de documentos registrados.'],
            ['pattern' => '/\b(unidades|direcciones|oficinas|dependencias)\b/', 
             'reply' => "Las unidades disponibles son: SMAF, Tesorería, Despacho, Archivos, Finanzas, Jurídica, Recursos Humanos, Educación, Salud, Infraestructura, Medio Ambiente."]
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern['pattern'], $message)) {
                return response()->json(['reply' => $pattern['reply']]);
            }
        }

        // 2️⃣ Si no coincide, intentar con DeepSeek
        $reply = $this->callDeepSeek($message);

        // 3️⃣ Si DeepSeek falla o no responde, usar modo simulado
        if (str_contains($reply, 'Error al conectar con DeepSeek') || str_contains($reply, 'Insufficient Balance')) {
            $reply = $this->simulateResponse($message);
        }

        return response()->json(['reply' => $reply]);
    }

    private function callDeepSeek($message)
    {
        $apiKey = env('DEEPSEEK_API_KEY');
        $url = 'https://api.deepseek.com/chat/completions';

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])
            ->withOptions([
                // ⚠️ Cambia a false si aún te da error SSL en desarrollo local
                'verify' => false,
            ])
            ->post($url, [
                'model' => 'deepseek-chat',
                'messages' => [
                    ['role' => 'system', 'content' => 'Eres un asistente útil especializado en gestión de archivos financieros.'],
                    ['role' => 'user', 'content' => $message],
                ],
                'stream' => false,
            ]);

            $data = $response->json();

            if (!isset($data['choices'][0]['message']['content'])) {
                return 'DeepSeek API respondió pero no tiene contenido válido: ' . json_encode($data);
            }

            return $data['choices'][0]['message']['content'];

        } catch (\Exception $e) {
            return 'Error al conectar con DeepSeek: ' . $e->getMessage();
        }
    }

    private function simulateResponse($message)
    {
        $simulated = [
            'hola' => '¡Hola! Parece que la IA remota no está disponible, pero puedo seguir ayudándote localmente.',
            'buscar' => 'Puedes buscar tus archivos por nombre o tipo en la sección de gestión.',
            'subir' => 'Para subir un archivo, ve al menú principal y selecciona “Agregar nuevo documento”.',
            'ver' => 'Puedes visualizar todos tus archivos en la pestaña “Mis Archivos”.',
        ];

        foreach ($simulated as $key => $reply) {
            if (str_contains($message, $key)) {
                return $reply . ' (respuesta simulada)';
            }
        }

        return 'No tengo conexión con DeepSeek, pero tu mensaje fue recibido correctamente. (modo simulado)';
    }
}
