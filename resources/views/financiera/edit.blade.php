@extends('layouts.admin')

@section('content')
<section class="content container-fluid">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Actualizar Registro Financiero</h5>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="{{ route('financieras.update', $financiera->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- Validación --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>¡Hay errores en el formulario!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Información General --}}
                    <div class="card mb-4 border">
                        <div class="card-header bg-primary text-white">Información General</div>
                        <div class="card-body row g-3">
                            <div class="col-md-4">
                                <label for="entidad">Entidad</label>
                                <input type="text" name="entidad" class="form-control" value="{{ old('entidad', $financiera->entidad) }}">
                            </div>
                            <div class="col-md-4">
                                <label for="unidad_id">Unidad</label>
                                <select name="unidad_id" class="form-select">
                                    @foreach($unidades as $id => $nombre)
                                        <option value="{{ $id }}" {{ $financiera->unidad_id == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Preventivos --}}
                    <div class="card mb-4 border">
                        <div class="card-header bg-warning text-dark">Preventivos del Trámite</div>
                        <div class="card-body" id="preventivos-wrapper">
                            @foreach($financiera->preventivos as $index => $p)
                                <div class="row g-3 preventivo-item mb-3 border-bottom pb-3">
                                    <input type="hidden" name="preventivos[{{ $index }}][id]" value="{{ $p->id }}">
                                    <div class="col-md-4">
                                        <label>N° Preventivo</label>
                                        <input type="text" name="preventivos[{{ $index }}][numero_preventivo]" class="form-control" value="{{ $p->numero_preventivo }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Total Pago</label>
                                        <input type="number" step="0.001" name="preventivos[{{ $index }}][total_pago]" class="form-control" value="{{ $p->total_pago }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Descripción</label>
                                        <input type="text" name="preventivos[{{ $index }}][descripcion_gasto]" class="form-control" value="{{ $p->descripcion_gasto }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Empresa</label>
                                        <input type="text" name="preventivos[{{ $index }}][empresa]" class="form-control" value="{{ $p->empresa }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Beneficiario</label>
                                        <input type="text" name="preventivos[{{ $index }}][beneficiario]" class="form-control" value="{{ $p->beneficiario }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer text-end bg-light">
                            <button type="button" class="btn btn-outline-success btn-sm" onclick="agregarPreventivo()">+ Agregar otro preventivo</button>
                        </div>
                    </div>

                    {{-- Números de Trámite --}}
                    <div class="card mb-4 border">
                        <div class="card-header bg-dark text-white">Números de Trámite</div>
                        <div class="card-body row g-3">
                            @foreach ([
                                'numero_hoja_ruta' => 'N° Hoja Ruta',
                                'numero_compromiso' => 'N° Compromiso',
                                'numero_devengado' => 'N° Devengado',
                                'numero_pago' => 'N° Pago',
                                'numero_secuencia' => 'N° Secuencia'
                            ] as $name => $label)
                                <div class="col-md-4">
                                    <label>{{ $label }}</label>
                                    <input type="text" class="form-control" name="{{ $name }}" value="{{ old($name, $financiera->$name) }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Datos del Documento --}}
                    <div class="card mb-4 border">
                        <div class="card-header bg-success text-white">Datos del Documento</div>
                        <div class="card-body row g-3">
                            <div class="col-md-4">
                                <label>Estado del Documento</label>
                                <select name="estado_documento" class="form-select">
                                    <option value="">Seleccione</option>
                                    <option value="pendiente" {{ $financiera->estado_documento == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="aprobado" {{ $financiera->estado_documento == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                                    <option value="rechazado" {{ $financiera->estado_documento == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Tipo Documento</label>
                                <input type="text" class="form-control" name="tipo_documento" value="{{ $financiera->tipo_documento }}">
                            </div>
                            <div class="col-md-4">
                                <label>Tipo Ejecución</label>
                                <input type="text" class="form-control" name="tipo_ejecucion" value="{{ $financiera->tipo_ejecucion }}">
                            </div>
                            <div class="col-md-4">
                                <label>Fecha Documento</label>
                                <input type="date" class="form-control" name="fecha_documento" value="{{ $financiera->fecha_documento }}">
                            </div>
                            <div class="col-md-4">
                                <label>Documento Adjunto</label>
                                <input type="file" class="form-control" name="documento_adjunto">
                                @if ($financiera->documento_adjunto)
                                    <a href="{{ asset('storage/' . $financiera->documento_adjunto) }}" target="_blank" class="d-block mt-1 text-primary">Ver documento actual</a>
                                @endif
                            </div>
                        </div>
                    </div>

                   <!-- Área receptora -->
        <div class="form-group mb-4">
            <label for="area_id">Área receptora</label>
            <select name="area_id" class="form-control" required>
                <option value="">Seleccione un área</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ old('area_id', $financiera?->area_id) == $area->id ? 'selected' : '' }}>
                        {{ $area->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

                    {{-- Botones --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">Actualizar</button>
                        <a href="{{ route('financieras.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Script para agregar preventivos dinámicamente --}}
<script>
let index = {{ $financiera->preventivos->count() ?? 1 }};

function agregarPreventivo() {
    const wrapper = document.getElementById('preventivos-wrapper');
    const nuevo = document.createElement('div');
    nuevo.classList.add('row', 'g-3', 'preventivo-item', 'mt-3');
    nuevo.innerHTML = `
        <div class="col-md-4">
            <input type="text" name="preventivos[${index}][numero_preventivo]" class="form-control" placeholder="N° Preventivo">
        </div>
        <div class="col-md-4">
            <input type="number" name="preventivos[${index}][total_pago]" step="0.001" class="form-control" placeholder="Total Pago">
        </div>
        <div class="col-md-4">
            <input type="text" name="preventivos[${index}][descripcion_gasto]" class="form-control" placeholder="Descripción del gasto">
        </div>
        <div class="col-md-4">
            <input type="text" name="preventivos[${index}][empresa]" class="form-control" placeholder="Empresa">
        </div>
        <div class="col-md-4">
            <input type="text" name="preventivos[${index}][beneficiario]" class="form-control" placeholder="Beneficiario">
        </div>
    `;
    wrapper.appendChild(nuevo);
    index++;
}
</script>
@endsection
