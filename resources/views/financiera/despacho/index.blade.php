@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Registros Financieros (Despacho)') }}
                        </span>
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
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Entidad</th>
                                    <th>Unidad</th>
                                    <th>Estado Documento</th>
                                    <th>Fecha Documento</th>
                                    <th>N° Hoja Ruta</th>
                                    <th>N° Foja</th>
                                    <th>Acta Despacho</th>
                                    <th>Preventivos</th>
                                    <th>Estado Despacho</th>
                                    <th>Estado Administrativo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($financieras as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->entidad }}</td>
                                    <td>{{ $item->unidad->nombre_unidad ?? 'No asignado' }}</td>
                                    <td>{{ ucfirst($item->estado_documento) }}</td>
                                    <td>{{ $item->fecha_documento }}</td>
                                    <td>{{ $item->numero_hoja_ruta ?? '-' }}</td>
                                    <td>{{ $item->numero_foja ?? '-' }}</td>
                                    <td>{{ $item->areaDespacho->nombre ?? '-' }}</td>
                                    <td>
                                        @forelse($item->preventivos as $preventivo)
                                            <div class="mb-1">
                                                <strong>{{ $preventivo->numero_preventivo }}</strong> - 
                                                {{ number_format($preventivo->total_pago, 2) }} Bs
                                                <br>
                                                <small class="text-muted">{{ $preventivo->empresa }}</small>
                                            </div>
                                        @empty
                                            <span class="text-muted fst-italic">Sin preventivos</span>
                                        @endforelse
                                    </td>
                                    <td>{{ $item->estado_despacho ?? 'Pendiente' }}</td>
                                    <td>
                                        <form action="{{ route('financieras.estado_administrativo', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="btn-group" role="group">
                                                <button type="submit" name="estado_administrativo" value="pendiente"
                                                    class="btn btn-sm {{ $item->estado_administrativo === 'pendiente' ? 'btn-warning' : 'btn-outline-warning' }}">
                                                    Pendiente
                                                </button>
                                                <button type="submit" name="estado_administrativo" value="recibido"
                                                    class="btn btn-sm {{ $item->estado_administrativo === 'recibido' ? 'btn-success' : 'btn-outline-success' }}">
                                                    Recibido
                                                </button>
                                                <button type="submit" name="estado_administrativo" value="rechazado"
                                                    class="btn btn-sm {{ $item->estado_administrativo === 'rechazado' ? 'btn-danger' : 'btn-outline-danger' }}">
                                                    Rechazado
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('financieras.show', $item->id) }}" class="btn btn-sm btn-outline-primary">Ver detalles</a>
                                        <a href="{{ route('despacho.financieras.edit', $item->id) }}" class="btn btn-sm btn-outline-success">Completar registro</a>
                                        <form action="{{ route('despacho.financieras.enviar', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                onclick="return confirm('¿Enviar este documento a Tesorería?')">
                                                Enviar
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                                        "infoFiltered": "(filtrado de _MAX_ registros en total)",
                                        "lengthMenu": "Mostrar _MENU_ registros",
                                        "loadingRecords": "Cargando...",
                                        "processing": "Procesando...",
                                        "search": "Buscador:",
                                        "zeroRecords": "No se encontraron resultados",
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
                                            buttons: [
                                                { extend: 'copy', text: 'Copiar' },
                                                { extend: 'pdf', text: 'PDF' },
                                                { extend: 'csv', text: 'CSV' },
                                                { extend: 'excel', text: 'Excel' },
                                                { extend: 'print', text: 'Imprimir' }
                                            ]
                                        },
                                        {
                                            extend: 'colvis',
                                            text: 'Visor de columnas'
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
</div>
@endsection
