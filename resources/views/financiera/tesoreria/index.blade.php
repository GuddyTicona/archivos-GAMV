@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">

            {{-- Dropdown de notificaciones --}}
            <div class="mb-3 d-flex justify-content-end">
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" id="notifDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        @if($notificaciones->where('leido', false)->count() > 0)
                            <span class="badge bg-danger" id="notif-count">
                                {{ $notificaciones->where('leido', false)->count() }}
                            </span>
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="width:300px;">
                        @forelse($notificaciones->where('leido', false) as $n)
                            <li class="dropdown-item d-flex justify-content-between align-items-start" id="notif-item-{{ $n->id }}">
                                <div>
                                    <small class="text-muted">{{ $n->created_at->format('d/m/Y H:i') }}</small><br>
                                    {{ $n->mensaje }}
                                </div>
                                <button class="btn btn-sm btn-outline-success marcar-leida" 
                                        data-id="{{ $n->id }}"
                                        data-financiera="{{ $n->financiera_id }}">
                                    ✔
                                </button>
                            </li>
                        @empty
                            <li class="dropdown-item text-center text-muted">No hay notificaciones</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Mensaje de sesión --}}
            @if(session('mensaje'))
                <script>
                    Swal.fire({
                        title: "Felicidades",
                        text: "{{ session('mensaje') }}",
                        icon: "success"
                    });
                </script>
            @endif

            {{-- Tabla financieras Tesorería --}}
            <div class="card">
                <div class="card-header">
                    <span id="card_title">{{ __('Registros Recibidos en Tesorería') }}</span>
                </div>
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Entidad</th>
                                    <th>Unidad</th>
                                    <th>Área Receptora</th>
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
                                    <th>Estado Tesorería</th>
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
                                        <form action="{{ route('financieras.estado_despacho', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="btn-group">
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
                                        <a href="{{ route('tesoreria.financieras.edit', $item->id) }}" class="btn btn-sm btn-warning">
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
                                        
                                        {{-- Badge de notificación --}}
                                        <span class="badge-container" data-id="{{ $item->id }}">
                                            @if($item->notificaciones->where('leido', false)->count() > 0)
                                                <span class="badge bg-info">¡Nueva notificación!</span>
                                            @else
                                                <span class="badge bg-success">Leído</span>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {

    // Inicializar DataTable
    $("#example1").DataTable({
        "pageLength": 5,
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando START a END de TOTAL registros",
            "lengthMenu": "Mostrar MENU registros",
            "search": "Buscador:",
            "zeroRecords": "No se encontraron resultados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    // Función global para marcar notificación como leída
    window.marcarLeida = function(notificacion_id, financiera_id) {
        fetch('/notificaciones/marcar-leida/' + notificacion_id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                const notifItem = document.getElementById('notif-item-' + notificacion_id);
                if(notifItem) notifItem.remove();
                const badgeContainer = document.querySelector('.badge-container[data-id="' + financiera_id + '"]');
                if(badgeContainer) badgeContainer.innerHTML = '<span class="badge bg-success">Leído</span>';
                const countElem = document.getElementById('notif-count');
                if(countElem){
                    let newCount = parseInt(countElem.innerText.trim()) - 1;
                    if(newCount > 0) countElem.innerText = newCount;
                    else countElem.remove();
                }
            }
        })
        .catch(err => console.error(err));
    };

    // Delegación de eventos para botones "marcar como leído"
    document.querySelector('ul.dropdown-menu').addEventListener('click', function(e){
        if(e.target.classList.contains('marcar-leida')){
            e.preventDefault();
            let notificacion_id = e.target.dataset.id;
            let financiera_id = e.target.dataset.financiera;
            window.marcarLeida(notificacion_id, financiera_id);
        }
    });

    // Alerta para nueva notificación
    @if(session('nueva_notificacion'))
        let notif = @json(session('nueva_notificacion'));
        Swal.fire({
            title: "Nueva Notificación",
            html: 'Se envió una financiera: <br><strong>' + notif.mensaje + '</strong>',
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Marcar como leído",
            cancelButtonText: "Cerrar"
        }).then((result) => {
            if(result.isConfirmed){
                window.marcarLeida(notif.id, notif.financiera_id);
            }
        });
    @endif

});
</script>
@endsection