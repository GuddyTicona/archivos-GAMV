<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre_categoria" class="form-label"><?php echo e(__('Nombre Categoria')); ?></label>
            <input type="text" name="nombre_categoria" class="form-control <?php $__errorArgs = ['nombre_categoria'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nombre_categoria', $categoria?->nombre_categoria)); ?>" id="nombre_categoria" placeholder="Nombre Categoria">
            <?php echo $errors->first('nombre_categoria', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label"><?php echo e(__('Descripcion')); ?></label>
            <input type="text" name="descripcion" class="form-control <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('descripcion', $categoria?->descripcion)); ?>" id="descripcion" placeholder="Descripcion">
            <?php echo $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'); ?>

        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Guardar Registro</button>
          <a href="<?php echo e(route('categorias.index')); ?>" class="btn btn-secondary">Volver</a>
    </div>
</div><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/categoria/form.blade.php ENDPATH**/ ?>