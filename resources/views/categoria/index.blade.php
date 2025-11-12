@extends('layouts.admin')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Categorias') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                Crear Nuevo
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

                                    <th>Nombre Categoria</th>
                                    <th>Descripcion</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $categoria)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $categoria->nombre_categoria }}</td>
                                    <td>{{ $categoria->descripcion }}</td>

                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Acciones">
                                            <a href="{{ route('categorias.show', $categoria->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                Ver detalles
                                            </a>
                                            <a href="{{ route('categorias.edit', $categoria->id) }}"
                                                class="btn btn-sm btn-outline-success">
                                                Editar
                                            </a>
                                            <form action="{{ route('categorias.destroy', $categoria->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('¿Seguro que deseas deshabilitar esta categoría?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    Deshabilitar
                                                </button>
                                            </form>
                                        </div>
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
                                    "emptyTable": "No hay informacion",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL categorias",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 categorias",
                                    "infoFiltered": "(Filtrado de _MAX_ total categorias)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ _categorias",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
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
            {!! $categorias->withQueryString()->links() !!}
        </div>
    </div>
</div>
@endsection