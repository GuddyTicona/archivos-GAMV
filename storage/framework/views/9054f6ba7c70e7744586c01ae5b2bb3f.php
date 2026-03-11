

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Registrar préstamo</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('prestamo_central.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <?php if($archivo): ?>
                <div class="alert alert-info">
                    <strong>Archivo seleccionado:</strong> <?php echo e($archivo->codigo_archivo); ?> - <?php echo e($archivo->descripcion_documento); ?>

                    <input type="hidden" name="archivo_id" value="<?php echo e($archivo->id); ?>">
                </div>
                <?php endif; ?>

                <div class="row">
                    <!-- Primera fila: Solicitante y Cargo -->
                    <div class="col-md-6 mb-3">
                        <label for="solicitante" class="form-label">Solicitante</label>
                        <input type="text" name="solicitante" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cargo_departamento" class="form-label">Cargo / Departamento</label>
                        <input type="text" name="cargo_departamento" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <!-- Segunda fila: Motivo y Observaciones -->
                    <div class="col-md-6 mb-3">
                        <label for="motivo_prestamo" class="form-label">Motivo del préstamo</label>
                        <textarea name="motivo_prestamo" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fecha_prestamo" class="form-label">Fecha de préstamo</label>
                        <input type="date" name="fecha_prestamo" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                    
                </div>
                <div class="row">
<div class="col-md-6 mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea name="observaciones" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-2">
                    <button type="submit" class="btn btn-primary me-2">
                         Guardar 
                    </button>
                 
                    <a href="<?php echo e(route('archivos.index')); ?>" class="btn btn-secondary">
                         Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/prestamo_central/create.blade.php ENDPATH**/ ?>