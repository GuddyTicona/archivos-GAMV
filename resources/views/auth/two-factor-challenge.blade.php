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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/two-factor-challenge') }}">
                @csrf

                <div class="mb-3">
                    <label for="code" class="form-label">Código de autenticación</label>
                    <input type="text" 
                           name="code" 
                           id="code"
                           class="form-control @error('code') is-invalid @enderror" 
                           placeholder="123456"
                           maxlength="6"
                           inputmode="numeric"
                           autofocus 
                           autocomplete="one-time-code">
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

            <form id="recovery-form" method="POST" action="{{ url('/two-factor-challenge') }}" style="display: none;">
                @csrf

                <div class="mb-3">
                    <label for="recovery_code" class="form-label">Código de recuperación</label>
                    <input type="text" 
                           name="recovery_code" 
                           id="recovery_code"
                           class="form-control @error('recovery_code') is-invalid @enderror" 
                           autocomplete="one-time-code">
                    @error('recovery_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
