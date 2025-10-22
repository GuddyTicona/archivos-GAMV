@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <div class="card border-0 shadow-lg rounded-4 bg-white">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h4 class="fw-bold text-black mb-0">
                    Gestión de Archivos Financieros
                </h4>
               
            </div>

           @if(session('success'))
  
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Felicidades',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#198754', // verde institucional
                background: '#f8fafc', // fondo claro
                color: '#212529', // texto oscuro
                timer: 2500,
                timerProgressBar: true
            });
        });
    </script>
@endif


            <div class="bg-light p-3 rounded-3 mb-4">
                <h6 class="fw-bold text-secondary mb-2">
                     creacion de carpetas
                </h6>
                <form action="{{ route('ubicaciones.generar') }}" method="POST" class="row g-3 align-items-center">
                    @csrf
                    <div class="col-md-5">
                        <input type="text" name="estante" class="form-control text-uppercase" placeholder="" required>

                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-warning w-100">
                              <i class="bi bi-grid-3x3-gap"></i> Generar carpetas
                        </button>
                    </div>
                </form>
            </div>

            @php
                $grupos = $ubicaciones->groupBy('estante');
            @endphp

            @if ($grupos->isEmpty())
                <div class="text-center text-muted py-5">
                    <i class="bi bi-inbox fs-1"></i>
                    <p class="mt-3 mb-0">No hay estantes registrados aún.</p>
                    <p>Utiliza el formulario anterior para crear el primero.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($grupos as $estante => $lista)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card border-0 shadow-sm h-100 estante-card rounded-4 bg-gradient">
                                <div class="card-body text-center text-white">
                                  

                                    <h5 class="fw-bold text-white mb-1">Estante {{ $estante }}</h5>

                                    <p class="small mb-1 opacity-75">
                                        <i class="bi bi-layers"></i> {{ $lista->count() }} ubicaciones
                                    </p>
                                    <p class="small opacity-75">
                                        <i class="bi bi-folder2-open"></i>
                                        {{ $lista->sum(fn($u) => $u->financieras->count()) }} archivos
                                    </p>

                                    <div class="d-grid gap-2 mt-3">
                                        <a href="{{ route('ubicaciones.ver_estante', $estante) }}" 
                                           class="btn btn-light btn-sm fw-semibold">
                                            <i class="bi bi-eye"></i> Ver detalles
                                        </a>
                                        <form action="{{ route('ubicaciones.eliminar_estante', $estante) }}" method="POST"
                                              onsubmit="return confirm('⚠️ ¿Seguro que deseas eliminar todas las ubicaciones del estante {{ $estante }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <br>
                                            <button class="btn btn-outline-light btn-sm">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Fondo de cada card de estante */
.estante-card {
    background: linear-gradient(135deg, #680b12ff, #8b0f0fff);
    transition: all 0.3s ease;
}
.estante-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
}

/* Icono decorativo */
.icon-circle {
    width: 70px;
    height: 70px;
    background-color: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.8rem;
}

/* Botones dentro de cards */
.estante-card .btn {
    border-radius: 25px;
}
</style>
@endsection
