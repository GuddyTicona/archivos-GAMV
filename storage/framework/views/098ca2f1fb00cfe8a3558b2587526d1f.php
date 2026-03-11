

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span id="card_title">Listado de Préstamos de Archivos</span>

                        <a href="<?php echo e(route('prestamo_central.create')); ?>" class="btn btn-primary btn-sm">
                            Registrar nuevo préstamo
                        </a>
                    </div>
                </div>

                
                <?php if($message = Session::get('mensaje')): ?>
                <script>
                Swal.fire({
                    title: "Éxito",
                    text: "<?php echo e($message); ?>",
                    icon: "success"
                });
                </script>
                <?php endif; ?>

                <div class="card-body bg-white">
                    <div class="table-responsive">

                        <table id="example1" class="table table-bordered table-striped align-middle">

                            <thead class="bg-white text-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Archivo</th>
                                    <th>Solicitante</th>
                                    <th>Cargo</th>
                                    <th>Motivo</th>
                                    <th>Observaciones</th>
                                    <th>Fecha Préstamo</th>
                                    <th>Fecha Devolución</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $__currentLoopData = $prestamos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prestamo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <td><?php echo e($loop->iteration); ?></td>

                                    <td>
                                        <?php echo e($prestamo->archivo->codigo_archivo ?? '-'); ?>

                                    </td>

                                    <td><?php echo e($prestamo->solicitante); ?></td>

                                    <td><?php echo e($prestamo->cargo_departamento ?? '-'); ?></td>

                                    <td><?php echo e($prestamo->motivo_prestamo ?? '-'); ?></td>

                                    <td><?php echo e($prestamo->observaciones ?? '-'); ?></td>

                                    <td><?php echo e($prestamo->fecha_prestamo); ?></td>

                                    <td><?php echo e($prestamo->fecha_devolucion ?? '-'); ?></td>

                                    <td>
                                        <?php if($prestamo->fecha_devolucion === null): ?>
                                        <span class="badge bg-danger">Prestado</span>
                                        <?php else: ?>
                                        <span class="badge bg-success">Recepcionado</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>

                                        <div class="d-flex gap-1">

                                            
                                            <?php if($prestamo->fecha_devolucion === null): ?>
                                            <form action="<?php echo e(route('prestamo_central.devolver',$prestamo->id)); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>

                                                <button class="btn btn-primary btn-sm" title="Marcar como devuelto">
                                                    Devolver
                                                </button>
                                            </form>
                                            <?php endif; ?>


                                            
                                            <form action="<?php echo e(route('prestamo_central.destroy',$prestamo->id)); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Seguro que deseas eliminar este préstamo?')">

                                                    Deshabilitar

                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>

            <?php echo $prestamos->withQueryString()->links(); ?>


        </div>
    </div>
</div>



<script>
$(function() {

    $("#example1").DataTable({

        "pageLength": 5,

        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ préstamos",
            "infoEmpty": "Mostrando 0 a 0 de 0 préstamos",
            "infoFiltered": "(Filtrado de _MAX_ préstamos totales)",
            "lengthMenu": "Mostrar _MENU_ préstamos",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",

            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }

        },

        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,

        buttons: [

            {
                extend: 'collection',
                text: 'Reportes',

                buttons: [

                    {
                        extend: 'copy',
                        text: 'Copiar'
                    },

                    {
                        extend: 'pdf',
                        text: 'PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                        exportOptions: {
                            columns: ':visible'
                        },

                        customize: function(doc) {

                            doc.styles.tableHeader.fontSize = 9
                            doc.defaultStyle.fontSize = 7
                            doc.pageMargins = [10, 10, 10, 10]

                            var objLayout = {}

                            objLayout['hLineWidth'] = function(i) {
                                return .5
                            }
                            objLayout['vLineWidth'] = function(i) {
                                return .5
                            }

                            objLayout['hLineColor'] = function(i) {
                                return '#aaa'
                            }
                            objLayout['vLineColor'] = function(i) {
                                return '#aaa'
                            }

                            objLayout['paddingLeft'] = function(i) {
                                return 2
                            }
                            objLayout['paddingRight'] = function(i) {
                                return 2
                            }

                            doc.content[1].layout = objLayout

                            var colCount = doc.content[1].table.body[0].length
                            doc.content[1].table.widths = Array(colCount).fill('*')

                        }
                    },

                    {
                        extend: 'csv',
                        text: 'CSV'
                    },
                    {
                        extend: 'excel',
                        text: 'Excel'
                    },
                    {
                        extend: 'print',
                        text: 'Imprimir'
                    }

                ]

            },

            {
                extend: 'colvis',
                text: 'Visor de columnas',
                collectionLayout: 'fixed three-column'
            }

        ]

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')

});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/prestamo_central/index.blade.php ENDPATH**/ ?>