<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación en Multifactor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow" style="width: 400px;">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Verificación Two Factor </h5>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(url('/two-factor-challenge')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="code" class="form-label">Código de autenticación</label>
                    <input type="text" 
                           name="code" 
                           id="code"
                           class="form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           placeholder="123456"
                           maxlength="6"
                           inputmode="numeric"
                           autofocus 
                           autocomplete="one-time-code">
                    <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Ingresa el código de 6 dígitos de tu aplicación</small>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Verificar
                </button>

                <hr>

                <p class="text-center mb-2">
                    <small class="text-muted">¿No tienes acceso a tu dispositivo?</small>
                </p>
                <button type="button" class="btn btn-link btn-sm w-100" 
                        onclick="document.getElementById('recovery-form').style.display='block'; this.parentElement.parentElement.style.display='none';">
                    Usar código de recuperación
                </button>
            </form>

            <form id="recovery-form" method="POST" action="<?php echo e(url('/two-factor-challenge')); ?>" style="display: none;">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="recovery_code" class="form-label">Código de recuperación</label>
                    <input type="text" 
                           name="recovery_code" 
                           id="recovery_code"
                           class="form-control <?php $__errorArgs = ['recovery_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           autocomplete="one-time-code">
                    <?php $__errorArgs = ['recovery_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Ingresa uno de los códigos de recuperación</small>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Verificar código de recuperación
                </button>

                <button type="button" class="btn btn-link btn-sm w-100" 
                        onclick="document.getElementById('recovery-form').style.display='none'; document.querySelector('form:first-of-type').parentElement.style.display='block';">
                    Volver a código normal
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/auth/two-factor-challenge.blade.php ENDPATH**/ ?>