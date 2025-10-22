@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Crear Permiso</h3>

    <form method="POST" action="{{ route('permissions.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nombre del permiso</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <input type="text" name="description" class="form-control">
        </div>

        <div class="form-group">
            <label for="module">Módulo</label>
            <input type="text" name="module" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
