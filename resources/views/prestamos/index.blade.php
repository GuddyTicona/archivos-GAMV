@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h5 class="fw-bold text-center text-secondary mb-3">Listado de Préstamos</h5>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>#</th>
                    <th>Archivo</th>
                    <th>Solicitante</th>
                    <th>Cargo / Departamento</th>
                    <th>Motivo</th>
                    <th>Observaciones</th>
                    <th>Fecha Préstamo</th>
                    <th>Fecha Devolución</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestamos as $index => $prestamo)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $prestamo->financiera->codigo }}</td>
                    <td>{{ $prestamo->solicitante }}</td>
                    <td>{{ $prestamo->cargo_departamento ?? '-' }}</td>
                    <td>{{ $prestamo->motivo ?? '-' }}</td>
                    <td>{{ $prestamo->observaciones ?? '-' }}</td>
                    <td>{{ $prestamo->fecha_prestamo }}</td>
                    <td>{{ $prestamo->fecha_devolucion ?? '-' }}</td>
                    <td>
                        @if($prestamo->fecha_devolucion === null)
                            <span class="badge bg-danger">Prestado</span>
                        @else
                            <span class="badge bg-success">Devuelto</span>
                        @endif
                    </td>
                    <td>
                        @if($prestamo->fecha_devolucion === null)
                        <form action="{{ route('prestamos.devolver', $prestamo->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-outline-primary btn-sm">Devolver</button>
                        </form>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">No hay préstamos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
