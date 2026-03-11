<!doctype html>
<html lang="es">

<head>
    <title>Login - Sistema de Archivos</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="<?php echo e(asset('build/assets/estilo.css')); ?>">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow rounded-4 overflow-hidden custom-height-card">
                    <div class="row g-0">
                        <!-- Formulario -->
                        <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                            <div class="text-center mb-4">
                                <img src="<?php echo e(asset('build/assets/logo1.png')); ?>" class="img-fluid logo-img" alt="logo">
                                <h2 class="mt-3">Iniciar Sesión</h2>
                            </div>

                            <form method="POST" action="<?php echo e(route('login')); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="formEmail" class="form-label">Correo electrónico</label>
                                    <input type="email" id="formEmail" name="email"
                                        class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Ingrese su correo electrónico" value="<?php echo e(old('email')); ?>">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger small"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="formPassword" class="form-label">Contraseña</label>
                                    <input type="password" id="formPassword" name="password"
                                        class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Ingrese su contraseña">
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger small"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
<!--
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>

                                <!-- reCAPTCHA -->
                                <div class="form-group mt-3">
                                    <?php echo NoCaptcha::renderJs('es', false, 'onloadCallback'); ?>

                                    <?php echo NoCaptcha::display(); ?>

                                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="d-grid mb-3 mt-4">
                                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                                </div>

                                <?php if(Route::has('password.request')): ?>
                                    <div class="text-center">
                                        <a href="<?php echo e(route('password.request')); ?>" class="small">¿Olvidaste tu contraseña?</a>
                                    </div>
                                <?php endif; ?>

                                <div class="text-center mt-2">
                                    <small>¿No tienes cuenta?</small>
                                    <a href="<?php echo e(route('register')); ?>" class="btn btn-link p-0 ms-1">Crear nuevo</a>
                                </div>
                            </form>
                        </div>

                        <!-- Lado derecho -->
                        <div class="col-md-6 d-flex align-items-center justify-content-center bg-gradient-custom text-white p-4">
                            <div class="text-center">
                                <h2>Bienvenido al Sistema de Archivos Financieros</h2>
                                <p class="mt-2 small">Gobierno Autónomo Municipal de Viacha</p>
                              <img src="<?php echo e(asset('dist/img/viacha.png')); ?>" class="img-fluid img-bienvenida mt-3 rounded-circle" alt="Bienvenida">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script>
        var onloadCallback = function () {
            console.log("reCAPTCHA cargado");
        };
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/auth/login.blade.php ENDPATH**/ ?>