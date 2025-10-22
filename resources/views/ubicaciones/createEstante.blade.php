@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Crear Estante</h4>

    <form action="{{ route('ubicaciones.storeEstante') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre del Estante</label>
            <input type="text" name="estante" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Número de Filas</label>
            <input type="number" name="filas" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Número de Columnas</label>
            <input type="number" name="columnas" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Estante</button>
    </form>
</div>
@endsection
