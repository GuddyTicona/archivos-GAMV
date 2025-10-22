<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArchivoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'codigo_archivo' => 'required|string',
			'descripcion_documento' => 'string',
			'tomo' => 'string',
			'numero_foja' => 'string',
			'gestion' => 'string',
			'unidad_instalacion' => 'string',
			'observaciones' => 'string',
			'fecha_registro' => 'required',
			'estado' => 'required|string',
            'documento_adjunto' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ];
    }
}
