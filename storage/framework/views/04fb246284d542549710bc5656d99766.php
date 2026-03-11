

<?php $__env->startSection('content'); ?>
<div class="container bg-white p-5 rounded shadow-sm">
    <h2 class="text-center mb-4 fw-bold">Revisión de Acta Financiera SMAF</h2>

    
    <form method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-8">
                <input type="text" name="buscar" value="<?php echo e(request('buscar')); ?>" class="form-control" placeholder="Buscar por entidad, documento, unidad, preventivo, empresa...">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary w-100" type="submit">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </div>
        
        
        <?php if(request('fecha')): ?>
            <input type="hidden" name="fecha" value="<?php echo e(request('fecha')); ?>">
        <?php endif; ?>
        
        <?php if(request('buscar') || (request('fecha') && request('fecha') != $fecha_reciente)): ?>
        <div class="mt-2">
            <a href="<?php echo e(route('areas.show', $area->id)); ?>" class="btn btn-sm btn-outline-danger">
               </i> Limpiar 
            </a>
       
            
           
        </div>
        <?php endif; ?>
    </form>

    <?php
        $fechaParaReporte = request('fecha') ?? $fecha_acta ?? $fecha_reciente;
    ?>

    <?php if(!$registros_actuales->isEmpty()): ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold d-flex justify-content-between align-items-center">
            <?php if(request()->filled('buscar')): ?>
                Resultados de búsqueda
                <?php if(request('fecha')): ?>
                    - Fecha: <?php echo e(\Carbon\Carbon::parse($fechaParaReporte)->format('d/m/Y')); ?>

                <?php endif; ?>
                (<?php echo e($registros_actuales->count()); ?> resultado<?php echo e($registros_actuales->count() != 1 ? 's' : ''); ?>)
            <?php elseif(request()->filled('fecha')): ?>
                Acta de la fecha: <?php echo e(\Carbon\Carbon::parse($fechaParaReporte)->format('d/m/Y')); ?>

            <?php else: ?>
                Registros recientes (Fecha: <?php echo e(\Carbon\Carbon::parse($fechaParaReporte)->format('d/m/Y')); ?>)
            <?php endif; ?>

            
            <form action="<?php echo e(route('areas.generarReporte', ['id' => $area->id])); ?>" method="GET" target="_blank">
                <input type="hidden" name="fecha" value="<?php echo e($fechaParaReporte); ?>">
                <button class="btn btn-light btn-sm">
                    <i class="bi bi-download"></i> Descargar Reporte
                </button>
            </form>
        </div>
        <div class="card-body">
            <?php $__currentLoopData = $registros_actuales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $color = match($registro->estado_administrativo) {
                        'recibido' => 'success',
                        'pendiente' => 'warning',
                        'rechazado' => 'danger',
                        default => 'secondary',
                    };
                ?>
                <div class="card mb-3 shadow-sm hover-shadow">
                    <div class="card-header d-flex justify-content-between align-items-center bg-dark">
                        <h5 class="mb-0"><?php echo e($registro->entidad); ?></h5>
                        <span class="badge bg-<?php echo e($color); ?>"><?php echo e(ucfirst($registro->estado_administrativo)); ?></span>
                    </div>
                    <div class="card-body bg-light-subtle rounded p-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Unidad</label>
                                <input type="text" class="form-control" value="<?php echo e($registro->unidad->nombre_unidad ?? 'No asignada'); ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tipo de Documento</label>
                                <input type="text" class="form-control" value="<?php echo e($registro->tipo_documento); ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tipo de Ejecución</label>
                                <input type="text" class="form-control" value="<?php echo e($registro->tipo_ejecucion); ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Fecha Envío</label>
                                <input type="text" class="form-control" value="<?php echo e(\Carbon\Carbon::parse($registro->fecha_envio)->format('d/m/Y')); ?>" readonly>
                            </div>
                        </div>

                        
                        <?php if($registro->preventivos->isNotEmpty()): ?>
                        <hr>
                        <h6 class="fw-bold">Preventivos:</h6>
                        <?php $__currentLoopData = $registro->preventivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preventivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row g-3 mb-2 p-2 border rounded bg-white shadow-sm">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">N° Preventivo</label>
                                <input type="text" class="form-control" value="<?php echo e($preventivo->numero_preventivo); ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Empresa</label>
                                <input type="text" class="form-control" value="<?php echo e($preventivo->empresa); ?>" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Descripción</label>
                                <input type="text" class="form-control" value="<?php echo e($preventivo->descripcion_gasto); ?>" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold">Total Pago</label>
                                <input type="text" class="form-control" value="Bs <?php echo e(number_format($preventivo->total_pago, 3, '.', '')); ?>" readonly>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle"></i> 
            No se encontraron registros
            <?php if(request('buscar')): ?>
                que coincidan con la búsqueda "<?php echo e(request('buscar')); ?>"
            <?php endif; ?>
            <?php if(request('fecha')): ?>
                para la fecha <?php echo e(\Carbon\Carbon::parse(request('fecha'))->format('d/m/Y')); ?>

            <?php endif; ?>
        </div>
    <?php endif; ?>

    
    <?php if($fechas_anteriores->isNotEmpty()): ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold">Ver Actas por Fecha</div>
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-center">
                <div class="col-md-6 mb-3">
                    <label for="fecha">Seleccione una fecha</label>
                    <select name="fecha" id="fecha" class="form-control">
                        <option value="">-- Todas las fechas --</option>
                        <?php $__currentLoopData = $fechas_anteriores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fecha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($fecha); ?>" <?php echo e(request('fecha') == $fecha ? 'selected' : ''); ?>>
                                <?php echo e(\Carbon\Carbon::parse($fecha)->format('d/m/Y')); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                
                <?php if(request('buscar')): ?>
                    <input type="hidden" name="buscar" value="<?php echo e(request('buscar')); ?>">
                <?php endif; ?>
                
                <div class="col-md-6 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        </i> Ver actas 
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <a href="<?php echo e(route('areas.index')); ?>" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    transition: 0.3s;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/areas/show.blade.php ENDPATH**/ ?>