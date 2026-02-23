@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow border-0">

        {{-- HEADER --}}
        <div class="card-header bg-dark text-white py-3">
            <h5 class="mb-0 fw-semibold">
                Seguridad de la Cuenta
            </h5>
        </div>

        <div class="card-body p-4">

            {{-- MENSAJES --}}
            @if(session('status'))
            <div class="alert alert-secondary border-0 shadow-sm">
                {{ session('status') }}
            </div>
            @endif

            @if(session('warning'))
            <div class="alert alert-light border-start border-4 border-warning shadow-sm">
                <strong>Requisito de Seguridad</strong>
                <div class="text-muted small">
                    {{ session('warning') }}
                </div>
            </div>
            @endif

            <h5 class="mb-4 fw-semibold">Autenticación de Dos Factores</h5>

            @if(auth()->user()->two_factor_secret && auth()->user()->two_factor_confirmed_at)

            {{-- 2FA ACTIVADO Y CONFIRMADO --}}
            <div class="alert alert-light border-start border-4 border-primary shadow-sm">
                <strong>Estado:</strong> La autenticación de dos factores está activa y confirmada.
            </div>

            <div class="row g-4 mt-2">

                {{-- QR --}}
                <div class="col-lg-6">
                    <div class="card border shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Código QR</h6>
                            <p class="text-muted small">
                                Escanea este código con tu aplicación de autenticación.
                            </p>
                            <div class="text-center p-3 bg-white border rounded">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RECOVERY CODES --}}
                <div class="col-lg-6">
                    <div class="card border shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Códigos de recuperación</h6>

                            <div class="alert alert-light border-start border-4 border-warning small shadow-sm">
                                Guarda estos códigos en un lugar seguro.
                            </div>

                            <div class="bg-white border rounded p-3" style="font-family: monospace; font-size: 0.9rem;">
                                @foreach (auth()->user()->recoveryCodes() as $code)
                                <div>{{ $code }}</div>
                                @endforeach
                            </div>

                            <form method="POST" action="{{ url('/user/two-factor-recovery-codes') }}" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                    Regenerar códigos
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            {{-- DESACTIVAR --}}
            <div class="mt-5 p-4 border rounded bg-white shadow-sm">
                <h6 class="text-danger fw-semibold">
                    Desactivar autenticación de dos factores
                </h6>
                <p class="text-muted small">
                    Tu cuenta tendrá menor nivel de seguridad si desactivas esta opción.
                </p>

                <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('¿Desea desactivar la autenticación de dos factores?')">
                        Desactivar
                    </button>
                </form>
            </div>

            @elseif(auth()->user()->two_factor_secret && !auth()->user()->two_factor_confirmed_at)

            {{-- 2FA ACTIVADO PERO NO CONFIRMADO --}}
            <div class="alert alert-light border-start border-4 border-primary shadow-sm">
                <strong>Paso final:</strong> Confirma el código para activar completamente el 2FA.
            </div>

            <div class="row g-4 mt-2">

                {{-- QR --}}
                <div class="col-lg-6">
                    <div class="card border shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Paso 1: Escanea el código QR</h6>
                            <p class="text-muted small">
                                Abre tu aplicación de autenticación y escanea este código.
                            </p>
                            <div class="text-center p-3 bg-white border rounded">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CONFIRMAR CÓDIGO --}}
                <div class="col-lg-6">
                    <div class="card border shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Paso 2: Confirma el código</h6>
                            <p class="text-muted small">
                                Ingresa el código de 6 dígitos que aparece en tu aplicación.
                            </p>

                            <form method="POST" action="{{ url('/user/confirmed-two-factor-authentication') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="code" class="form-label">Código de verificación</label>
                                    <input type="text" name="code" id="code"
                                        class="form-control form-control-lg text-center @error('code') is-invalid @enderror"
                                        placeholder="123456" maxlength="6" inputmode="numeric"
                                        style="letter-spacing: 0.5rem; font-size: 1.5rem;" autofocus required>
                                    @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    Confirmar y activar
                                </button>
                            </form>

                            <div class="alert alert-light border-start border-4 border-info mt-3 small shadow-sm">
                                <strong>Nota:</strong> Si el código no funciona, verifica que la hora de tu dispositivo
                                esté sincronizada.
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @else

            {{-- 2FA NO ACTIVADO --}}
            <div class="alert alert-light border-start border-4 border-secondary shadow-sm">
                <strong>Estado:</strong> La autenticación de dos factores no está activada.
            </div>

            <p class="mb-4 text-muted">
                Agrega una capa adicional de seguridad.
                Se solicitará un código adicional al iniciar sesión.
            </p>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Requisitos</h6>
                            <ul class="mb-0">
                                <li>Dispositivo Android o iOS</li>
                                <li>Aplicación de autenticación
                                    <ul class="mt-2">
                                        <li>Google Authenticator</li>
                                        <li>Microsoft Authenticator</li>
                                        <li>Authy</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <form method="POST" action="{{ url('/user/two-factor-authentication') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Habilitar autenticación de dos factores
                        </button>
                    </form>
                </div>
            </div>

            @endif

            <hr class="my-5">

            {{-- BOTONES FINALES --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    Volver al inicio
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">
                        Cerrar sesión
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection