@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Asignar permisos a rol: <strong>{{ $rol->name }}</strong></h2>
    <form action="{{ route('permissions.guardarModulo', $rol->id) }}" method="POST">
        @csrf

        @foreach($permisosAgrupados as $modulo => $acciones)
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>{{ strtoupper($modulo) }}</strong>
                    <button type="button" class="btn btn-sm btn-primary activar-todo" data-modulo="{{ $modulo }}">Activar todo</button>
                </div>
                <div class="card-body row">
                    @foreach($acciones as $accion => $permisoId)
                        <div class="col-md-4">
                            <label>
                                <input type="checkbox" name="permisos[]" class="permiso-check {{ $modulo }}" value="{{ $permisoId }}"
                                    {{ $rol->permissions->pluck('id')->contains($permisoId) ? 'checked' : '' }}>
                                {{ ucfirst($accion) }} {{ ucfirst($modulo) }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">Guardar Permisos</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.activar-todo').forEach(button => {
        button.addEventListener('click', () => {
            const modulo = button.dataset.modulo;
            const checkboxes = document.querySelectorAll(`.permiso-check.${modulo}`);
            checkboxes.forEach(cb => cb.checked = true);
        });
    });
</script>
@endpush
