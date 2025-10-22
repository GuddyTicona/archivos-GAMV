@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h4 class="mb-3">Archivos Financieros</h4>

    <!-- Buscador externo -->
    <div class="mb-3">
        <input type="text" id="searchTable" class="form-control shadow-sm" placeholder="Buscar cualquier dato...">
    </div>

    <!-- Tabla -->
    <div class="table-responsive shadow-sm rounded bg-white p-2">
        <table class="table table-striped table-hover align-middle" id="filesTable">
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Entidad</th>
                    <th>Área / Unidad</th>
                    <th>Tipo Documento</th>
                    <th>Fecha</th>
                    <th>Hoja Ruta</th>
                    <th>Foja</th>
                    <th>Estado Tesorería</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($financieras as $item)
                <tr>
                    <td>{{ $item->codigo }}</td>
                    <td>{{ $item->entidad }}</td>
                    <td>{{ $item->area->nombre ?? 'N/D' }} / {{ $item->unidad->nombre_unidad ?? 'N/D' }}</td>
                    <td>{{ $item->tipo_documento }}</td>
                    <td>{{ $item->fecha_documento }}</td>
                    <td>{{ $item->numero_hoja_ruta }}</td>
                    <td>{{ $item->numero_foja }}</td>

                    <!-- Estado Tesorería con botones -->
                    <td>
                        <form action="{{ route('financieras.estado_tesoreria', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="btn-group" role="group">
                                <button type="submit" name="estado_tesoreria" value="pendiente"
                                    class="btn btn-sm {{ $item->estado_tesoreria === 'pendiente' ? 'btn-warning text-dark' : 'btn-outline-warning' }}">
                                    Pendiente
                                </button>
                                <button type="submit" name="estado_tesoreria" value="recibido"
                                    class="btn btn-sm {{ $item->estado_tesoreria === 'recibido' ? 'btn-success' : 'btn-outline-success' }}">
                                    Recibido
                                </button>
                                <button type="submit" name="estado_tesoreria" value="rechazado"
                                    class="btn btn-sm {{ $item->estado_tesoreria === 'rechazado' ? 'btn-danger' : 'btn-outline-danger' }}">
                                    Rechazado
                                </button>
                            </div>
                        </form>
                    </td>

                    <!-- Acciones -->
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('financieras.archivos.show', $item->id) }}" class="btn btn-primary btn-sm">Ver</a>
                            <a href="{{ route('smaf.financieras.edit', $item->id) }}" class="btn btn-success btn-sm">Editar</a>
                            <a href="{{ route('ubicaciones.seleccionarEstante', $item->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-pin-map-fill"></i> Asignar
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No hay registros que coincidan con la búsqueda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    const table = $('#filesTable').DataTable({
        paging: true,
        ordering: true,
        info: true,
        responsive: true,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            zeroRecords: "No se encontraron resultados"
        }
    });

    $('#searchTable').on('keyup', function() {
        table.search(this.value).draw();
    });
});
</script>
@endsection

<style>
.table th, .table td { vertical-align: middle; }
.btn-sm { font-size: 0.8rem; }
</style>
@endsection
