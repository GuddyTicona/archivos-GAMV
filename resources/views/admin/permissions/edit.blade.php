@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Editar Permiso</h3>

    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre del permiso</label>
            <input type="text" name="name" value="{{ $permission->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <input type="text" name="description" value="{{ $permission->description }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="module">Módulo</label>
            <input type="text" name="module" value="{{ $permission->module }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
