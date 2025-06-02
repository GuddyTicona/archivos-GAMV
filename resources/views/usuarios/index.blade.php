@extends('layouts.admin')
@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Listado de Usuarios</h1>
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
                    <h3 class="card-title"><b>Usuarios Registrados</b></h3>
                    <div class="card-tools">
                        <a href="{{ url('/usuarios/create')}}" class="btn btn-primary">
                            <i class="bi bi-file-earmark-plus"></i> Crear nuevo usuario
                        </a>

                    </div>
                </div>

                <div class="card-body" style="display: block;">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nombre Usuario</th>
                                <th>Email</th>
                                <th>Fecha de ingreso</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador=0;?>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td><?php echo $contador= $contador+1?></td>
                                <td>{{$usuario -> name}}</td>
                                <td>{{$usuario -> email}}</td>
                                <td>{{$usuario -> fecha_ingreso}}</td>

                                <td style="text-aling: center;">
                                    <button class="btn btn-success btn-sm " style="border-radius: 20px">Activo</button>
                                </td>
                                <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('usuarios',$usuario->id)}}" type="button" class="btn btn-info"><i
                                            class="bi bi-eye-fill"></i></a>
                                    <a href="{{route('usuarios.edit',$usuario->id)}}" type="button"
                                        class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{url('usuarios',$usuario->id)}}" method="post">
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
                                "info": "Mostrando _START_ a _END_ de _TOTAL usuarios",
                                "infoEmpty": "Mostrando 0 a 0 de 0 usuarios",
                                "infoFiltered": "(Filtrado de _MAX_ total usuarios)",
                                "infoPostFix": "",
                                "thousands": ",",
                                "lengthMenu": "Mostrar _MENU_ _usuarios",
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