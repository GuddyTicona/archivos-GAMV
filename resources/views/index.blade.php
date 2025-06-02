@extends('layouts.admin')

@include('components.chat') 
@section('content')

<div class="content" style="margin: 15px">
    <h1 class="mb-4 text-center text-gradient fw-bold" style="font-size: 1.8rem;">Bienvenido al Panel Principal</h1>

    <div class="row g-3">
        <!-- UNIDADES -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-white shadow-sm border-0"
                style="background: linear-gradient(135deg, rgb(8, 27, 48), rgb(24, 101, 122)); border-radius: 15px; min-height: 180px;">
                <div class="card-body d-flex flex-column justify-content-between p-3">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title fs-5 mb-0">Unidades</h5>
                            <i class="bi bi-diagram-3-fill display-6 icon-anim"></i>
                        </div>
                        <h2 class="fw-bold mb-1">{{ count($unidades) }}</h2>
                        <p class="small">Unidades en el sistema</p>
                    </div>
                    <a href="{{ url('unidades') }}" class="btn btn-sm btn-light text-primary fw-bold mt-2 shadow-sm">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- ARCHIVOS -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-white shadow-sm border-0"
                style="background: linear-gradient(135deg, rgb(199, 88, 15), rgb(201, 105, 15)); border-radius: 15px; min-height: 180px;">
                <div class="card-body d-flex flex-column justify-content-between p-3">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title fs-5 mb-0">Archivos</h5>
                            <i class="bi bi-folder-fill display-6 icon-anim"></i>
                        </div>
                        <h2 class="fw-bold mb-1">{{ count($archivos) }}</h2>
                        <p class="small">Archivos disponibles</p>
                    </div>
                    <a href="{{ url('archivos') }}" class="btn btn-sm btn-light text-warning fw-bold mt-2 shadow-sm">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- CATEGORIAS -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-white shadow-sm border-0"
                style="background: linear-gradient(135deg, rgb(16, 8, 54), rgb(30, 31, 100)); border-radius: 15px; min-height: 180px;">
                <div class="card-body d-flex flex-column justify-content-between p-3">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title fs-5 mb-0">Categorías</h5>
                            <i class="bi bi-tags-fill display-6 icon-anim"></i>
                        </div>
                        <h2 class="fw-bold mb-1">{{ count($categorias) }}</h2>
                        <p class="small">Documentos organizados</p>
                    </div>
                    <a href="{{ url('categorias') }}" class="btn btn-sm btn-light text-success fw-bold mt-2 shadow-sm">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- FINANCIERA -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-white shadow-sm border-0"
                style="background: linear-gradient(135deg, rgb(6, 61, 36), rgb(2, 27, 1)); border-radius: 15px; min-height: 180px;">
                <div class="card-body d-flex flex-column justify-content-between p-3">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title fs-5 mb-0">Financiera</h5>
                            <i class="bi bi-currency-dollar display-6 icon-anim"></i>
                        </div>
                        <h2 class="fw-bold mb-1">{{ count($financieras) }}</h2>
                        <p class="small">Ejecución de gastos</p>
                    </div>
                    <a href="{{ url('financieras') }}" class="btn btn-sm btn-light text-primary fw-bold mt-2 shadow-sm">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- HISTORIAL -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-white shadow-sm border-0"
                style="background: linear-gradient(135deg, rgb(14, 109, 101), rgb(75, 21, 80)); border-radius: 15px; min-height: 180px;">
                <div class="card-body d-flex flex-column justify-content-between p-3">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title fs-5 mb-0">Historial</h5>
                            <i class="bi bi-clock-history display-6 icon-anim"></i>
                        </div>
                        <h2 class="fw-bold mb-1">{{ count($historialArchivos) }}</h2>
                        <p class="small">Historial de archivos</p>
                    </div>
                    <a href="{{ url('historial-archivo') }}" class="btn btn-sm btn-light text-primary fw-bold mt-2 shadow-sm">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- USUARIOS -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-white shadow-sm border-0"
                style="background: linear-gradient(135deg, rgb(19, 5, 97), rgb(37, 43, 4)); border-radius: 15px; min-height: 180px;">
                <div class="card-body d-flex flex-column justify-content-between p-3">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title fs-5 mb-0">Usuarios</h5>
                            <i class="bi bi-people-fill display-6 icon-anim"></i>
                        </div>
                        <h2 class="fw-bold mb-1">{{ count($usuarios) }}</h2>
                        <p class="small">Usuarios registrados</p>
                    </div>
                    <a href="{{ url('usuarios') }}" class="btn btn-sm btn-light text-success fw-bold mt-2 shadow-sm">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilo para iconos dinámicos -->


@endsection
