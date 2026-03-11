

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    
            
            <?php if(session('mensaje')): ?>
                <script>
                    Swal.fire({
                        title: "Felicidades",
                        text: "<?php echo e(session('mensaje')); ?>",
                        icon: "success"
                    });
                </script>
            <?php endif; ?>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">SMAF - Financiera </h4>
                <a href="<?php echo e(route('areas.create')); ?>" class="btn btn-sm"
                    style="background-color: #ffffff; color: #0d6efd; border: 1px solid #ffffff;">
                    <i class="fas fa-plus"></i> Nueva Área
                </a>

            </div>
        </div>


        <div class="card-body">
           

            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 50px;">Nro</th>
                            <th style="width: 60px;">Área</th>
                            <th style="width: 70px;">Descripción</th>
                            <th style="width: 150px;">Actas </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center"><?php echo e($area->id); ?></td>
                            <td><?php echo e($area->nombre); ?></td>
                            <td><?php echo e($area->descripcion); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('areas.show', $area->id)); ?>" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-folder-open"></i> Ver registros 
                                </a>
                                <!--<a href="<?php echo e(route('areas.generarReporte', $area->id)); ?>" class="btn btn-outline-dark btn-sm">
                                    <i class="fa fa-file-pdf"></i> Generar Reporte
                                </a>-->

                                 <!--<form action="<?php echo e(route('areas.destroy', $area->id)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('¿Está seguro de eliminar esta área?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>-->
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                No existen áreas registradas actualmente.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <?php if($areas instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
        <div class="card-footer text-center">
            <?php echo e($areas->links()); ?>

        </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/areas/index.blade.php ENDPATH**/ ?>