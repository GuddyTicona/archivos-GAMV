@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span id="card_title">Registros financieros</span>
                    <a href="{{ route('financieras.create') }}" class="btn btn-primary btn-sm">Crear nuevo</a>
                </div>

                @if($message = Session::get('mensaje'))
                <script>
                Swal.fire({
                    title: "Felicidades",
                    text: "{{ $message }}",
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
                                    <th>Unidad</th>
                                    <th>Preventivos</th>
                                    <th>Estado Documento</th>
                                    <th>Tipo Documento</th>
                                    <th>Tipo Ejecución</th>
                                    <th>Fecha Documento</th>
                                    <th>Documento Adjunto</th>
                                    <th>Hoja Ruta</th>
                                    <th>Compromiso</th>
                                    <th>Devengado</th>
                                    <th>Pago</th>
                                    <th>Secuencia</th>
                                    <th>Área</th>
                                    <th>Estado</th>
                                    <th>Actualización</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($financieras as $financiera)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $financiera->entidad }}</td>
                                    <td>{{ $financiera->unidad->nombre_unidad ?? 'Sin unidad' }}</td>

                                    <!-- Listado de preventivos -->
                                    <td>
                                        @foreach($financiera->preventivos as $preventivo)
                                            <div class="mb-2 border-bottom pb-1">
                                                <strong>N°:</strong> {{ $preventivo->numero_preventivo }}<br>
                                                <strong>Total:</strong> {{ number_format($preventivo->total_pago, 3) }}<br>
                                                <strong>Desc.:</strong> {{ $preventivo->descripcion_gasto }}<br>
                                                <strong>Empresa:</strong> {{ $preventivo->empresa }}<br>
                                                <strong>Beneficiario:</strong> {{ $preventivo->beneficiario }}
                                            </div>
                                        @endforeach
                                    </td>

                                    <td>{{ $financiera->estado_documento }}</td>
                                    <td>{{ $financiera->tipo_documento }}</td>
                                    <td>{{ $financiera->tipo_ejecucion }}</td>
                                    <td>{{ $financiera->fecha_documento }}</td>

                                    <td>
                                        @if ($financiera->documento_adjunto)
                                        <a href="{{ asset('storage/' . $financiera->documento_adjunto) }}"
                                            target="_blank" class="btn btn-sm btn-outline-secondary">Ver documento</a>
                                        @else
                                        <span class="text-muted">No adjunto</span>
                                        @endif
                                    </td>

                                    <td>{{ $financiera->numero_hoja_ruta }}</td>
                                    <td>{{ $financiera->numero_compromiso }}</td>
                                    <td>{{ $financiera->numero_devengado }}</td>
                                    <td>{{ $financiera->numero_pago }}</td>
                                    <td>{{ $financiera->numero_secuencia }}</td>
                                    <td>{{ $financiera->area->nombre ?? 'No asignado' }}</td>

                                    <!-- Estado administrativo -->
                                    <td>
                                        <form action="{{ route('financieras.estado_administrativo', $financiera->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="estado" onchange="this.form.submit()" class="form-control form-control-sm">
                                                <option value="pendiente" {{ $financiera->estado_administrativo == 'pendiente' ? 'selected' : '' }}>Enviar</option>
                                                <option value="recibido" {{ $financiera->estado_administrativo == 'recibido' ? 'selected' : '' }}>Confirmado</option>
                                                <option value="rechazado" {{ $financiera->estado_administrativo == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                                            </select>
                                        </form>
                                    </td>

                                    <td>{{ $financiera->estado_actualizado ? $financiera->estado_actualizado->timezone('America/La_Paz')->format('d/m/Y H:i') : 'No actualizado' }}</td>

                                    <td>
                                        <form action="{{ route('financieras.destroy', $financiera->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary" href="{{ route('financieras.show', $financiera->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('financieras.edit', $financiera->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?');"><i class="fa fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 5,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                                    "lengthMenu": "Mostrar _MENU_ registros",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscar:",
                                    "zeroRecords": "No se encontraron coincidencias",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Último",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                responsive: true,
                                lengthChange: true,
                                autoWidth: false,
                                buttons: [
                                    {
                                        extend: 'collection',
                                        text: 'Reportes',
                                        buttons: [
                                            'copy', 
                                            { extend: 'pdf', text: 'PDF', orientation: 'landscape', pageSize: 'LEGAL' },
                                            'csv', 'excel', 'print'
                                        ]
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Columnas'
                                    }
                                ]
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                        </script>
                    </div>
                </div>
            </div>

            <!-- Paginación -->
            {!! $financieras->withQueryString()->links() !!}
        </div>
    </div>
</div>
@endsection
