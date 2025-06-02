<!doctype html>
<html lang="es">

<head>
    <title>Registro - Sistema de Archivos</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('build/assets/estilo.css') }}">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <!-- Formulario de registro -->
                        <div class="col-md-6 p-4">
                            <div class="text-center mb-4">
                                <img src="{{ asset('build/assets/logo1.png') }}" class="img-fluid logo-img" alt="logo">
                                <h2 class="mt-3">Crear Cuenta</h2>
                            </div>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre completo</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required>
                                    @error('password')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password-confirm" class="form-label">Confirmar contraseña</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary">Registrarse</button>
                                </div>

                                <div class="text-center">
                                    <small>¿Ya tienes una cuenta?</small>
                                    <a href="{{ route('login') }}" class="btn btn-link p-0 ms-1">Iniciar sesión</a>
                                </div>
                            </form>
                        </div>

                        <!-- Lado derecho con mensaje -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
