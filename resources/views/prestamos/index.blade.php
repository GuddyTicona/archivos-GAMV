@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <div class="table-responsive shadow-sm rounded bg-white p-3">
        <h4 class="fw-bold text-center text-secondary mb-4">Listado de Préstamos de Archivos</h4>
        <table class="table align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nro</th>
                    <th>Archivo</th>
                    <th>Solicitante</th>
                    <th>Cargo</th>
                    <th>Motivo</th>
                    <th>Observaciones</th>
                    <th>Fecha Préstamo</th>
                    <th>Fecha Devolución</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestamos as $prestamo)
                <tr>
                    {{-- Número consecutivo considerando la paginación --}}
                    <td>{{ $loop->iteration + ($prestamos->currentPage() - 1) * $prestamos->perPage() }}</td>
                    <td>{{ $prestamo->financiera->codigo }}</td>
                    <td>{{ $prestamo->solicitante }}</td>
                    <td>{{ $prestamo->cargo_departamento ?? '-' }}</td>
                    <td>{{ $prestamo->motivo_prestamo ?? '-' }}</td>
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
                                   Devolver
                                </button>
                            </form>
                            @endif
                           

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este préstamo?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Eliminar préstamo">
                                  Eliminar
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

        {{-- Links de paginación --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $prestamos->links() }}
        </div>
    </div>
</div>
@endsection
