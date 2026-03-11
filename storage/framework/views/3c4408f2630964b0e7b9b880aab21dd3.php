<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span id="card_title">Registros financieros</span>
                    <a href="<?php echo e(route('financieras.create')); ?>" class="btn btn-primary btn-sm">Crear nuevo</a>
                </div>

                <?php if($message = Session::get('mensaje')): ?>
                <script>
                Swal.fire({
                    title: "Felicidades",
                    text: "<?php echo e($message); ?>",
                    icon: "success"
                });
                </script>
                <?php endif; ?>

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Entidad</th>
                                    <th>Unidad</th>
                                    <th>Preventivos</th>
                                    <th>Estado Documento</th>
                                    <th>Tipo Documento</th>
                                    <th>Tipo Ejecución</th>
                                    <th>Fecha Documento</th>
                                    <th>Documento Adjunto</th>
                                    <th>Hoja Ruta</th>
                                    <th>Compromiso</th>
                                    <th>Devengado</th>
                                    <th>Pago</th>
                                    <th>Secuencia</th>
                                    <th>Área</th>
                                    <th>Estado</th>
                                    <th>Actualización</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $financieras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $financiera): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$i); ?></td>
                                    <td><?php echo e($financiera->entidad); ?></td>
                                    <td><?php echo e($financiera->unidad->nombre_unidad ?? 'Sin unidad'); ?></td>

                                    <!-- Listado de preventivos -->
                                    <td>
                                        <?php $__currentLoopData = $financiera->preventivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preventivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="mb-2 border-bottom pb-1">
                                                <strong>N°:</strong> <?php echo e($preventivo->numero_preventivo); ?><br>
                                                <strong>Total:</strong> <?php echo e(number_format($preventivo->total_pago, 3)); ?><br>
                                                <strong>Desc.:</strong> <?php echo e($preventivo->descripcion_gasto); ?><br>
                                                <strong>Empresa:</strong> <?php echo e($preventivo->empresa); ?><br>
                                                <strong>Beneficiario:</strong> <?php echo e($preventivo->beneficiario); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>

                                    <td><?php echo e($financiera->estado_documento); ?></td>
                                    <td><?php echo e($financiera->tipo_documento); ?></td>
                                    <td><?php echo e($financiera->tipo_ejecucion); ?></td>
                                    <td><?php echo e($financiera->fecha_documento); ?></td>

                                    <td>
                                        <?php if($financiera->documento_adjunto): ?>
                                        <a href="<?php echo e(asset('storage/' . $financiera->documento_adjunto)); ?>"
                                            target="_blank" class="btn btn-sm btn-outline-secondary">Ver documento</a>
                                        <?php else: ?>
                                        <span class="text-muted">No adjunto</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?php echo e($financiera->numero_hoja_ruta); ?></td>
                                    <td><?php echo e($financiera->numero_compromiso); ?></td>
                                    <td><?php echo e($financiera->numero_devengado); ?></td>
                                    <td><?php echo e($financiera->numero_pago); ?></td>
                                    <td><?php echo e($financiera->numero_secuencia); ?></td>
                                    <td><?php echo e($financiera->area->nombre ?? 'No asignado'); ?></td>

                                    <!-- Estado administrativo -->
                                    <td>
                                        <form action="<?php echo e(route('financieras.estado_administrativo', $financiera->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <select name="estado" onchange="this.form.submit()" class="form-control form-control-sm">
                                                <option value="pendiente" <?php echo e($financiera->estado_administrativo == 'pendiente' ? 'selected' : ''); ?>>Enviar</option>
                                                <option value="recibido" <?php echo e($financiera->estado_administrativo == 'recibido' ? 'selected' : ''); ?>>Confirmado</option>
                                                <option value="rechazado" <?php echo e($financiera->estado_administrativo == 'rechazado' ? 'selected' : ''); ?>>Rechazado</option>
                                            </select>
                                        </form>
                                    </td>

                                    <td><?php echo e($financiera->estado_actualizado ? $financiera->estado_actualizado->timezone('America/La_Paz')->format('d/m/Y H:i') : 'No actualizado'); ?></td>

                                    <td>
                                        <form action="<?php echo e(route('financieras.destroy', $financiera->id)); ?>" method="POST">
                                            <a class="btn btn-sm btn-primary" href="<?php echo e(route('financieras.show', $financiera->id)); ?>"><i class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="<?php echo e(route('financieras.edit', $financiera->id)); ?>"><i class="fa fa-fw fa-edit"></i></a>
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?');"><i class="fa fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 5,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                                    "lengthMenu": "Mostrar _MENU_ registros",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscar:",
                                    "zeroRecords": "No se encontraron coincidencias",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Último",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                responsive: true,
                                lengthChange: true,
                                autoWidth: false,
                                buttons: [
                                    {
                                        extend: 'collection',
                                        text: 'Reportes',
                                        buttons: [
                                            'copy', 
                                            { extend: 'pdf', text: 'PDF', orientation: 'landscape', pageSize: 'LEGAL' },
                                            'csv', 'excel', 'print'
                                        ]
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Columnas'
                                    }
                                ]
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                        </script>
                    </div>
                </div>
            </div>

            <!-- Paginación -->
    
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/financiera/index.blade.php ENDPATH**/ ?>