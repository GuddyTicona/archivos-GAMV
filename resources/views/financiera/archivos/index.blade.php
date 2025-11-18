@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <!-- Tabla -->
    <div class="table-responsive shadow-sm rounded bg-white p-2">
         <h4 class="mb-3">Archivos Financieros</h4>

        {{-- Dropdown de notificaciones --}}
        <div class="mb-3 d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <button class="btn btn-sm btn-outline-success marcar-leida" data-id="{{ $n->id }}" data-financiera="{{ $n->financiera_id }}">✔</button>
                        </li>
                    @empty
                        <li class="dropdown-item text-center text-muted">No hay notificaciones</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Buscador externo -->
        <div class="mb-3">
            <input type="text" id="searchTable" class="form-control shadow-sm" placeholder="Buscar cualquier dato...">
        </div>

        <table class="table table-striped table-hover align-middle" id="filesTable">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Entidad</th>
                    <th>Área / Unidad</th>
                    <th>Tipo Documento</th>
                    <th>Fecha</th>
                    <th>Hoja Ruta</th>
                    <th>Foja</th>
                    <th>Estado Tesorería</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($financieras as $item)
                    <tr>
                        <td>{{ $item->codigo }}</td>
                        <td>{{ $item->entidad }}</td>
                        <td>{{ $item->area->nombre ?? 'N/D' }} / {{ $item->unidad->nombre_unidad ?? 'N/D' }}</td>
                        <td>{{ $item->tipo_documento }}</td>
                        <td>{{ $item->fecha_documento }}</td>
                        <td>{{ $item->numero_hoja_ruta }}</td>
                        <td>{{ $item->numero_foja }}</td>
                        <td>
                            <form action="{{ route('financieras.estado_tesoreria', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="btn-group" role="group">
                                    <button type="submit" name="estado_tesoreria" value="pendiente" class="btn btn-sm {{ $item->estado_tesoreria === 'pendiente' ? 'btn-warning text-dark' : 'btn-outline-warning' }}">Pendiente</button>
                                    <button type="submit" name="estado_tesoreria" value="recibido" class="btn btn-sm {{ $item->estado_tesoreria === 'recibido' ? 'btn-success' : 'btn-outline-success' }}">Recibido</button>
                                    <button type="submit" name="estado_tesoreria" value="rechazado" class="btn btn-sm {{ $item->estado_tesoreria === 'rechazado' ? 'btn-danger' : 'btn-outline-danger' }}">Rechazado</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('financieras.archivos.show', $item->id) }}" class="btn btn-primary btn-sm">Ver</a>
                                <a href="{{ route('financieras.editArchivo', $item->id) }}" class="btn btn-warning btn-sm">Editar Archivo</a>
                                <a href="{{ route('ubicaciones.seleccionarEstante', $item->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pin-map-fill"></i> Asignar</a>
                            </div>
                            <span class="badge-container" data-id="{{ $item->id }}">
                                @if($item->notificaciones->where('leido', false)->count() > 0)
                                    <span class="badge bg-info">¡Nueva notificación!</span>
                                @else
                                    <span class="badge bg-success">Leído</span>
                                @endif
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">No hay registros que coincidan con la búsqueda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    const table = $('#filesTable').DataTable({
        paging: true,
        ordering: true,
        info: true,
        responsive: true,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            zeroRecords: "No se encontraron resultados"
        }
    });

    $('#searchTable').on('keyup', function() {
        table.search(this.value).draw();
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
    document.querySelector('ul.dropdown-menu').addEventListener('click', function(e) {
        if(e.target.classList.contains('marcar-leida')){
            e.preventDefault();
            let notificacion_id = e.target.dataset.id;
            let financiera_id = e.target.dataset.financiera;
            window.marcarLeida(notificacion_id, financiera_id);
        }
    });

    // Mostrar notificaciones tipo toast
    @foreach($notificaciones->where('leido', false) as $n)
        Swal.fire({
            title: "Nueva Notificación",
            text: "{{ $n->mensaje }}",
            icon: "info",
            toast: true,
            position: 'top-end',
            showConfirmButton: true,
            confirmButtonText: "Marcar como leído",
            timer: 5000,
            timerProgressBar: true
        }).then((result) => {
            if(result.isConfirmed){
                window.marcarLeida({{ $n->id }}, {{ $n->financiera_id }});
            }
        });
    @endforeach

    // Alerta de nueva notificación vía sesión
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
