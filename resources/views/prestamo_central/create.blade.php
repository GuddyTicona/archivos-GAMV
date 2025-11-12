@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Registrar préstamo</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('prestamo_central.store') }}" method="POST">
                @csrf

                @if($archivo)
                <div class="alert alert-info">
                    <strong>Archivo seleccionado:</strong> {{ $archivo->codigo_archivo }} - {{ $archivo->descripcion_documento }}
                    <input type="hidden" name="archivo_id" value="{{ $archivo->id }}">
                </div>
                @endif

                <div class="row">
                    <!-- Primera fila: Solicitante y Cargo -->
                    <div class="col-md-6 mb-3">
                        <label for="solicitante" class="form-label">Solicitante</label>
                        <input type="text" name="solicitante" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cargo_departamento" class="form-label">Cargo / Departamento</label>
                        <input type="text" name="cargo_departamento" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <!-- Segunda fila: Motivo y Observaciones -->
                    <div class="col-md-6 mb-3">
                        <label for="motivo_prestamo" class="form-label">Motivo del préstamo</label>
                        <textarea name="motivo_prestamo" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fecha_prestamo" class="form-label">Fecha de préstamo</label>
                        <input type="date" name="fecha_prestamo" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    
                </div>
                <div class="row">
<div class="col-md-6 mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea name="observaciones" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-2">
                    <button type="submit" class="btn btn-primary me-2">
                         Guardar 
                    </button>
                 
                    <a href="{{ route('archivos.index') }}" class="btn btn-secondary">
                         Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
