@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="mb-3">Asignar Ubicación a: {{ $financiera->codigo }} - {{ $financiera->entidad }}</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('ubicaciones.actualizar', $financiera->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ubicacion_id" class="form-label">Seleccione Ubicación</label>
            <select name="ubicacion_id" id="ubicacion_id" class="form-select">
                <option value="">-- Seleccione --</option>
                @foreach($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}"
                        {{ $financiera->ubicacion_id == $ubicacion->id ? 'selected' : '' }}>
                        Estante {{ $ubicacion->estante }},
                        Fila {{ $ubicacion->fila }},
                        Columna {{ $ubicacion->columna }}
                    </option>
                @endforeach
            </select>
            @error('ubicacion_id')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar Ubicación</button>
        <a href="{{ route('financieras.show', $financiera->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
