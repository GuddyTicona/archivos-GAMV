<?php $__env->startSection('content'); ?>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Crear nuevo archivo</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="<?php echo e(route('archivos.store')); ?>" role="form"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <?php echo $__env->make('archivo.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/archivo/create.blade.php ENDPATH**/ ?>