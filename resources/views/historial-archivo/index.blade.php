@extends('layouts.admin')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Historial Archivos') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('historial-archivos.create') }}"
                                class="btn btn-primary btn-sm float-right" data-placement="left">
                                Crear nuevo
                            </a>
                        </div>
                    </div>
                </div>
                @if($message = Session::get('mensaje'))
                <script>
                Swal.fire({
                    title: "Felicidades",
                    text: "{{$message}}",
                    icon: "success"
                });
                </script>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Archivo (informacion)</th>
                                    <th>Usuario</th>
                                    <th>Tipo Evento</th>
                                    <th>Observaciones</th>
                                    <th>Id Financiera</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historialArchivos as $historialArchivo)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $historialArchivo->archivo->codigo_archivo }}</td>
                                    <td>{{ $historialArchivo->user->name }}</td>
                                    <td>{{ $historialArchivo->tipo_evento }}</td>
                                    <td>{{ $historialArchivo->observaciones }}</td>
                                    <td>{{ $historialArchivo->financiera->entidad }}</td>
                                    <td>{{ $historialArchivo->fecha }}</td>

                                    <td>
                                        <form action="{{ route('historial-archivos.destroy', $historialArchivo->id) }}"
                                            method="POST">
                                            <a class="btn btn-sm btn-primary "
                                                href="{{ route('historial-archivos.show', $historialArchivo->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i> </a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('historial-archivos.edit', $historialArchivo->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                    class="fa fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                        $(function() {
                            $("#example1").DataTable({
                                "pageLength": 5,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ historialarchivos",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 historial_archivos",
                                    "infoFiltered": "(Filtrado de _MAX_ archivos totales)",
                                    "lengthMenu": "Mostrar _MENU_ archivos",
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
                                buttons: [{
                                        extend: 'collection',
                                        text: 'Reportes',
                                        buttons: [{
                                                text: 'Copiar',
                                                extend: 'copy',
                                            },
                                            {
                                                extend: 'pdf',
                                                text: 'PDF',
                                                orientation: 'landscape',
                                                pageSize: 'LEGAL',
                                                exportOptions: {
                                                    columns: ':visible'
                                                },
                                                customize: function(doc) {
                                                    doc.styles.tableHeader.fontSize = 9;
                                                    doc.defaultStyle.fontSize = 7;
                                                    doc.pageMargins = [10, 10, 10, 10];
                                                    var objLayout = {};
                                                    objLayout['hLineWidth'] = function(i) {
                                                        return .5;
                                                    };
                                                    objLayout['vLineWidth'] = function(i) {
                                                        return .5;
                                                    };
                                                    objLayout['hLineColor'] = function(i) {
                                                        return '#aaa';
                                                    };
                                                    objLayout['vLineColor'] = function(i) {
                                                        return '#aaa';
                                                    };
                                                    objLayout['paddingLeft'] = function(i) {
                                                        return 2;
                                                    };
                                                    objLayout['paddingRight'] = function(
                                                        i) {
                                                        return 2;
                                                    };
                                                    doc.content[1].layout = objLayout;
                                                    var colCount = doc.content[1].table
                                                        .body[0].length;
                                                    doc.content[1].table.widths = Array(
                                                        colCount).fill('*');
                                                }
                                            },
                                            {
                                                extend: 'csv',
                                                text: 'CSV'
                                            },
                                            {
                                                extend: 'excel',
                                                text: 'Excel'
                                            },
                                            {
                                                extend: 'print',
                                                text: 'Imprimir'
                                            }
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
                    </div>
                </div>
            </div>
            {!! $historialArchivos->withQueryString()->links() !!}
        </div>
    </div>
</div>
@endsection