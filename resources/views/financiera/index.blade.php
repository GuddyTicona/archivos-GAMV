@extends('layouts.admin')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            Registros financieros
                        </span>

                        <div class="float-right">
                            <a href="{{ route('financieras.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
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

                                    <th>Entidad</th>
                                    <th>Unidad Id</th>
                                    <th>Descripcion Gasto</th>
                                    <th>Total Pago</th>
                                    <th>Estado Documento</th>
                                    <th>Tipo Documento</th>
                                    <th>Tipo Ejecucion</th>
                                    <th>Fecha Documento</th>
                                    <th>Documento Adjunto</th>
                                    <th>Numero Hoja Ruta</th>
                                    <th>Numero Preventivo</th>
                                    <th>Numero Compromiso</th>
                                    <th>Numero Devengado</th>
                                    <th>Numero Pago</th>
                                    <th>Numero Secuencia</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($financieras as $financiera)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $financiera->entidad }}</td>
                                    <td>{{ $financiera->unidad->nombre_unidad }}</td>
                                    <td>{{ $financiera->descripcion_gasto }}</td>
                                    <td>{{ $financiera->total_pago }}</td>
                                    <td>{{ $financiera->estado_documento }}</td>
                                    <td>{{ $financiera->tipo_documento }}</td>
                                    <td>{{ $financiera->tipo_ejecucion }}</td>
                                    <td>{{ $financiera->fecha_documento }}</td>
                                    <td>{{ $financiera->documento_adjunto }}</td>
                                    <td>{{ $financiera->numero_hoja_ruta }}</td>
                                    <td>{{ $financiera->numero_preventivo }}</td>
                                    <td>{{ $financiera->numero_compromiso }}</td>
                                    <td>{{ $financiera->numero_devengado }}</td>
                                    <td>{{ $financiera->numero_pago }}</td>
                                    <td>{{ $financiera->numero_secuencia }}</td>

                                    <td>
                                        <form action="{{ route('financieras.destroy', $financiera->id) }}"
                                            method="POST">
                                            <a class="btn btn-sm btn-primary "
                                                href="{{ route('financieras.show', $financiera->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i> </a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('financieras.edit', $financiera->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                    class="fa fa-fw fa-trash"></i> </button>
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ financieras",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 financieras",
                                    "infoFiltered": "(Filtrado de _MAX_ archivos totales)",
                                    "lengthMenu": "Mostrar _MENU_ financieras",
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
            {!! $financieras->withQueryString()->links() !!}
        </div>
    </div>
</div>
@endsection