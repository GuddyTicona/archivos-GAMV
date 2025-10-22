@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Listado de Permisos</h3>
    <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">Nuevo Permiso</a>
    <div class="card-body bg-white">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Módulo</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->module ?? '-' }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            <a href="{{ route('permissions.edit', $permission->id) }}"
                                class="btn btn-sm btn-secondary me-1">
                                Editar
                            </a>

                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este permiso?')">
                                    <i class="bi bi-trash-fill"></i> Eliminar
                                </button>
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
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ permisos",
                        "infoEmpty": "Mostrando 0 a 0 de 0 permisos",
                        "infoFiltered": "(Filtrado de _MAX_ total permisos)",
                        "lengthMenu": "Mostrar _MENU_ permisos",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscador:",
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
                            orientation: 'landscape',
                            buttons: [{
                                text: 'Copiar',
                                extend: 'copy',
                            }, {
                                extend: 'pdf'
                            }, {
                                extend: 'csv'
                            }, {
                                extend: 'excel'
                            }, {
                                text: 'Imprimir',
                                extend: 'print'
                            }]
                        },
                        {
                            extend: 'colvis',
                            text: 'Visor de columnas',
                            collectionLayout: 'fixed three-column'
                        }
                    ],

                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
            </script>
        </div>
    </div>
</div>
@endsection