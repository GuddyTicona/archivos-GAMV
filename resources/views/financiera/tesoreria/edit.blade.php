@extends('layouts.admin')

@section('content')
<div class="container">

    <form action="{{ route('tesoreria.financieras.update', $financiera->id) }}" method="POST">

        @csrf
        @method('PUT')

        {{-- INFORMACIÓN GENERAL (SÓLO LECTURA) --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-center">Información General</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Entidad</label>
                        <input type="text" class="form-control" value="{{ $financiera->entidad }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Unidad</label>
                        <input type="text" class="form-control" value="{{ $financiera->unidad->nombre_unidad ?? '' }}"
                            readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="area_id">Área receptora</label>
                        <div class="form-control" readonly>{{ $financiera->area->nombre ?? 'No asignada' }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Estado del Documento</label>
                        <input type="text" class="form-control" value="{{ ucfirst($financiera->estado_documento) }}"
                            readonly>
                    </div>
                </div>
            </div>
        </div>

        {{-- DATOS DEL DOCUMENTO (SÓLO LECTURA) --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-center">Datos del Documento</div>
            <div class="card-body">
                <div class="row">
                    @foreach ([
                    'tipo_documento' => 'Tipo Documento',
                    'tipo_ejecucion' => 'Tipo Ejecución',
                    'fecha_documento' => 'Fecha Documento',
                    'numero_compromiso' => 'N° Compromiso',
                    'numero_devengado' => 'N° Devengado',
                    'numero_pago' => 'N° Pago'
                    ] as $campo => $label)
                    <div class="col-md-4 mb-3">
                        <label>{{ $label }}</label>
                        <input type="{{ $campo == 'fecha_documento' ? 'date' : 'text' }}" class="form-control"
                            value="{{ $financiera->$campo }}" readonly>
                    </div>
                    @endforeach

                    @if($financiera->documento_adjunto)
                    <div class="col-md-6 mb-3">
                        <label>Documento Adjunto</label><br>
                        <a href="{{ asset('storage/' . $financiera->documento_adjunto) }}" target="_blank"
                            class="btn btn-sm btn-outline-info">
                            Ver Documento
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- INFORMACIÓN DE RUTA (SÓLO LECTURA) --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white text-center">
                Información de Ruta
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">N° Foja</label>
                        <input type="text" class="form-control" value="{{ $financiera->numero_foja }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">N° Hoja Ruta</label>
                        <input type="text" class="form-control" value="{{ $financiera->numero_hoja_ruta }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Acta despacho</label>
                        <input type="text" class="form-control" value="{{ $financiera->areaDespacho->nombre ?? '' }}"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="area_archivo_id" class="form-label">Acta archivo</label>
                        <select name="area_archivo_id" id="area_archivo_id"
                            class="form-control @error('area_archivo_id') is-invalid @enderror" required>
                            <option value="">-- Seleccione un área archivo --</option>
                            @foreach($areasArchivos as $areaArchivo)
                            <option value="{{ $areaArchivo->id }}"
                                {{ (old('area_archivo_id', $financiera->area_archivo_id ?? '') == $areaArchivo->id) ? 'selected' : '' }}>
                                {{ $areaArchivo->nombre }}
                            </option>
                            @endforeach
                        </select>
                        @error('area_archivo_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- PREVENTIVOS (EDITABLE) --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-center">Preventivos</div>
            <div class="card-body">
                <div id="preventivos-container">
                    @foreach($financiera->preventivos as $index => $preventivo)
                    <div class="row g-3 mb-3 preventivo-item">
                        <input type="hidden" name="preventivos[{{ $index }}][id]" value="{{ $preventivo->id }}">

                        <div class="col-md-2">
                            <label class="form-label">N° Preventivo</label>
                            <input type="text" class="form-control" name="preventivos[{{ $index }}][numero_preventivo]"
                                value="{{ $preventivo->numero_preventivo }}">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Secuencia</label>
                            <input type="text" class="form-control" name="preventivos[{{ $index }}][numero_secuencia]"
                                value="{{ $preventivo->numero_secuencia }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Empresa</label>
                            <input type="text" class="form-control" name="preventivos[{{ $index }}][empresa]"
                                value="{{ $preventivo->empresa }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Beneficiario</label>
                            <input type="text" class="form-control" name="preventivos[{{ $index }}][beneficiario]"
                                value="{{ $preventivo->beneficiario }}">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Total Pago (Bs)</label>
                            <input type="number" step="0.01" class="form-control"
                                name="preventivos[{{ $index }}][total_pago]" value="{{ $preventivo->total_pago }}">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control"
                                name="preventivos[{{ $index }}][descripcion_gasto]">{{ $preventivo->descripcion_gasto }}</textarea>
                        </div>
                    </div>
                    @endforeach
                </div>




                <button type="button" class="btn btn-outline-primary" id="add-preventivo">+ Agregar Preventivo</button>
            </div>
        </div>

        {{-- BOTONES --}}
        <div class="d-flex justify-content-end">
            <a href="{{ route('tesoreria.financieras.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </div>
    </form>
</div>

{{-- AGREGAR PREVENTIVOS --}}
<script>
document.getElementById('add-preventivo').addEventListener('click', function() {
    const container = document.getElementById('preventivos-container');
    const index = container.querySelectorAll('.preventivo-item').length;

    const html = `
        <div class="row g-3 mb-3 preventivo-item">
            <div class="col-md-2">
                <label class="form-label">N° Preventivo</label>
                <input type="text" class="form-control" name="preventivos[${index}][numero_preventivo]">
            </div>
            <div class="col-md-2">
                <label class="form-label">Secuencia</label>
                <input type="text" class="form-control" name="preventivos[${index}][numero_secuencia]">
            </div>
            <div class="col-md-3">
                <label class="form-label">Empresa</label>
                <input type="text" class="form-control" name="preventivos[${index}][empresa]">
            </div>
            <div class="col-md-3">
                <label class="form-label">Beneficiario</label>
                <input type="text" class="form-control" name="preventivos[${index}][beneficiario]">
            </div>
            <div class="col-md-2">
                <label class="form-label">Total Pago (Bs)</label>
                <input type="number" step="0.01" class="form-control" name="preventivos[${index}][total_pago]">
            </div>
            <div class="col-md-12">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="preventivos[${index}][descripcion_gasto]"></textarea>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
});
</script>
@endsection