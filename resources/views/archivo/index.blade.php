@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">Listado de Archivos</span>
                        <div class="float-right">
                            <a href="{{ route('archivos.create') }}" class="btn btn-primary btn-sm float-right">
                                Crear nuevo archivo
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
                                    <th>Codigo Archivo</th>
                                    <th>Descripcion Documento</th>
                                    <th>Tomo</th>
                                    <th>Numero Foja</th>
                                    <th>Gestion</th>
                                    <th>Unidad Instalacion</th>
                                    <th>Observaciones</th>
                                    <th>Fecha Registro</th>
                                    <th>Unidad</th>
                                    <th>Estado</th>
                                    <th>Categoria</th>
                                    <th>Documento Adjunto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($archivos as $archivo)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $archivo->codigo_archivo }}</td>
                                    <td>{{ $archivo->descripcion_documento }}</td>
                                    <td>{{ $archivo->tomo }}</td>
                                    <td>{{ $archivo->numero_foja }}</td>
                                    <td>{{ $archivo->gestion }}</td>
                                    <td>{{ $archivo->unidad_instalacion }}</td>
                                    <td>{{ $archivo->observaciones }}</td>
                                    <td>{{ $archivo->fecha_registro }}</td>
                                    <td>{{ $archivo->unidad->nombre_unidad }}</td>
                                    <td>{{ $archivo->estado }}</td>
                                    <td>{{ $archivo->Categorias->nombre_categoria }}</td>
                                    <td>
                                        @if ($archivo->documento_adjunto)
                                        <a href="{{ asset('storage/' . $archivo->documento_adjunto) }}"
                                            target="_blank" class="btn btn-sm btn-outline-secondary">
                                            Ver documento
                                        </a>
                                        @else
                                        <span class="text-muted">No adjunto</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('archivos.destroy', $archivo->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('archivos.show', $archivo->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i> </a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('archivos.edit', $archivo->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="event.preventDefault(); confirm('Esta seguro de eliminar?') ? this.closest('form').submit() : false;"><i
                                                    class="fa fa-fw fa-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $archivos->withQueryString()->links() !!}
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
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ archivos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 archivos",
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
                                    objLayout['paddingRight'] = function(i) {
                                        return 2;
                                    };
                                    doc.content[1].layout = objLayout;
                                    var colCount = doc.content[1].table.body[0].length;
                                    doc.content[1].table.widths = Array(colCount).fill('*');
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
        @endsection