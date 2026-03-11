<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            <?php echo e(__('Categorias')); ?>

                        </span>

                        <div class="float-right">
                            <a href="<?php echo e(route('categorias.create')); ?>" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                Crear Nuevo
                            </a>
                        </div>
                    </div>
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

                                    <th>Nombre Categoria</th>
                                    <th>Descripcion</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$i); ?></td>

                                    <td><?php echo e($categoria->nombre_categoria); ?></td>
                                    <td><?php echo e($categoria->descripcion); ?></td>

                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Acciones">
                                            <a href="<?php echo e(route('categorias.show', $categoria->id)); ?>"
                                                class="btn btn-sm btn-outline-primary">
                                                Ver detalles
                                            </a>
                                            <a href="<?php echo e(route('categorias.edit', $categoria->id)); ?>"
                                                class="btn btn-sm btn-outline-success">
                                                Editar
                                            </a>
                                            <form action="<?php echo e(route('categorias.destroy', $categoria->id)); ?>"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('¿Seguro que deseas deshabilitar esta categoría?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL categorias",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 categorias",
                                    "infoFiltered": "(Filtrado de _MAX_ total categorias)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ _categorias",
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
            <?php echo $categorias->withQueryString()->links(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/categoria/index.blade.php ENDPATH**/ ?>