<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancieraRequest extends FormRequest
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
			'entidad' => 'required|string',
			'descripcion_gasto' => 'string',
			'total_pago' => 'required',
			'estado_documento' => 'required',
			'tipo_documento' => 'required|string',
			'tipo_ejecucion' => 'required|string',
			'documento_adjunto' => 'string',
			'numero_hoja_ruta' => 'string',
			'numero_preventivo' => 'string',
			'numero_compromiso' => 'string',
			'numero_devengado' => 'string',
			'numero_pago' => 'string',
			'numero_secuencia' => 'string',
        ];
    }
}
