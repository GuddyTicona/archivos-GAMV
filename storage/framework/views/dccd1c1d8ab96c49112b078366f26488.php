<?php $__env->startSection('content'); ?>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">Detalle del archivo</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('archivos.index')); ?>"> Volver</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Codigo Archivo:</strong>
                        <?php echo e($archivo->codigo_archivo); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Descripcion Documento:</strong>
                        <?php echo e($archivo->descripcion_documento); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Tomo:</strong>
                        <?php echo e($archivo->tomo); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numero Foja:</strong>
                        <?php echo e($archivo->numero_foja); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Gestion:</strong>
                        <?php echo e($archivo->gestion); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Unidad Instalacion:</strong>
                        <?php echo e($archivo->unidad_instalacion); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Observaciones:</strong>
                        <?php echo e($archivo->observaciones); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Fecha Registro:</strong>
                        <?php echo e($archivo->fecha_registro); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Unidad que pertenece:</strong>
                        <?php echo e($archivo->unidad->nombre_unidad); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Estado:</strong>
                        <?php echo e($archivo->estado); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Categoria docuemntos que pertenece:</strong>
                        <?php echo e($archivo->Categorias ->nombre_categoria); ?>

                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Documento Adjunto:</strong>
                        <?php echo e($archivo->documento_adjunto); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/archivo/show.blade.php ENDPATH**/ ?>