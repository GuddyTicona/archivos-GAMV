@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4>Editar Permisos para el rol: <strong>{{ $role->name }}</strong></h4>

    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        @foreach($permissions->groupBy('module') as $module => $perms)
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <strong>{{ strtoupper($module ?? 'SIN MÓDULO') }}</strong>
                </div>
                <div class="card-body">
                    @foreach($perms as $perm)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                                   class="form-check-input" id="perm_{{ $perm->id }}"
                                   {{ $role->permissions->contains('name', $perm->name) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm_{{ $perm->id }}">
                                {{ $perm->description ?? $perm->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">Guardar cambios</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
