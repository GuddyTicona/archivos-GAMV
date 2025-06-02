<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileAssistantController extends Controller
{
    // Mostrar la vista del asistente
    public function index()
    {
        return view('assistant');
    }

    // Normalizar texto: minúsculas, sin tildes ni caracteres especiales
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

    // Procesar mensajes del usuario y responder
    public function handleMessage(Request $request)
    {
        $message = $this->normalizeText($request->input('message'));

        $patterns = [
            [
                'pattern' => '/\b(hola|buenos dias|buenas tardes|buenas noches|hey|que tal)\b/',
                'reply' => '¡Hola! Soy tu asistente para el sistema de archivos. ¿En qué puedo ayudarte?'
            ],
            [
                'pattern' => '/\b(crea(r)?|crear|creo|quiero crear|hacer|nuevo|añadir|agregar|subir)\b.*\b(archivo|documento|file)\b/',
                'reply' => 'Ve a la seccion de archivos, ahi se encuentra el boton de crear, donde llenas los datos y se registra tu archivo.'
            ],
            [
                'pattern' => '/\b(borrar|eliminar|quitar|suprimir)\b.*\b(archivo|documento|file)\b/',
                'reply' => 'Para borrar un archivo, selecciona el archivo que deseas eliminar y haz clic en "Eliminar". ¡Ten cuidado, esta acción no se puede deshacer!'
            ],
            [
                'pattern' => '/\b(listar|ver|mostrar|donde estan|donde estan)\b.*\b(archivos|documentos|files)\b/',
                'reply' => 'Puedes ver todos los archivos almacenados en la seccion "Listado de Archivos".'
            ],
            [
                'pattern' => '/\b(que es|definir|explica|me dices)\b.*\b(archivo|documento|file)\b/',
                'reply' => 'Un archivo es un conjunto de informacion almacenada en formato digital que puedes guardar y gestionar en el sistema.'
            ],
            [
                'pattern' => '/\b(buscar|encontrar|como encuentro|donde esta)\b.*\b(archivo|documento|file)\b/',
                'reply' => 'En el listado de archivos puedes buscar por nombre, fecha o tipo de archivo utilizando la barra de busqueda.'
            ],
            [
                'pattern' => '/\b(descargar|bajar|obtener)\b.*\b(archivo|documento|file)\b/',
                'reply' => 'Para descargar un archivo, ve al listado de archivos, selecciona el que necesitas y haz clic en "Descargar".'
            ],
            [
                'pattern' => '/\b(crear|nueva|añadir|agregar)\b.*\b(unidad|drive|disco)\b/',
                'reply' => 'Para crear una unidad de almacenamiento, dirijete a la seccion "Unidades", haz clic en "Nueva Unidad" y completa los datos requeridos.'
            ],
            [
                'pattern' => '/\b(listar|ver|mostrar)\b.*\b(unidades|drives|discos)\b/',
                'reply' => 'Puedes ver todas las unidades disponibles en la seccion "Unidades". Ahi podras acceder a los archivos contenidos en cada una.'
            ],
            [
                'pattern' => '/\b(asignar|dar|conceder)\b.*\b(permiso|acceso)\b/',
                'reply' => 'Para asignar permisos tiene solo el acceso el administrador.'
            ],
            [
                'pattern' => '/\b(editar|modificar|actualizar|cambiar)\b.*\b(archivo|documento|file)\b/',
                'reply' => 'Para editar un archivo, entra a su detalle desde el listado, haz clic en "Editar", realiza los cambios y guarda.'
            ],
            [
                'pattern' => '/\b(tamano|peso|cuanto pesa|tamaño)\b.*\b(archivo|documento|file)\b/',
                'reply' => 'El tamaño del archivo se muestra en la columna de "Tamaño" en el listado de archivos.'
            ],
        ];

        foreach ($patterns as $item) {
            if (preg_match($item['pattern'], $message)) {
                return response()->json(['reply' => $item['reply']]);
            }
        }

        return response()->json(['reply' => 'Disculpa, no entendi tu mensaje. Por favor, intenta con otra pregunta relacionada con el sistema de archivos.']);
    }
}
