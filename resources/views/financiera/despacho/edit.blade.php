@extends('layouts.admin')

@section('content')
<div class="container">

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('despacho.financieras.update', $financiera->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- INFORMACIÓN GENERAL (SÓLO LECTURA) --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Información General</div>
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
                        <div class="form-control" readonly>
                            {{ $financiera->area->nombre ?? 'No asignada' }}
                        </div>
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

        {{-- INFORMACIÓN DE RUTA (EDITABLE POR DESPACHO) --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white fw-semibold">
                Información de Ruta
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="numero_foja" class="form-label">N° Foja</label>
                        <input type="text" name="numero_foja" id="numero_foja"
                            class="form-control @error('numero_foja') is-invalid @enderror"
                            value="{{ old('numero_foja', $financiera->numero_foja) }}" required>
                        @error('numero_foja')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="numero_hoja_ruta" class="form-label">N° Hoja Ruta</label>
                        <input type="text" name="numero_hoja_ruta" id="numero_hoja_ruta"
                            class="form-control @error('numero_hoja_ruta') is-invalid @enderror"
                            value="{{ old('numero_hoja_ruta', $financiera->numero_hoja_ruta) }}" required>
                        @error('numero_hoja_ruta')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="area_despacho_id" class="form-label">Acta despacho</label>
                        <select name="area_despacho_id" id="area_despacho_id"
                            class="form-control @error('area_despacho_id') is-invalid @enderror" required>
                            <option value="">-- Seleccione un área despacho --</option>
                            @foreach($areasDespacho as $areaDespacho)
                            <option value="{{ $areaDespacho->id }}"
                                {{ (old('area_despacho_id', $financiera->area_despacho_id ?? '') == $areaDespacho->id) ? 'selected' : '' }}>
                                {{ $areaDespacho->nombre }}
                            </option>
                            @endforeach
                        </select>
                        @error('area_despacho_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                </div>
            </div>
        </div>
        {{-- PREVENTIVOS (SÓLO LECTURA) --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white fw-semibold">
                Números Preventivos
            </div>
            <div class="card-body">
                @forelse($financiera->preventivos as $preventivo)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="row text-truncate">
                            <div class="col-md-3 mb-2">
                                <h6 class="text-primary"><i class="bi bi-file-text"></i> N° Preventivo</h6>
                                <p class="mb-0">{{ $preventivo->numero_preventivo }}</p>
                            </div>
                            <div class="col-md-3 mb-2">
                                <h6 class="text-success"><i class="bi bi-cash-stack"></i> Total Pago</h6>
                                <p class="mb-0">{{ number_format($preventivo->total_pago, 2) }} Bs</p>
                            </div>
                            <div class="col-md-3 mb-2">
                                <h6 class="text-secondary"><i class="bi bi-card-text"></i> Descripción</h6>
                                <p class="mb-0 text-truncate" style="max-width: 100%;">
                                    {{ $preventivo->descripcion_gasto }}</p>
                            </div>
                            <div class="col-md-3 mb-2">
                                <h6 class="text-warning"><i class="bi bi-building"></i> Empresa</h6>
                                <p class="mb-0">{{ $preventivo->empresa }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted fst-italic">No hay preventivos registrados.</p>
                @endforelse
            </div>
        </div>

        {{-- BOTONES --}}
        <div class="text-end">
            <button type="submit" name="accion" value="guardar" class="btn btn-success px-4">Guardar</button>

            <a href="{{ route('despacho.financieras.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection