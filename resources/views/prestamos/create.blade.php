@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Registrar Préstamo - Financiera: {{ $financiera->codigo ?? $financiera->id }}</h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('prestamos.store') }}" method="POST">
                @csrf
                <!-- Campo obligatorio -->
                <input type="hidden" name="financiera_id" value="{{ $financiera->id }}">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Solicitante</label>
                        <input type="text" name="solicitante" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Cargo</label>
                        <input type="text" name="cargo_departamento" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Fecha de Préstamo</label>
                        <input type="date" name="fecha_prestamo" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Motivo del Préstamo</label>
                        <textarea name="motivo_prestamo" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Observaciones</label>
                        <textarea name="observaciones" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('ubicaciones.show_estante', $financiera->ubicacion->estante) }}"
                       class="btn btn-outline-secondary px-4">
                       <i class="bi bi-arrow-left"></i> Volver al Estante
                    </a>

                    <button type="submit" class="btn btn-primary fw-bold px-4">
                        <i class="bi bi-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
