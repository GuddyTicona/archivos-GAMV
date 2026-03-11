<?php $__env->startSection('content'); ?>
<div class="container">
    
    <form action="<?php echo e(route('archivos.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <div class="card shadow-lg rounded-4 mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Registro de Archivo</h4>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="codigo_archivo">Código Archivo</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['codigo_archivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="codigo_archivo" id="codigo_archivo"
                                value="<?php echo e(old('codigo_archivo', $archivo?->codigo_archivo)); ?>"
                                placeholder="Código archivo">
                            <?php echo $errors->first('codigo_archivo','<div class="invalid-feedback">:message</div>'); ?>

                        </div>

                        <div class="mb-3">
                            <label for="descripcion_documento">Descripción Documento</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['descripcion_documento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="descripcion_documento" id="descripcion_documento"
                                value="<?php echo e(old('descripcion_documento', $archivo?->descripcion_documento)); ?>"
                                placeholder="Descripción del documento...">
                            <?php echo $errors->first('descripcion_documento','<div class="invalid-feedback">:message</div>'); ?>

                        </div>

                        <div class="mb-3">
                            <label for="tomo">Tomo</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['tomo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="tomo" id="tomo" value="<?php echo e(old('tomo', $archivo?->tomo)); ?>"
                                placeholder="Número de tomo">
                            <?php echo $errors->first('tomo','<div class="invalid-feedback">:message</div>'); ?>

                        </div>

                        <div class="mb-3">
                            <label for="numero_foja">Número Foja</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['numero_foja'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="numero_foja" id="numero_foja" value="<?php echo e(old('numero_foja', $archivo?->numero_foja)); ?>"
                                placeholder="Número de foja">
                            <?php echo $errors->first('numero_foja','<div class="invalid-feedback">:message</div>'); ?>

                        </div>

                        <div class="mb-3">
                            <label for="gestion">Gestión</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['gestion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="gestion" id="gestion" value="<?php echo e(old('gestion', $archivo?->gestion)); ?>"
                                placeholder="Gestión">
                            <?php echo $errors->first('gestion','<div class="invalid-feedback">:message</div>'); ?>

                        </div>

                    </div>

                    
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="unidad_instalacion">Unidad Instalación</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['unidad_instalacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="unidad_instalacion" id="unidad_instalacion"
                                value="<?php echo e(old('unidad_instalacion', $archivo?->unidad_instalacion)); ?>"
                                placeholder="Empastado, folder amarillo">
                            <?php echo $errors->first('unidad_instalacion','<div class="invalid-feedback">:message</div>'); ?>

                        </div>

                        <div class="mb-3">
                            <label for="observaciones">Observaciones</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="observaciones" id="observaciones"
                                value="<?php echo e(old('observaciones', $archivo?->observaciones)); ?>"
                                placeholder="Observaciones">
                            <?php echo $errors->first('observaciones','<div class="invalid-feedback">:message</div>'); ?>

                        </div>

                        <div class="mb-3">
                            <label for="fecha_registro">Fecha Registro</label>
                            <input type="date" class="form-control <?php $__errorArgs = ['fecha_registro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="fecha_registro" id="fecha_registro"
                                value="<?php echo e(old('fecha_registro', $archivo?->fecha_registro)); ?>">
                            <?php echo $errors->first('fecha_registro','<div class="invalid-feedback">:message</div>'); ?>

                        </div>

                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="unidad_id">Unidad</label>
                                <select name="unidad_id" id="unidad_id"
                                    class="form-control <?php $__errorArgs = ['unidad_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Selecciona una unidad --</option>
                                    <?php $__currentLoopData = $unidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id); ?>" <?php echo e(old('unidad_id', $archivo?->unidad_id)==$id?'selected':''); ?>>
                                        <?php echo e($nombre); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php echo $errors->first('unidad_id','<div class="invalid-feedback">:message</div>'); ?>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado"
                                    class="form-control <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Selecciona estado --</option>
                                    <option value="Activo" <?php echo e(old('estado', $archivo?->estado) == 'Activo' ? 'selected':''); ?>>Activo</option>
                                    <option value="Inactivo" <?php echo e(old('estado', $archivo?->estado) == 'Inactivo' ? 'selected':''); ?>>Inactivo</option>
                                </select>
                                <?php echo $errors->first('estado','<div class="invalid-feedback">:message</div>'); ?>

                            </div>

                            <div class="col-12 mb-3">
                                <label for="categoria_id">Categoría</label>
                                <select name="categoria_id" id="categoria_id"
                                    class="form-control <?php $__errorArgs = ['categoria_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Selecciona una categoría --</option>
                                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id); ?>" <?php echo e(old('categoria_id',$archivo?->categoria_id)==$id?'selected':''); ?>>
                                        <?php echo e($nombre); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php echo $errors->first('categoria_id','<div class="invalid-feedback">:message</div>'); ?>

                            </div>
                        </div>

                    </div>
                </div>

                
                <div class="mb-3 mt-3 col-md-4">
                    <label for="documento_adjunto" class="form-label">Documento Adjunto</label>
                    <input type="file" name="documento_adjunto" id="documento_adjunto"
                        class="form-control <?php $__errorArgs = ['documento_adjunto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <?php echo $errors->first('documento_adjunto','<div class="invalid-feedback">:message</div>'); ?>

                </div>

                
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary">Registrar Archivo</button>
                    <a href="<?php echo e(route('archivos.index')); ?>" class="btn btn-secondary">Volver</a>
                </div>

            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/archivo/form.blade.php ENDPATH**/ ?>