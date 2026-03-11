

<?php $__env->startSection('content'); ?>
<div class="container py-4">

    <div class="table-responsive shadow-sm rounded bg-white p-3">
        <h4 class="fw-bold text-center text-secondary mb-4">Listado de Préstamos de Archivos</h4>
        <table class="table align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nro</th>
                    <th>Archivo</th>
                    <th>Solicitante</th>
                    <th>Cargo</th>
                    <th>Motivo</th>
                    <th>Observaciones</th>
                    <th>Fecha Préstamo</th>
                    <th>Fecha Devolución</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $prestamos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prestamo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    
                    <td><?php echo e($loop->iteration + ($prestamos->currentPage() - 1) * $prestamos->perPage()); ?></td>
                    <td><?php echo e($prestamo->financiera->codigo); ?></td>
                    <td><?php echo e($prestamo->solicitante); ?></td>
                    <td><?php echo e($prestamo->cargo_departamento ?? '-'); ?></td>
                    <td><?php echo e($prestamo->motivo_prestamo ?? '-'); ?></td>
                    <td><?php echo e($prestamo->observaciones ?? '-'); ?></td>
                    <td><?php echo e($prestamo->fecha_prestamo); ?></td>
                    <td><?php echo e($prestamo->fecha_devolucion ?? '-'); ?></td>
                    <td>
                        <?php if($prestamo->fecha_devolucion === null): ?>
                            <span class="badge bg-danger">Prestado</span>
                        <?php else: ?>
                            <span class="badge bg-success">Devuelto</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            
                            <?php if($prestamo->fecha_devolucion === null): ?>
                            <form action="<?php echo e(route('prestamos.devolver', $prestamo->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button class="btn btn-sm btn-primary" title="Marcar como devuelto">
                                   Devolver
                                </button>
                            </form>
                            <?php endif; ?>
                           

                            
                            <form action="<?php echo e(route('prestamos.destroy', $prestamo->id)); ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este préstamo?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger" title="Eliminar préstamo">
                                  Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="10" class="text-center text-muted">No hay préstamos registrados.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        
        <div class="d-flex justify-content-center mt-3">
            <?php echo e($prestamos->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/prestamos/index.blade.php ENDPATH**/ ?>