@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Registros Recibidos en Tesorería') }}
                        </span>
                    </div>
                </div>

                @if(session('mensaje'))
                <script>
                Swal.fire({
                    title: "Felicidades",
                    text: "{{ session('mensaje') }}",
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
                                    <th>Área Receptora</th>
                                    <th>Estado Documento</th>
                                    <th>Tipo Documento</th>
                                    <th>Tipo Ejecución</th>
                                    <th>Fecha Documento</th>
                                    <th>N° Compromiso</th>
                                    <th>N° Devengado</th>
                                    <th>N° Pago</th>
                                    <th>N° Foja</th>
                                    <th>N° Hoja Ruta</th>
                                    <th>Acta Despacho</th>
                                    <th>Preventivos</th>
                                    <th>Revision Despacho</th>
                                    <th>Estado tesoreria</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($financieras as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->entidad }}</td>
                                    <td>{{ $item->unidad->nombre_unidad ?? 'N/D' }}</td>
                                    <td>{{ $item->area->nombre ?? 'N/D' }}</td>
                                    <td>{{ ucfirst($item->estado_documento) }}</td>
                                    <td>{{ $item->tipo_documento }}</td>
                                    <td>{{ $item->tipo_ejecucion }}</td>
                                    <td>{{ $item->fecha_documento }}</td>
                                    <td>{{ $item->numero_compromiso }}</td>
                                    <td>{{ $item->numero_devengado }}</td>
                                    <td>{{ $item->numero_pago }}</td>
                                    <td>{{ $item->numero_foja }}</td>
                                    <td>{{ $item->numero_hoja_ruta }}</td>
                                    <td>{{ $item->areaDespacho->nombre ?? 'N/D' }}</td>
                                    <td>
                                        @foreach($item->preventivos as $preventivo)
                                        <div>
                                            <strong>{{ $preventivo->numero_preventivo }}</strong><br>
                                            N° Secuencia: {{ $preventivo->numero_secuencia ?? 'N/D' }}<br>
                                            Empresa: {{ $preventivo->empresa }}<br>
                                            Descripción Gasto: {{ $preventivo->descripcion_gasto ?? 'N/D' }}<br>
                                            Beneficiario: {{ $preventivo->beneficiario }}<br>
                                            Total Pago: {{ number_format($preventivo->total_pago, 2) }} Bs
                                        </div>
                                        <hr>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form action="{{ route('financieras.estado_despacho', $item->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="btn-group" role="group">
                                                <button type="submit" name="estado_despacho" value="pendiente"
                                                    class="btn btn-sm {{ $item->estado_despacho === 'pendiente' ? 'btn-warning' : 'btn-outline-warning' }}">
                                                    Pendiente
                                                </button>
                                                <button type="submit" name="estado_despacho" value="recibido"
                                                    class="btn btn-sm {{ $item->estado_despacho === 'recibido' ? 'btn-success' : 'btn-outline-success' }}">
                                                    Recibido
                                                </button>
                                                <button type="submit" name="estado_despacho" value="rechazado"
                                                    class="btn btn-sm {{ $item->estado_despacho === 'rechazado' ? 'btn-danger' : 'btn-outline-danger' }}">
                                                    Rechazado
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>{{ $item->estado_tesoreria ?? 'Pendiente' }}</td>
                                    <td>
                                        {{-- Editar Tesorería --}}
                                        <a href="{{ route('tesoreria.financieras.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning">
                                            Editar Tesorería
                                        </a>

                                        {{-- Enviar a Archivos --}}
                                        @if($item->enviado_archivo !== 'enviado')
                                        {{-- Nunca enviado, mostrar botón Enviar --}}
                                        <form action="{{ route('financieras.enviar', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success"
                                                onclick="return confirm('¿Desea enviar este documento a Archivos?')">
                                                Enviar a Archivos
                                            </button>
                                        </form>
                                        @else
                                        @if($item->fecha_envio && $item->updated_at > $item->fecha_envio)
                                        {{-- Fue modificado después de ser enviado --}}
                                        <form action="{{ route('financieras.enviar', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-warning"
                                                onclick="return confirm('El documento fue modificado. ¿Desea reenviar a Archivos?')">
                                                Reenviar a Archivos
                                            </button>
                                        </form>
                                        @else
                                        {{-- Ya enviado y sin modificaciones posteriores --}}
                                        <span class="badge badge-success">Enviado</span>
                                        @endif
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- No uses paginación Laravel porque usas DataTables --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                buttons: [{
                        text: 'Copiar',
                        extend: 'copy'
                    },
                    {
                        extend: 'pdf'
                    },
                    {
                        extend: 'csv'
                    },
                    {
                        extend: 'excel'
                    },
                    {
                        text: 'Imprimir',
                        extend: 'print'
                    }
                ]
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

@endsection