
<?php $__env->startSection('content'); ?>
<div class="content" style="margin-left: 10px">

    <?php if($message = Session::get('mensaje')): ?>
    <script>
    Swal.fire({
        title: "Felicidades",
        text: "<?php echo e($message); ?>",
        icon: "success"
    });
    </script>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Unidades Registrados</b></h3>
                    <div class="card-tools">
                        <a href="<?php echo e(url('/unidades/create')); ?>" class="btn btn-primary">
                            <i class="bi bi-file-earmark-plus"></i> Agregar nueva unidad
                        </a>

                    </div>
                </div>

                <div class="card-body" style="display: block;">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nombre Unidad</th>
                                <th>Descripcion</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador=0;?>
                            <?php $__currentLoopData = $unidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $contador= $contador+1?></td>
                                <td><?php echo e($unidad -> nombre_unidad); ?></td>
                                <td><?php echo e($unidad -> descripcion); ?></td>
                                <td><?php echo e($unidad -> fecha_creacion); ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a href="<?php echo e(url('unidades', $unidad->id)); ?>" class="btn btn-sm btn-outline-info"
                                            title="Ver detalles">
                                            ver detalles
                                        </a>
                                        <a href="<?php echo e(route('unidades.edit', $unidad->id)); ?>"
                                            class="btn btn-sm btn-outline-success" title="Editar">
                                            Editar
                                        </a>
                                        <form action="<?php echo e(url('unidades', $unidad->id)); ?>" method="POST"
                                            onsubmit="return confirm('¿Deseas deshabilitar esta unidad?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                title="Deshabilitar">
                                                Deshabilitar
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>

                    </table>


                    <script>
                    $(function() {
                        $("#example1").DataTable({
                            "pageLength": 5,
                            "language": {
                                "emptyTable": "No hay informacion",
                                "info": "Mostrando _START_ a _END_ de _TOTAL unidades",
                                "infoEmpty": "Mostrando 0 a 0 de 0 unidades",
                                "infoFiltered": "(Filtrado de _MAX_ total unidades)",
                                "infoPostFix": "",
                                "thousands": ",",
                                "lengthMenu": "Mostrar _MENU_ _unidades",
                                "loadingRecords": "Cargando...",
                                "processing": "Procesando...",
                                "search": "Buscador:",
                                "zeroRecords": "Sin resultados encontrados",
                                "paginate": {
                                    "first": "Primero",
                                    "last": "Ultimo",
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                }
                            },
                            "responsive": true,
                            "lengthChange": true,
                            "autoWidth": false,
                            buttons: [{
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [{
                                        text: 'Copiar',
                                        extend: 'copy',
                                    }, {
                                        extend: 'pdf'
                                    }, {
                                        extend: 'csv'
                                    }, {
                                        extend: 'excel'
                                    }, {
                                        text: 'Imprimir',
                                        extend: 'print'
                                    }]
                                },
                                {
                                    extend: 'colvis',
                                    text: 'Visor de columnas',
                                    collectionLayout: 'fixed three-column'
                                }
                            ],

                        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                    });
                    </script>
                </div>

            </div>


        </div>

    </div>


</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/unidades/index.blade.php ENDPATH**/ ?>