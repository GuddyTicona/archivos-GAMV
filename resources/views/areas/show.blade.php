@extends('layouts.admin')

@section('content')
<div class="container bg-white p-5 rounded shadow-sm">
    <h2 class="text-center mb-4 fw-bold">Revisión de Acta Financiera SMAF</h2>

    {{-- Búsqueda --}}
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control" placeholder="Buscar registros financieros">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Buscar</button>
        </div>
        @if(request('buscar'))
        <div class="mt-2">
            <a href="{{ route('areas.show', $area->id) }}" class="btn btn-sm btn-outline-danger">
                Limpiar búsqueda <i class="bi bi-x-circle"></i>
            </a>
        </div>
        @endif
    </form>

    {{-- Determinar qué registros mostrar --}}
    @php
        $mostrarRegistros = request()->filled('buscar') ? $registros_actuales : ($registros_actuales ?? $ultimos_registros ?? collect());
        $fechaParaReporte = request('fecha') ?? $fecha_acta ?? $fecha_reciente;
    @endphp

    @if(!$mostrarRegistros->isEmpty())
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold d-flex justify-content-between align-items-center">
            @if(request()->filled('fecha'))
                Acta de la fecha: {{ \Carbon\Carbon::parse($fechaParaReporte)->format('d/m/Y') }}
            @else
                Registros recientes (Fecha: {{ \Carbon\Carbon::parse($fechaParaReporte)->format('d/m/Y') }})
            @endif

            {{-- Botón de descarga --}}
           <form action="{{ route('areas.generarReporte', ['id' => $area->id]) }}" method="GET" target="_blank">
    <input type="hidden" name="fecha" value="{{ $fechaParaReporte }}">
    <button class="btn btn-light btn-sm">
        <i class="bi bi-download"></i> Descargar Reporte Financiera
    </button>
</form>

        </div>
        <div class="card-body">
            @foreach($mostrarRegistros as $registro)
                @php
                    $color = match($registro->estado_administrativo) {
                        'recibido' => 'success',
                        'pendiente' => 'warning',
                        'rechazado' => 'danger',
                        default => 'secondary',
                    };
                @endphp
                <div class="card mb-3 shadow-sm hover-shadow">
                    <div class="card-header d-flex justify-content-between align-items-center bg-dark">
                        <h5 class="mb-0">{{ $registro->entidad }}</h5>
                        <span class="badge bg-{{ $color }}">{{ ucfirst($registro->estado_administrativo) }}</span>
                    </div>
                    <div class="card-body bg-light-subtle rounded p-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Unidad</label>
                                <input type="text" class="form-control" value="{{ $registro->unidad->nombre_unidad ?? 'No asignada' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tipo de Documento</label>
                                <input type="text" class="form-control" value="{{ $registro->tipo_documento }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tipo de Ejecución</label>
                                <input type="text" class="form-control" value="{{ $registro->tipo_ejecucion }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Fecha Envío</label>
                                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($registro->fecha_envio)->format('d/m/Y') }}" readonly>
                            </div>
                            @if($registro->documento_adjunto)
                            <div class="col-12">
                                <a href="{{ asset('storage/' . $registro->documento_adjunto) }}" target="_blank" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-file-earmark-text"></i> Ver Documento
                                </a>
                            </div>
                            @endif
                        </div>

                        {{-- Preventivos --}}
                        @if($registro->preventivos->isNotEmpty())
                        <hr>
                        <h6 class="fw-bold">Preventivos:</h6>
                        @foreach($registro->preventivos as $preventivo)
                        <div class="row g-3 mb-2 p-2 border rounded bg-white shadow-sm">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">N° Preventivo</label>
                                <input type="text" class="form-control" value="{{ $preventivo->numero_preventivo }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Empresa</label>
                                <input type="text" class="form-control" value="{{ $preventivo->empresa }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Descripción</label>
                                <input type="text" class="form-control" value="{{ $preventivo->descripcion_gasto }}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold">Total Pago</label>
                                <input type="text" class="form-control" value="Bs {{ number_format($preventivo->total_pago, 3, '.', '') }}" readonly>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @else
        <div class="alert alert-warning">No hay registros para mostrar.</div>
    @endif

    {{-- Actas anteriores --}}
@if($fechas_anteriores->isNotEmpty())
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-warning text-white fw-bold">Ver Actas Anteriores</div>
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-center">
            <div class="col-md-6 mb-3">
                <label for="fecha">Seleccione una fecha</label>
                <select name="fecha" id="fecha" class="form-control">
                    <option value="">-- Seleccione una fecha --</option>
                    @foreach($fechas_anteriores as $fecha)
                        <option value="{{ $fecha }}" {{ request('fecha') == $fecha ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Ver Acta</button>
            </div>
        </form>

        @if(request('fecha') && request('fecha') != $fecha_reciente)
        <div class="mt-3">
            <a href="{{ route('areas.show', $area->id) }}" class="btn btn-secondary">
                Volver a registros recientes
            </a>
        </div>
        @endif
    </div>
</div>
@endif

<a href="{{ route('areas.index') }}" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left"></i> Volver</a>


<style>
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    transition: 0.3s;
}
</style>
@endsection
