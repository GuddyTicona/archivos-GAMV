<!-- Información General -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">Información General</div>
    <div class="card-body">

        <!-- Fila 1: Entidad y Unidad -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Entidad</label>
                <input type="text" name="entidad" class="form-control"
                    value="{{ old('entidad', $financiera->entidad) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="unidad_id">Unidad</label>
                <select name="unidad_id" class="form-control" required>
                    <option value="">-- Selecciona una unidad --</option>
                    @foreach($unidades as $id => $nombre)
                    <option value="{{ $id }}" {{ old('unidad_id', $financiera?->unidad_id) == $id ? 'selected' : '' }}>
                        {{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Fila 2: Área receptora y Estado del Documento -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="area_id">Área receptora</label>
                <select name="area_id" class="form-control" required>
                    <option value="">Seleccione un área</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}"
                        {{ old('area_id', $financiera?->area_id) == $area->id ? 'selected' : '' }}>
                        {{ $area->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="estado_documento">Estado del Documento</label>
                <select name="estado_documento" class="form-control" required>
                    <option value="">-- Selecciona estado --</option>
                    <option value="pendiente"
                        {{ old('estado_documento', $financiera?->estado_documento) == 'pendiente' ? 'selected' : '' }}>
                        Pendiente
                    </option>
                    <option value="aprobado"
                        {{ old('estado_documento', $financiera?->estado_documento) == 'aprobado' ? 'selected' : '' }}>
                        Aprobado
                    </option>
                    <option value="rechazado"
                        {{ old('estado_documento', $financiera?->estado_documento) == 'rechazado' ? 'selected' : '' }}>
                        Rechazado
                    </option>
                </select>
            </div>
        </div>

    </div>
</div>

<!-- Datos del Documento -->
<div class="card mb-4">
    <div class="card-header bg-secondary text-white">Datos del Documento</div>
    <div class="card-body">
        <div class="row">
            @foreach ([
                'tipo_documento' => 'Tipo Documento',
                'tipo_ejecucion' => 'Tipo Ejecución',
                'fecha_documento' => 'Fecha Documento',
                'numero_compromiso' => 'N° Compromiso',
                'numero_devengado' => 'N° Devengado',
                'numero_pago' => 'N° Pago'
            ] as $name => $label)
                <div class="col-md-4 mb-3">
                    <label>{{ $label }}</label>
                    <input type="{{ $name == 'fecha_documento' ? 'date' : 'text' }}" name="{{ $name }}" class="form-control"
                        value="{{ old($name, $financiera->$name) }}">
                </div>
            @endforeach

            <!-- Archivo Adjunto -->
            <div class="col-md-6 mb-3">
                <label>Documento Adjunto</label>
                <input type="file" name="documento_adjunto" class="form-control">
                @if ($financiera->documento_adjunto)
                    <small class="text-muted">Documento actual:
                        <a href="{{ asset('storage/' . $financiera->documento_adjunto) }}" target="_blank">Ver</a>
                    </small>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Preventivos -->
<div class="card mb-4">
    <div class="card-header bg-info text-white">Preventivos</div>
    <div class="card-body" id="preventivos-wrapper">
        @foreach ($financiera->preventivos ?? [null] as $index => $preventivo)
        <div class="row mb-3 preventivo-item border p-2 rounded">
            @if ($preventivo)
                <input type="hidden" name="preventivos[{{ $index }}][id]" value="{{ $preventivo->id }}">
            @endif
            <input type="hidden" name="preventivos[{{ $index }}][financiera_id]" value="{{ $financiera->id }}">

            <div class="col-md-3">
                <label>N° Preventivo</label>
                <input type="text" name="preventivos[{{ $index }}][numero_preventivo]" class="form-control"
                    value="{{ old('preventivos.'.$index.'.numero_preventivo', $preventivo->numero_preventivo ?? '') }}">
            </div>
            <div class="col-md-3">
                <label>Total Pago</label>
                <input type="number" step="0.001" name="preventivos[{{ $index }}][total_pago]" class="form-control"
                    value="{{ old('preventivos.'.$index.'.total_pago', $preventivo->total_pago ?? '') }}">
            </div>
            <div class="col-md-3">
                <label>Descripción</label>
                <input type="text" name="preventivos[{{ $index }}][descripcion_gasto]" class="form-control"
                    value="{{ old('preventivos.'.$index.'.descripcion_gasto', $preventivo->descripcion_gasto ?? '') }}">
            </div>
            <div class="col-md-3">
                <label>Empresa</label>
                <input type="text" name="preventivos[{{ $index }}][empresa]" class="form-control"
                    value="{{ old('preventivos.'.$index.'.empresa', $preventivo->empresa ?? '') }}">
            </div>
        </div>
        @endforeach
    </div>
    <div class="card-footer text-end">
        <button type="button" class="btn btn-sm btn-outline-success" onclick="agregarPreventivo()">+ Agregar otro preventivo</button>
    </div>
</div>

<!-- Botones de acción -->
<!-- Botones de acción -->
<div class="card mb-4">
    <div class="card-footer text-end">
        @if(isset($financiera) && $financiera->exists)
            <button type="submit" class="btn btn-primary">Actualizar</button>
        @else
            <button type="submit" class="btn btn-primary">Guardar y Enviar</button>
        @endif
        <a href="{{ route('smaf.financieras.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>


<!-- Script JS para agregar preventivo -->
<script>
let financieraId = {{ $financiera->id ?? 'null' }};
let index = {{ isset($financiera->preventivos) ? count($financiera->preventivos) : 0 }};

function agregarPreventivo() {
    const wrapper = document.getElementById('preventivos-wrapper');
    const html = `
        <div class="row mb-3 preventivo-item border p-2 rounded">
            <input type="hidden" name="preventivos[${index}][financiera_id]" value="${financieraId}">
            <div class="col-md-3">
                <label for="preventivos_${index}_numero_preventivo">N° Preventivo</label>
                <input type="text" id="preventivos_${index}_numero_preventivo" name="preventivos[${index}][numero_preventivo]" class="form-control" placeholder="N° Preventivo">
            </div>
            <div class="col-md-3">
                <label for="preventivos_${index}_total_pago">Total Pago</label>
                <input type="number" step="0.001" id="preventivos_${index}_total_pago" name="preventivos[${index}][total_pago]" class="form-control" placeholder="Total Pago">
            </div>
            <div class="col-md-3">
                <label for="preventivos_${index}_descripcion_gasto">Descripción</label>
                <input type="text" id="preventivos_${index}_descripcion_gasto" name="preventivos[${index}][descripcion_gasto]" class="form-control" placeholder="Descripción">
            </div>
            <div class="col-md-3">
                <label for="preventivos_${index}_empresa">Empresa</label>
                <input type="text" id="preventivos_${index}_empresa" name="preventivos[${index}][empresa]" class="form-control" placeholder="Empresa">
            </div>
        </div>`;
    wrapper.insertAdjacentHTML('beforeend', html);
    index++;
}
</script>
