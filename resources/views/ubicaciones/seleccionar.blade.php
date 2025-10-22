@extends('layouts.admin')

@section('content')
<div class="container py-5">

    {{-- Card principal --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="max-width: 1000px; margin: 0 auto;">
        <div class="card-body p-5">

            {{-- Título --}}
            <h4 class="fw-bold mb-4 text-black text-center">
                Asignar Ubicación al Archivo Financiera
            </h4>

            {{-- Información del archivo --}}
            <div class="alert alert-light border-0 rounded-3 shadow-sm d-flex align-items-center mb-4">
          
                <div>
                    <strong>{{ $archivo->codigo }}</strong> — {{ $archivo->entidad }}
                </div>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('ubicaciones.asignarUbicacion', $archivo->id) }}" method="POST" class="w-100">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold">Seleccionar Estante</label>
                    <select name="estante" class="form-select form-select-lg border-0 rounded-3 shadow-sm w-100" required>
                        <option value="">-- Seleccionar estante --</option>
                        @foreach($estantes as $estante)
                            <option value="{{ $estante->estante }}">Estante {{ $estante->estante }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100 fw-semibold py-2 shadow-sm">
                    <i class="bi bi-pin-map-fill me-2"></i> Asignar Ubicación 
                </button>
            </form>
        </div>
    </div>
</div>

{{-- SweetAlert --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#198754',
            timer: 2000,
            timerProgressBar: true
        });
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Sin espacio',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#dc3545'
        });
    });
</script>
@endif

<style>
/* Select con sombra y foco moderno */
.form-select:focus {
    box-shadow: 0 0 0 0.3rem rgba(25, 135, 84, 0.25);
}

.form-select option {
    color: #000;
}

/* Botón con hover sutil */
.btn-success:hover {
    transform: translateY(-2px);
    transition: all 0.2s ease-in-out;
}

/* Alert archivo más moderno */
.alert {
    background-color: #f8f9fa !important;
}

/* Card centrado y responsive */
.card {
    width: 100%;
}
</style>
@endsection
