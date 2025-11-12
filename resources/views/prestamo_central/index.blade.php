@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">Listado de Préstamos de Archivos</span>
                        <div class="float-right">
                            <a href="{{ route('prestamo_central.create') }}" class="btn btn-primary btn-sm float-right">
                                Registrar nuevo préstamo
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Mensaje de éxito --}}
                @if($message = Session::get('mensaje'))
                <script>
                    Swal.fire({
                        title: "Éxito",
                        text: "{{$message}}",
                        icon: "success"
                    });
                </script>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped align-middle">
                          <thead class="bg-dark text-primary ">

                                <tr>
                                    <th>No</th>
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
                                @foreach ($prestamos as $prestamo)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prestamo->archivo->codigo_archivo ?? '-' }}</td>
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
                                            <span class="badge bg-success">Recepcionado</span>
                                        @endif
                                    </td>

                                    <td>
                                        <form action="{{ route('prestamo_central.destroy', $prestamo->id) }}" method="POST">
                                            <div class="btn-group" role="group">
                                                {{-- Devolver --}}
                                                @if($prestamo->fecha_devolucion === null)
                                                <form action="{{ route('prestamo_central.devolver', $prestamo->id) }}" method="POST" class="me-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-primary" title="Marcar como devuelto">
                                                        <i class="bi bi-arrow-return-left"></i>
                                                    </button>
                                                </form>
                                                @endif

                                                {{-- Eliminar --}}
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); confirm('¿Seguro que deseas eliminar este préstamo?') ? this.closest('form').submit() : false;">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $prestamos->withQueryString()->links() !!}
        </div>
    </div>
</div>

{{-- SCRIPT DATATABLE --}}
<script>
$(function() {
    $("#example1").DataTable({
        "pageLength": 5,
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ préstamos",
            "infoEmpty": "Mostrando 0 a 0 de 0 préstamos",
            "infoFiltered": "(Filtrado de _MAX_ préstamos totales)",
            "lengthMenu": "Mostrar _MENU_ préstamos",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        buttons: [
            {
                extend: 'collection',
                text: 'Reportes',
                buttons: [
                    { extend: 'copy', text: 'Copiar' },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: { columns: ':visible' },
                        customize: function(doc) {
                            doc.styles.tableHeader.fontSize = 9;
                            doc.defaultStyle.fontSize = 7;
                            doc.pageMargins = [10, 10, 10, 10];
                            var objLayout = {};
                            objLayout['hLineWidth'] = function(i) { return .5; };
                            objLayout['vLineWidth'] = function(i) { return .5; };
                            objLayout['hLineColor'] = function(i) { return '#aaa'; };
                            objLayout['vLineColor'] = function(i) { return '#aaa'; };
                            objLayout['paddingLeft'] = function(i) { return 2; };
                            objLayout['paddingRight'] = function(i) { return 2; };
                            doc.content[1].layout = objLayout;
                            var colCount = doc.content[1].table.body[0].length;
                            doc.content[1].table.widths = Array(colCount).fill('*');
                        }
                    },
                    { extend: 'csv', text: 'CSV' },
                    { extend: 'excel', text: 'Excel' },
                    { extend: 'print', text: 'Imprimir' }
                ]
            },
            {
                extend: 'colvis',
                text: 'Visor de columnas',
                collectionLayout: 'fixed three-column'
            }
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>
@endsection
