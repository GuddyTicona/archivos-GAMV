@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Gestión de Roles</h4>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Crear Nuevo Rol</a>

    <div class="card shadow rounded">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nombre del Rol</th>
                        <th style="width: 30%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            <!-- Botón: Editar Permisos -->
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning me-1">
                                Asignar/Editar Permisos
                            </a>

                            <!-- Botón: Ver Permisos (modal) -->
                            <a href="{{ route('roles.show', $role) }}" class="btn btn-sm btn-info me-2">
                                <i class="fas fa-eye"></i> Ver Permisos
                            </a>

                            <!-- Modal Ver Permisos -->
                            <div class="modal fade" id="verPermisosModal{{ $role->id }}" tabindex="-1"
                                aria-labelledby="verPermisosLabel{{ $role->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="verPermisosLabel{{ $role->id }}">
                                                Permisos del Rol: {{ $role->name }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            @forelse($role->permissions as $permiso)
                                            <span
                                                class="badge bg-success mb-1">{{ $permiso->description ?? $permiso->name }}</span>
                                            @empty
                                            <p class="text-muted">Este rol no tiene permisos asignados.</p>
                                            @endforelse
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Formulario: Eliminar Rol -->
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('¿Deseas eliminar este rol?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">No hay roles registrados aún.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection