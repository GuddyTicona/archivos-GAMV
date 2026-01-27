@extends('layouts.admin')

@section('content')
<div class="container bg-white p-5 rounded shadow-sm">
    <h2 class="text-center mb-4 fw-bold">Revisión de Acta Financiera Despacho</h2>

    {{-- Búsqueda --}}
    <form method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-8">
                <input type="text" name="buscar" value="{{ request('buscar') }}" 
                       class="form-control" 
                       placeholder="Buscar por entidad, documento, hoja de ruta, preventivo, unidad...">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary w-100" type="submit">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </div>
        
        {{-- Mantener fecha si existe durante la búsqueda --}}
        @if(request('fecha'))
            <input type="hidden" name="fecha" value="{{ request('fecha') }}">
        @endif
        
        @if(request('buscar') || (request('fecha') && request('fecha') != $fecha_reciente?->toDateString()))
        <div class="mt-2">
            <a href="{{ route('areas-despacho.show', $areaDespacho->id) }}" class="btn btn-sm btn-outline-danger">
                Limpiar
            </a>
           
            @if(request('fecha'))
                <span class="badge bg-warning">Fecha: {{ \Carbon\Carbon::parse(request('fecha'))->format('d/m/Y') }}</span>
            @endif
        </div>
        @endif
    </form>

    @php
        $fechaParaReporte = request('fecha') ?? ($fecha_acta?->toDateString()) ?? ($fecha_reciente?->toDateString());
    @endphp

    @if($registros_actuales->isNotEmpty())
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold d-flex justify-content-between align-items-center">
            <div>
                @if(request()->filled('buscar'))
                    Resultados de búsqueda
                    @if(request('fecha'))
                        - Fecha: {{ \Carbon\Carbon::parse($fechaParaReporte)->format('d/m/Y') }}
                    @endif
                    ({{ $registros_actuales->total() }} resultado{{ $registros_actuales->total() != 1 ? 's' : '' }})
                @elseif(request()->filled('fecha'))
                    Acta de la fecha: {{ \Carbon\Carbon::parse($fechaParaReporte)->format('d/m/Y') }}
                @else
                    Registros recientes (Fecha: {{ $fecha_reciente ? $fecha_reciente->format('d/m/Y') : 'N/A' }})
                @endif
            </div>

            {{-- Botón de descarga --}}
            <form action="{{ route('areas-despacho.generarReporte', ['id' => $areaDespacho->id]) }}" method="GET" target="_blank">
                <input type="hidden" name="fecha" value="{{ $fechaParaReporte }}">
                <button class="btn btn-light btn-sm">
                    <i class="bi bi-download"></i> Descargar Reporte
                </button>
            </form>
        </div>

        <div class="card-body">
            @foreach($registros_actuales as $registro)
                @php
                    $color = match($registro->estado_administrativo) {
                        'recibido' => 'success',
                        'pendiente' => 'warning',
                        'rechazado' => 'danger',
                        default => 'secondary',
                    };
                @endphp
                <div class="card mb-3 shadow-sm hover-shadow">
                    <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                        <h5 class="mb-0">{{ $registro->entidad }}</h5>
                        <span class="badge bg-{{ $color }}">{{ ucfirst($registro->estado_administrativo) }}</span>
                    </div>
                    <div class="card-body bg-light-subtle rounded p-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Unidad</label>
                                    <input type="text" class="form-control"
                                        value="{{ $registro->unidad->nombre_unidad ?? 'No asignada' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tipo de Documento</label>
                                    <input type="text" class="form-control" value="{{ $registro->tipo_documento }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tipo de Ejecución</label>
                                    <input type="text" class="form-control" value="{{ $registro->tipo_ejecucion }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Fecha Documento</label>
                                    <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($registro->fecha_documento)->format('d/m/Y') }}"
                                        readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Número Hoja Ruta</label>
                                    <input type="text" class="form-control" 
                                           value="{{ $registro->numero_hoja_ruta ?? 'N/A' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Número Foja</label>
                                    <input type="text" class="form-control" 
                                           value="{{ $registro->numero_foja ?? 'N/A' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Número Preventivo</label>
                                    <input type="text" class="form-control" 
                                           value="{{ $registro->numero_preventivo ?? 'N/A' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Número Compromiso</label>
                                    <input type="text" class="form-control" 
                                           value="{{ $registro->numero_compromiso ?? 'N/A' }}" readonly>
                                </div>

                                @if($registro->documento_adjunto)
                                <div class="mb-3">
                                    <a href="{{ asset('storage/' . $registro->documento_adjunto) }}" target="_blank"
                                        class="btn btn-outline-primary w-100">
                                        <i class="bi bi-file-earmark-text"></i> Ver Documento
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Preventivos --}}
                        @if($registro->preventivos && $registro->preventivos->isNotEmpty())
                        <hr>
                        <h6 class="fw-bold">Preventivos:</h6>
                        @foreach($registro->preventivos as $preventivo)
                        <div class="row g-3 mb-2 p-2 border rounded bg-white shadow-sm">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">N° Preventivo</label>
                                <input type="text" class="form-control" 
                                       value="{{ $preventivo->numero_preventivo }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Empresa</label>
                                <input type="text" class="form-control" 
                                       value="{{ $preventivo->empresa ?? 'N/A' }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Descripción</label>
                                <input type="text" class="form-control" 
                                       value="{{ $preventivo->descripcion_gasto }}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold">Total Pago</label>
                                <input type="text" class="form-control"
                                    value="Bs {{ number_format($preventivo->total_pago, 2, '.', ',') }}" readonly>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            @endforeach

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $registros_actuales->links() }}
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle"></i> 
            No se encontraron registros
            @if(request('buscar'))
                que coincidan con la búsqueda "{{ request('buscar') }}"
            @endif
            @if(request('fecha'))
                para la fecha {{ \Carbon\Carbon::parse(request('fecha'))->format('d/m/Y') }}
            @endif
        </div>
    @endif

    {{-- Actas anteriores --}}
    @if($fechas_anteriores->isNotEmpty())
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold">Ver Actas por Fecha</div>
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-center">
                <div class="col-md-6 mb-3">
                    <label for="fecha">Seleccione una fecha</label>
                    <select name="fecha" id="fecha" class="form-control">
                        <option value="">-- Todas las fechas --</option>
                        @foreach($fechas_anteriores as $fecha)
                            <option value="{{ $fecha }}" {{ request('fecha') == $fecha ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Mantener búsqueda si existe --}}
                @if(request('buscar'))
                    <input type="hidden" name="buscar" value="{{ request('buscar') }}">
                @endif
                
                <div class="col-md-6 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        Ver actas 
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <a href="{{ route('areas-despacho.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    transition: 0.3s;
}
</style>
@endsection