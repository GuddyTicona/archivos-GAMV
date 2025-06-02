@extends('layouts.admin')
@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Listado de Unidades</h1>
    @if($message = Session::get('mensaje'))
    <script>
    Swal.fire({
        title: "Felicidades",
        text: "{{$message}}",
        icon: "success"
    });
    </script>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Unidades Registrados</b></h3>
                    <div class="card-tools">
                        <a href="{{ url('/unidades/create')}}" class="btn btn-primary">
                            <i class="bi bi-file-earmark-plus"></i> Agregar nueva unidad
                        </a>

                    </div>
                </div>

                <div class="card-body" style="display: block;">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nombre Unidad</th>
                                <th>Descripcion</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador=0;?>
                            @foreach($unidades as $unidad)
                            <tr>
                                <td><?php echo $contador= $contador+1?></td>
                                <td>{{$unidad -> nombre_unidad}}</td>
                                <td>{{$unidad -> descripcion}}</td>
                                <td>{{$unidad -> fecha_creacion}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('unidades',$unidad->id)}}" type="button" class="btn btn-info"><i
                                                class="bi bi-eye-fill"></i></a>
                                        <a href="{{route('unidades.edit',$unidad->id)}}" type="button"
                                            class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{url('unidades',$unidad->id)}}" method="post">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash-fill"></i>
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
                                "info": "Mostrando _START_ a _END_ de _TOTAL unidades",
                                "infoEmpty": "Mostrando 0 a 0 de 0 unidades",
                                "infoFiltered": "(Filtrado de _MAX_ total unidades)",
                                "infoPostFix": "",
                                "thousands": ",",
                                "lengthMenu": "Mostrar _MENU_ _unidades",
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

    </div>


</div>

@endsection