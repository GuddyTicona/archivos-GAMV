<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $patterns = [
            // Saludos
            [
                'pattern' => '/\b(hola|buenos dias|buenas tardes|buenas noches|que tal|hey)\b/',
                'reply' => '¡Hola! Soy tu asistente del sistema de archivos. ¿Cómo puedo ayudarte?'
            ],

            // Buscar archivos
            [
                'pattern' => '/\b(como|donde)?\b.*(buscar|encuentro|localizo).*\b(archivo|documento)\b/',
                'reply' => 'En el listado de archivos puedes buscar por nombre, fecha o tipo de archivo utilizando la barra de búsqueda.'
            ],

            // Añadir o subir documento
            [
                'pattern' => '/\b(como|donde|a donde)?\b.*\b(agrego|anado|añadir|subo|registro|creo).*\b(documento|archivo|archivos)?\b/',
                'reply' => 'Ve a la sección de "Archivos", llena el formulario con los datos requeridos (como código, descripción, tomo, fojas, unidad, fecha, etc.) y luego haz clic en guardar para registrar tu documento.'
            ],

            // Ver archivos
            [
                'pattern' => '/\b(ver|mostrar|listar|consultar)\b/',
                'reply' => 'Puedes ir a la sección "Mis Archivos" donde verás la lista completa de documentos registrados.'
            ],

            // Crear archivo
            [
                'pattern' => '/\b(crear|nuevo|registrar)\b.*\b(archivo|documento)?\b/',
                'reply' => 'Ve a la sección "Archivos", llena el formulario con todos los datos solicitados y haz clic en guardar para registrar el archivo.'
            ],

            // Datos que debe tener un archivo
            [
                'pattern' => '/\b(que datos necesito|datos requeridos|informacion necesaria|datos deben tener archivo|informacion archivo)\b/',
                'reply' =>
                    "Los datos que debe tener un archivo son:\n".
                    "Código del archivo\n".
                    "Descripción breve del archivo\n".
                    "Número del tomo de archivo\n".
                    "Número de fojas de archivo\n".
                    "Gestión del archivo que se va a registrar\n".
                    "Unidad de instalación (folder, carpeta)\n".
                    "Fecha del registro que se está realizando\n".
                    "Unidad a la que pertenece el archivo\n".
                    "Tipo de clasificación del archivo"
            ],

            // Clasificación de documentos
            [
                'pattern' => '/\b(clasificacion de documentos|lista de clasificacion|tipos de clasificacion)\b/',
                'reply' => "Los tipos de clasificación pueden incluir:\n".
                           "Administrativos\n".
                           "Financieros\n".
                           "Jurídicos\n".
                           "Educativos\n".
                           "Salud\n".
                           "Medio ambiente\n".
                           "Infraestructura\n".
                           "Esto depende de la unidad correspondiente."
            ],

            // Información financiera
            [
                'pattern' => '/\b(financiera|ejecucion de gastos|datos financieros|registro financiero)\b/',
                'reply' =>
                    "En la sección Financiera debes registrar tus datos según la ejecución de gastos que realizaste.\n".
                    "El registro se efectúa poniendo todos los datos, siendo que la validación no permitirá dejar ningún campo vacío."
            ],

            // Listado simple de unidades
             [
                'pattern' => '/\b(como|donde)?\b.*(buscar|encuentro|localizo).*\b(la lista de unidades|documento)\b/',
                'reply' => 'En el seccion de unidades puedes encontrar la lista de unidades, tambien puedes realizar la busqueda de la unidad que requieras.'
            ],
            [
                'pattern' => '/\b(unidades|direcciones|oficinas|dependencias)\b/',
                'reply' =>
                    "Las unidades disponibles en el sistema son:\n".
                    "Tecnologías de Información y Comunicación\n".
                    "Dirección de Recursos Humanos\n".
                    "Dirección Jurídica\n".
                    "Dirección de Catastro\n".
                    "Dirección de Auditoría Interna\n".
                    "Dirección de Salud\n".
                    "Dirección de Educación\n".
                    "Secretaría Municipal de Desarrollo Humano\n".
                    "Dirección de Medio Ambiente\n".
                    "Dirección de Infraestructura\n".
                    "Dirección Administrativa\n".
                    "Dirección de Planificación\n".
                    "Dirección de SMAF\n".
                    "Dirección de Contabilidad\n".
                    "Unidad de Tesorería\n".
                    "Dirección Financiera"
            ],

            // Ayuda o problema
            [
                'pattern' => '/\b(ayuda|no puedo|problema|error|fallo|falla|no funciona)\b/',
                'reply' => 'Si estás teniendo problemas, intenta recargar la página. Si el problema persiste, contacta al área de soporte técnico.'
            ],
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern['pattern'], $message)) {
                return response()->json(['reply' => $pattern['reply']]);
            }
        }

        return response()->json([
            'reply' => 'Disculpa, no entendí tu consulta. Reformula tu consulta'
        ]);
    }
}
