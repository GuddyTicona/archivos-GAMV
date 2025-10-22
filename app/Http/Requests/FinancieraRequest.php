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
			
            'numero_foja'=>'string',
			'estado_documento' => 'required',
			'tipo_documento' => 'required|string',
			'tipo_ejecucion' => 'required|string',
			'documento_adjunto' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
			'numero_hoja_ruta' => 'string',
			'numero_compromiso' => 'string',
			'numero_devengado' => 'string',
			'numero_pago' => 'string',
			
            'estado_actualizado' => 'timestamp',
             'preventivos' => 'required|array|min:1', 
            'preventivos.*.numero_preventivo' => 'required|string|max:50',
            'preventivos.*.numero_secuencia' => 'nullable|string|max:50',
            'preventivos.*.total_pago' => 'required|numeric',
            'preventivos.*.descripcion_gasto' => 'nullable|string',
            'preventivos.*.empresa' => 'nullable|string|max:255',
            'preventivos.*.beneficiario' => 'nullable|string|max:255',
             'enviado_a_tesoreria' => 'nullable|boolean',
        ];
    }
}