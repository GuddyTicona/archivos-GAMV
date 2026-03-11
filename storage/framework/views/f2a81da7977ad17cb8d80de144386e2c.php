

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <!-- Tabla -->
    <div class="table-responsive shadow-sm rounded bg-white p-2">
         <h4 class="mb-3">Archivos Financieros</h4>

        
        <div class="mb-3 d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <?php if($notificaciones->where('leido', false)->count() > 0): ?>
                        <span class="badge bg-danger" id="notif-count">
                            <?php echo e($notificaciones->where('leido', false)->count()); ?>

                        </span>
                    <?php endif; ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" style="width:300px;">
                    <?php $__empty_1 = true; $__currentLoopData = $notificaciones->where('leido', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="dropdown-item d-flex justify-content-between align-items-start" id="notif-item-<?php echo e($n->id); ?>">
                            <div>
                                <small class="text-muted"><?php echo e($n->created_at->format('d/m/Y H:i')); ?></small><br>
                                <?php echo e($n->mensaje); ?>

                            </div>
                            <button class="btn btn-sm btn-outline-success marcar-leida" data-id="<?php echo e($n->id); ?>" data-financiera="<?php echo e($n->financiera_id); ?>">✔</button>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="dropdown-item text-center text-muted">No hay notificaciones</li>
                    <?php endif; ?>
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
                <?php $__empty_1 = true; $__currentLoopData = $financieras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->codigo); ?></td>
                        <td><?php echo e($item->entidad); ?></td>
                        <td><?php echo e($item->area->nombre ?? 'N/D'); ?> / <?php echo e($item->unidad->nombre_unidad ?? 'N/D'); ?></td>
                        <td><?php echo e($item->tipo_documento); ?></td>
                        <td><?php echo e($item->fecha_documento); ?></td>
                        <td><?php echo e($item->numero_hoja_ruta); ?></td>
                        <td><?php echo e($item->numero_foja); ?></td>
                        <td>
                            <form action="<?php echo e(route('financieras.estado_tesoreria', $item->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="btn-group" role="group">
                                    <button type="submit" name="estado_tesoreria" value="pendiente" class="btn btn-sm <?php echo e($item->estado_tesoreria === 'pendiente' ? 'btn-warning text-dark' : 'btn-outline-warning'); ?>">Pendiente</button>
                                    <button type="submit" name="estado_tesoreria" value="recibido" class="btn btn-sm <?php echo e($item->estado_tesoreria === 'recibido' ? 'btn-success' : 'btn-outline-success'); ?>">Recibido</button>
                                    <button type="submit" name="estado_tesoreria" value="rechazado" class="btn btn-sm <?php echo e($item->estado_tesoreria === 'rechazado' ? 'btn-danger' : 'btn-outline-danger'); ?>">Rechazado</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('financieras.archivos.show', $item->id)); ?>" class="btn btn-primary btn-sm">Ver</a>
                                <a href="<?php echo e(route('financieras.editArchivo', $item->id)); ?>" class="btn btn-warning btn-sm">Editar Archivo</a>
                               <?php if($item->ubicacion_id): ?>
                                    <button class="btn btn-success btn-sm" disabled>
                                        <i class="bi bi-check-circle-fill"></i> Asignado
                                    </button>
                                <?php else: ?>
                                    <a href="<?php echo e(route('ubicaciones.seleccionarEstante', $item->id)); ?>" class="btn btn-info btn-sm">
                                        <i class="bi bi-pin-map-fill"></i> Asignar
                                    </a>
                                <?php endif; ?>
                            </div>
                            <span class="badge-container" data-id="<?php echo e($item->id); ?>">
                                <?php if($item->notificaciones->where('leido', false)->count() > 0): ?>
                                    <span class="badge bg-info">¡Nueva notificación!</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Leído</span>
                                <?php endif; ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted">No hay registros que coincidan con la búsqueda.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
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
    <?php $__currentLoopData = $notificaciones->where('leido', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        Swal.fire({
            title: "Nueva Notificación",
            text: "<?php echo e($n->mensaje); ?>",
            icon: "info",
            toast: true,
            position: 'top-end',
            showConfirmButton: true,
            confirmButtonText: "Marcar como leído",
            timer: 5000,
            timerProgressBar: true
        }).then((result) => {
            if(result.isConfirmed){
                window.marcarLeida(<?php echo e($n->id); ?>, <?php echo e($n->financiera_id); ?>);
            }
        });
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    // Alerta de nueva notificación vía sesión
    <?php if(session('nueva_notificacion')): ?>
        let notif = <?php echo json_encode(session('nueva_notificacion'), 15, 512) ?>;
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
    <?php endif; ?>

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/financiera/archivos/index.blade.php ENDPATH**/ ?>