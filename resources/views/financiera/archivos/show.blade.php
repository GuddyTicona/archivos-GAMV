@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
  
    <!-- Card principal -->
    <div class="card shadow-sm p-4">

        <!-- Información General como Formulario de cuadros -->
        <h5 class="mb-3">Información General</h5>
        <form>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Código</label>
                    <input type="text" class="form-control" value="{{ $financiera->codigo ?? 'N/D' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Entidad</label>
                    <input type="text" class="form-control" value="{{ $financiera->entidad ?? 'N/D' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Área / Unidad</label>
                    <input type="text" class="form-control" value="{{ $financiera->area->nombre ?? 'N/D' }} / {{ $financiera->unidad->nombre_unidad ?? 'N/D' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tipo Documento</label>
                    <input type="text" class="form-control" value="{{ $financiera->tipo_documento ?? 'N/D' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha Documento</label>
                    <input type="text" class="form-control" value="{{ $financiera->fecha_documento ?? 'N/D' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Hoja de Ruta</label>
                    <input type="text" class="form-control" value="{{ $financiera->numero_hoja_ruta ?? 'N/D' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">N° Foja</label>
                    <input type="text" class="form-control" value="{{ $financiera->numero_foja ?? 'N/D' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">N° Compromiso</label>
                    <input type="text" class="form-control" value="{{ $financiera->numero_compromiso ?? 'N/D' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">N° Devengado</label>
                    <input type="text" class="form-control" value="{{ $financiera->numero_devengado ?? 'N/D' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Actas</label>
                    <input type="text" class="form-control" value="{{ $financiera->numero_devengado ?? 'N/D' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Documento adjunto</label>
                    <input type="text" class="form-control" value="{{ $financiera->documento_adjunto }}" readonly>
                </div>

                @if($financiera->documento_adjunto)
                <div class="col-12 mt-2">
                    <label class="form-label">Documento Adjunto</label>
                    <div>
                        <a href="{{ asset('storage/' . $financiera->documento_adjunto) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            Ver / Descargar
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </form>

        <!-- Preventivos -->
        @if($financiera->preventivos->count())
        <div class="mt-4">
            <h5 class="mb-3">Preventivos</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>N° Preventivo</th>
                            <th>N° Secuencia</th>
                            <th>Empresa</th>
                            <th>Beneficiario</th>
                            <th>Descripción</th>
                            <th>Total (Bs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($financiera->preventivos as $preventivo)
                        <tr>
                            <td>{{ $preventivo->numero_preventivo }}</td>
                            <td>{{ $preventivo->numero_secuencia ?? 'N/D' }}</td>
                            <td>{{ $preventivo->empresa ?? 'N/D' }}</td>
                            <td>{{ $preventivo->beneficiario ?? 'N/D' }}</td>
                            <td>{{ $preventivo->descripcion_gasto ?? 'N/D' }}</td>
                            <td>{{ number_format($preventivo->total_pago, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Botones finales -->
<div class="mt-4 d-flex justify-content-end gap-2">
    <a href="{{ route('financieras.archivos.index') }}" class="btn btn-secondary btn-sm">
        Volver al listado
    </a>
   
</div>


    </div>
</div>

<style>
.table th, .table td {
    vertical-align: middle;
}
</style>
@endsection
