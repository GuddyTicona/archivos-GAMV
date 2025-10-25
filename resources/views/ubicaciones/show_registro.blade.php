@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Volver
    </a>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold text-center text-secondary mb-4">
                Detalle del Archivo — {{ $financiera->codigo }}
            </h5>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Entidad</label>
                    <input type="text" class="form-control" value="{{ $financiera->entidad }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Unidad</label>
                    <input type="text" class="form-control" value="{{ $financiera->unidad->nombre_unidad ?? 'N/D' }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tipo Documento</label>
                    <input type="text" class="form-control" value="{{ $financiera->tipo_documento }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Fecha Documento</label>
                    <input type="text" class="form-control" value="{{ $financiera->fecha_documento }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Hoja Ruta</label>
                    <input type="text" class="form-control" value="{{ $financiera->numero_hoja_ruta }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">N° Foja</label>
                    <input type="text" class="form-control" value="{{ $financiera->numero_foja }}" disabled>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Ubicación</label>
                    <input type="text" class="form-control" value="Estante {{ $financiera->ubicacion->estante }} — Fila {{ $financiera->ubicacion->fila }} — Columna {{ $financiera->ubicacion->columna }}" disabled>
                </div>

                <div class="col-12 mt-3">
                    <label class="form-label fw-bold">Documento Adjunto</label>
                    @if($financiera->documento_adjunto)
                        <div><a href="{{ asset('storage/' . $financiera->documento_adjunto) }}" target="_blank" class="btn btn-outline-primary btn-sm">Ver / Descargar</a></div>
                    @else
                        <span class="text-muted">No hay documento adjunto</span>
                    @endif
                </div>

                <hr class="mt-4">
                <h6 class="fw-bold text-primary">Preventivos</h6>
                @forelse($financiera->preventivos as $preventivo)
                    <div class="border rounded p-3 mb-2 bg-light">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">N° Preventivo</label>
                                <input type="text" class="form-control" value="{{ $preventivo->numero_preventivo }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">N° Secuencia</label>
                                <input type="text" class="form-control" value="{{ $preventivo->numero_secuencia }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Empresa</label>
                                <input type="text" class="form-control" value="{{ $preventivo->empresa ?? 'N/D' }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Beneficiario</label>
                                <input type="text" class="form-control" value="{{ $preventivo->beneficiario }}" disabled>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Descripción</label>
                                <textarea class="form-control" rows="2" disabled>{{ $preventivo->descripcion_gasto ?? 'N/D' }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Total</label>
                                <input type="text" class="form-control" value="{{ number_format($preventivo->total_pago, 2) }} Bs" disabled>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No hay preventivos registrados.</p>
                @endforelse

            </div>
        </div>
    </div>
</div>
@endsection
