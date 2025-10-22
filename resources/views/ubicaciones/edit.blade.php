@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card p-3 shadow-sm">
        <h4 class="mb-3">Editar Ubicación</h4>

     <form action="{{ route('ubicaciones.update', $ubicacion->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="estante" class="form-label">Estante</label>
                <input type="text" name="estante" id="estante" class="form-control" 
                       value="{{ old('estante', $ubicacion->estante) }}" required>
            </div>

            <div class="mb-3">
                <label for="fila" class="form-label">Fila</label>
                <input type="text" name="fila" id="fila" class="form-control" 
                       value="{{ old('fila', $ubicacion->fila) }}" required>
            </div>

            <div class="mb-3">
                <label for="columna" class="form-label">Columna</label>
                <input type="text" name="columna" id="columna" class="form-control" 
                       value="{{ old('columna', $ubicacion->columna) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('ubicaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
