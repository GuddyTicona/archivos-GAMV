@extends('layouts.admin')

@section('content')
<div class="container py-4">
    

    <div class="table-responsive shadow-sm rounded bg-white p-3">
        <h4 class="fw-bold text-center text-secondary mb-4">Listado de Préstamos de Archivos</h4>
        <table class="table  align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nro</th>
                    <th>Archivo</th>
                    <th>Solicitante</th>
                    <th>Cargo </th>
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
                <tr>
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
                        <div class="btn-group" role="group">
                            {{-- Botón Devolver --}}
                            @if($prestamo->fecha_devolucion === null)
                            <form action="{{ route('prestamos.devolver', $prestamo->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-primary" title="Marcar como devuelto">
                                    <i class="bi bi-box-arrow-in-down"></i> Devolver
                                </button>
                            </form>
                            @endif

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este préstamo?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Eliminar préstamo">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
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
