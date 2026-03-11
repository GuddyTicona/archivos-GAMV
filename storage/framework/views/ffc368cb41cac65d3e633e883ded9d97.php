
<?php $__env->startSection('content'); ?>
<div class="content" style="margin-left: 70px">
    
    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Registro de datos unidad</b></h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card-body" style="display: block;">
                    <form action="<?php echo e(url('/unidades')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> Nombre unidad</label>
                                    <input type="text" name="nombre_unidad" value="<?php echo e(old('nombre_unidad')); ?>"
                                        class="form-control" required>
                                    <?php $__errorArgs = ['nombre_unidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small style="color: red;">Este campo debe ser llenado</small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Descripcion unidad</label>
                                    <input type="text" name="descripcion" value="<?php echo e(old('descripcion')); ?>"
                                        class="form-control" required>
                                    <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small style="color: red;">Este campo debe ser llenado</small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> Fecha</label>
                                    <input type="date" name="fecha_creacion" value="<?php echo e(old('fecha_creacion')); ?>"
                                        class="form-control" required>
                                    <?php $__errorArgs = ['fecha_creacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small style="color: red;">Este campo debe ser llenado</small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <!--  <div class="col-md-3"></div>-->
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                             
                                    <button type="submit" class="btn btn-primary">Guardar Registro</button>
                                      <a href="<?php echo e(route('unidades.index')); ?>" class="btn btn-secondary">Volver</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/unidades/create.blade.php ENDPATH**/ ?>