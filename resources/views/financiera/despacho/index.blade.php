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
                        <span class="badge bg-danger"
                            id="notif-count">{{ $notificaciones->where('leido', false)->count() }}</span>
                        @endif
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" style="width:300px;">
                        @forelse($notificaciones->where('leido', false) as $n)
                        <li class="dropdown-item d-flex justify-content-between align-items-start"
                            id="notif-item-{{ $n->id }}">
                            <div>
                                <small class="text-muted">{{ $n->created_at->format('d/m/Y H:i') }}</small><br>
                                {{ $n->mensaje }}
                            </div>
                            <button class="btn btn-sm btn-outline-success marcar-leida" data-id="{{ $n->id }}"
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

            {{-- Mensaje general --}}
            @if($message = Session::get('mensaje'))
            <script>
            Swal.fire({
                title: "Felicidades",
                text: "{{$message}}",
                icon: "success"
            });
            </script>
            @endif

            {{-- Tabla financieras --}}
            <div class="card">
                <div class="card-header">
                    <span id="card_title">{{ __('Registros Financieros (Despacho)') }}</span>
                </div>

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Entidad</th>
                                    <th>Unidad</th>
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
                                        <form action="{{ route('financieras.estado_administrativo', $item->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="btn-group">
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
                                        <a href="{{ route('financieras.show', $item->id) }}"
                                            class="btn btn-sm btn-outline-primary">Ver detalles</a>
                                        <a href="{{ route('despacho.financieras.edit', $item->id) }}"
                                            class="btn btn-sm btn-outline-success">Completar registro</a>
                                        <form action="{{ route('despacho.financieras.enviar', $item->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                onclick="return confirm('¿Enviar este documento a Tesorería?')">Enviar</button>
                                        </form>

                                        {{-- Badge --}}
                                        <span class="badge-container" data-id="{{ $item->id }}">
                                            @if($item->notificaciones->where('leido', false)->count() > 0)
                                            <span class="badge bg-info notificacion-item">¡Nueva notificación!</span>
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

    // ✅ Inicializar DataTable
    $("#example1").DataTable({
        "pageLength": 5,
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando START a END de TOTAL registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(filtrado de MAX registros en total)",
            "lengthMenu": "Mostrar MENU registros",
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
        }
    });

    // 🔔 Función central para marcar como leído
    function marcarLeida(notificacion_id, financiera_id) {
        fetch('/notificaciones/marcar-leida/' + notificacion_id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // 1️⃣ Quitar notificación del dropdown
                    const notifItem = document.getElementById('notif-item-' + notificacion_id);
                    if (notifItem) notifItem.remove();

                    // 2️⃣ Cambiar badge en la tabla a "Leído"
                    const badgeContainer = document.querySelector('.badge-container[data-id="' +
                        financiera_id + '"]');
                    if (badgeContainer) badgeContainer.innerHTML =
                        '<span class="badge bg-success">Leído</span>';

                    // 3️⃣ Reducir contador de la campana
                    const countElem = document.getElementById('notif-count');
                    if (countElem) {
                        let newCount = parseInt(countElem.innerText.trim()) - 1;
                        if (newCount > 0) {
                            countElem.innerText = newCount;
                        } else {
                            countElem.remove();
                        }
                    }
                }
            })
            .catch(err => console.error('Error al marcar notificación:', err));
    }

    // 🔔 Botones del dropdown
    document.querySelector('ul.dropdown-menu').addEventListener('click', function(e) {
        if (e.target.classList.contains('marcar-leida')) {
            let notificacion_id = e.target.dataset.id;
            let financiera_id = e.target.dataset.financiera;
            marcarLeida(notificacion_id, financiera_id);
        }
    });


    // 🔔 Alerta Swal de nueva notificación
    @if(session('nueva_notificacion'))
    let notif = @json(session('nueva_notificacion'));
    Swal.fire({
        title: "Nueva Notificación",
        html: 'Se envió una financiera: <br>' + notif.mensaje,
        icon: "info",
        confirmButtonText: "Marcar como leído"
    }).then((result) => {
        if (result.isConfirmed) {
            marcarLeida(notif.id, notif.financiera_id);
        }
    });
    @endif

});
</script>
@endsection