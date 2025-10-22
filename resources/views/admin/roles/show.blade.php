@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary fw-bold">
        Permisos asignados al rol: <span class="text-dark">{{ strtoupper($role->name) }}</span>
    </h2>

    @if($role->permissions->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            No hay permisos asignados a este rol.
        </div>
    @else
        <div class="row g-3">
            @foreach($role->permissions as $permiso)
                <div class="col-md-4">
                    <div class="card shadow-sm border-primary h-100">
                        <div class="card-header bg-primary text-white fw-bold">
                            {{ ucwords(str_replace(['.', '_'], [' ', ' '], $permiso->name)) }}
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                {{ $permiso->description ?? 'Sin descripción disponible' }}
                            </p>
                        </div>
                        <div class="card-footer text-muted text-end">
                            <small>{{ strtoupper($permiso->module ?? 'SIN CATEGORÍA') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-4 text-center">
        <a href="{{ route('roles.index') }}" class="btn btn-outline-primary px-4">
            <i class="fas fa-arrow-left me-2"></i> Volver a lista de roles
        </a>
    </div>
</div>
@endsection
