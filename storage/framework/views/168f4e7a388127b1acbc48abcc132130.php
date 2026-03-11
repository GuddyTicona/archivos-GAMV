

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Registros Financieros SMAF</h5>
            <a href="<?php echo e(route('smaf.financieras.create')); ?>" class="btn btn-primary btn-sm">Crear Nuevo</a>
        </div>

        <div class="card-body">
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
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Entidad</th>
                                <th>Unidad</th>
                                <th>Acta smaf</th>
                   
                                <th>Estado</th>
                                <th>Fecha Documento</th>
                                <th>N° Preventivo</th>
                                <th>Total Pago (Bs)</th>
                                <th>Descripción</th>
                                <th>Empresa</th>

                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $financieras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($item->preventivos->count() > 0): ?>
                            <?php $__currentLoopData = $item->preventivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preventivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->parent->iteration); ?></td>
                                <td><?php echo e($item->entidad); ?></td>
                                <td><?php echo e($item->unidad->nombre_unidad ?? '-'); ?></td>
                                <td><?php echo e($item->area->nombre ?? '-'); ?></td>
                        
                                <td><?php echo e(ucfirst($item->estado_administrativo)); ?></td>
                                <td><?php echo e($item->fecha_documento); ?></td>
                                <td><?php echo e($preventivo->numero_preventivo); ?></td>
                                <td class="text-end"><?php echo e(number_format($preventivo->total_pago, 3)); ?></td>
                                <td><?php echo e($preventivo->descripcion_gasto); ?></td>
                                <td><?php echo e($preventivo->empresa); ?></td>


                                
                                <td>
                                    <a href="<?php echo e(route('financieras.show', $item->id)); ?>"
                                        class="btn btn-sm btn-outline-primary">Ver</a>

                                    <a href="<?php echo e(route('smaf.financieras.edit', $item->id)); ?>"
                                        class="btn btn-sm btn-outline-success">Editar</a>
<?php if(!$item->enviado_a_despacho): ?>
    
    <form action="<?php echo e(route('smaf.financieras.enviar', $item->id)); ?>" method="POST" class="d-inline">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-sm btn-success"
            onclick="return confirm('¿Enviar esta financiera?')">
            Enviar
        </button>
    </form>

<?php elseif($item->updated_at > $item->fecha_envio): ?>
    
    <form action="<?php echo e(route('smaf.financieras.enviar', $item->id)); ?>" method="POST" class="d-inline">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-sm btn-warning"
            onclick="return confirm('Esta financiera fue modificada. ¿Reenviar a Despacho?')">
            Reenviar
        </button>
    </form>

<?php else: ?>
    
    <span class="badge bg-secondary">Enviado</span>
<?php endif; ?>



                                    <form action="<?php echo e(route('smaf.financieras.destroy', $item->id)); ?>" method="POST"
                                        class="d-inline" onsubmit="return confirm('¿Deshabilitar este registro?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-outline-danger">Deshabilitar</button>
                                    </form>
                                </td>


                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->entidad); ?></td>
                                <td><?php echo e($item->unidad->nombre_unidad ?? '-'); ?></td>
                                <td><?php echo e($item->area->nombre ?? '-'); ?></td>
                                <td><?php echo e(ucfirst($item->estado_documento)); ?></td>
                                <td><?php echo e(ucfirst($item->estado_administrativo)); ?></td>
                                <td><?php echo e($item->fecha_documento); ?></td>
                                <td colspan="5" class="text-center">Sin preventivos</td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="12" class="text-center">No hay información</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


    <script>
    $(function() {
        let fechaHoy = new Date().toLocaleDateString('es-BO', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        });
        let contadorActa = 0; // Comienza en 0

        function generarActaNumero() {
            contadorActa++;
            return contadorActa;
        }

        let table = $('#example1').DataTable({
            pageLength: 10,
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
            },
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'collection',
                    text: 'Reportes',
                    buttons: [{
                            extend: 'pdfHtml5',
                            text: 'Exportar a PDF',
                            orientation: 'portrait',
                            pageSize: 'LEGAL',
                            title: 'SECRETARÍA MUNICIPAL ADMINISTRATIVA FINANCIERA\nDIRECCIÓN FINANCIERA',
                            messageTop: function() {
                                return 'ACTA DE ENTREGA - RECEPCIÓN DE DOCUMENTO...\nFECHA: ' +
                                    fechaHoy + '     ACTA Nº ' + generarActaNumero();
                            },
                            messageBottom: '\n\n\n\nENTREGUÉ CONFORME ____________________________        RECIBÍ CONFORME ____________________________',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            },
                            customize: function(doc) {
                                doc.styles.title = {
                                    fontSize: 12,
                                    bold: true,
                                    alignment: 'center'
                                };
                                doc.styles.message = {
                                    fontSize: 10,
                                    alignment: 'center'
                                };
                                doc.styles.tableHeader = {
                                    alignment: 'center',
                                    bold: true
                                };
                                doc.defaultStyle.fontSize = 8;
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: 'Exportar a Excel',
                            title: 'SECRETARÍA MUNICIPAL ADMINISTRATIVA FINANCIERA - DIRECCIÓN FINANCIERA',
                            messageTop: function() {
                                return 'ACTA DE ENTREGA - RECEPCIÓN DE DOCUMENTO...\nFECHA: ' +
                                    fechaHoy + '     ACTA Nº ' + generarActaNumero();
                            },
                            messageBottom: '\n\n\n\nENTREGUÉ CONFORME ____________________________        RECIBÍ CONFORME ____________________________',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Imprimir',
                            title: 'SECRETARÍA MUNICIPAL ADMINISTRATIVA FINANCIERA\nDIRECCIÓN FINANCIERA',
                            messageTop: function() {
                                return 'ACTA DE ENTREGA - RECEPCIÓN DE DOCUMENTO...\nFECHA: ' +
                                    fechaHoy + '     ACTA Nº ' + generarActaNumero();
                            },
                            messageBottom: '\n\n\n\nENTREGUÉ CONFORME ____________________________        RECIBÍ CONFORME ____________________________',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        }
                    ]
                },
                'colvis'
            ]
        });

        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    </script>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/financiera/smaf/index.blade.php ENDPATH**/ ?>