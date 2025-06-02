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
    <link rel="stylesheet" href="{{ asset('build/assets/estilo.css') }}">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <!-- Formulario -->
                        <div class="col-md-6 p-4">
                            <div class="text-center mb-4">
                                <img src="{{ asset('build/assets/logo1.png') }}" class="img-fluid logo-img" alt="logo">
                                <h2 class="mt-3">Iniciar Sesión</h2>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="formEmail" class="form-label">Correo electrónico</label>
                                    <input type="email" id="formEmail" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Ingrese su correo electrónico" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="formPassword" class="form-label">Contraseña</label>
                                    <input type="password" id="formPassword" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Ingrese su contraseña">
                                    @error('password')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>

                                <!-- reCAPTCHA -->
                                <div class="form-group mt-3">
                                    {!! NoCaptcha::renderJs('es', false, 'onloadCallback') !!}
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="d-grid mb-3 mt-4">
                                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                                </div>

                                @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a href="{{ route('password.request') }}" class="small">¿Olvidaste tu contraseña?</a>
                                    </div>
                                @endif

                                <div class="text-center mt-2">
                                    <small>¿No tienes cuenta?</small>
                                    <a href="{{ route('register') }}" class="btn btn-link p-0 ms-1">Crear nuevo</a>
                                </div>
                            </form>
                        </div>

                        <!-- Lado derecho -->
                        <div class="col-md-6 d-flex align-items-center justify-content-center bg-gradient-custom text-white p-4">
                            <div class="text-center">
                                <h5>Bienvenido al sistema de archivos</h5>
                                <p class="mt-2 small">Gobierno Autónomo Municipal de Viacha</p>
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

    <!-- reCAPTCHA callback opcional -->
    <script>
        var onloadCallback = function () {
            console.log("reCAPTCHA cargado");
        };
    </script>
</body>

</html>
