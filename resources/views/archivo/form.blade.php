@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-lg rounded-4 mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Registro de Archivo</h4>
        </div>

        <div class="card-body">
            <div class="row g-3">

                {{-- ==================== COLUMNA IZQUIERDA ==================== --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="codigo_archivo">Código Archivo</label>
                        <input type="text" class="form-control @error('codigo_archivo') is-invalid @enderror"
                            name="codigo_archivo" id="codigo_archivo"
                            value="{{ old('codigo_archivo', $archivo?->codigo_archivo) }}"
                            placeholder="Código archivo">
                        {!! $errors->first('codigo_archivo','<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="mb-3">
                        <label for="descripcion_documento">Descripción Documento</label>
                        <input type="text" class="form-control @error('descripcion_documento') is-invalid @enderror"
                            name="descripcion_documento" id="descripcion_documento"
                            value="{{ old('descripcion_documento', $archivo?->descripcion_documento) }}"
                            placeholder="Descripción del documento...">
                        {!! $errors->first('descripcion_documento','<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="mb-3">
                        <label for="tomo">Tomo</label>
                        <input type="text" class="form-control @error('tomo') is-invalid @enderror"
                            name="tomo" id="tomo" value="{{ old('tomo', $archivo?->tomo) }}"
                            placeholder="Número de tomo">
                        {!! $errors->first('tomo','<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="mb-3">
                        <label for="numero_foja">Número Foja</label>
                        <input type="text" class="form-control @error('numero_foja') is-invalid @enderror"
                            name="numero_foja" id="numero_foja" value="{{ old('numero_foja', $archivo?->numero_foja) }}"
                            placeholder="Número de foja">
                        {!! $errors->first('numero_foja','<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="mb-3">
                        <label for="gestion">Gestión</label>
                        <input type="text" class="form-control @error('gestion') is-invalid @enderror"
                            name="gestion" id="gestion" value="{{ old('gestion', $archivo?->gestion) }}"
                            placeholder="Gestión">
                        {!! $errors->first('gestion','<div class="invalid-feedback">:message</div>') !!}
                    </div>

                </div>

                {{-- ==================== COLUMNA DERECHA ==================== --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="unidad_instalacion">Unidad Instalación</label>
                        <input type="text" class="form-control @error('unidad_instalacion') is-invalid @enderror"
                            name="unidad_instalacion" id="unidad_instalacion"
                            value="{{ old('unidad_instalacion', $archivo?->unidad_instalacion) }}"
                            placeholder="Empastado, folder amarillo">
                        {!! $errors->first('unidad_instalacion','<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="mb-3">
                        <label for="observaciones">Observaciones</label>
                        <input type="text" class="form-control @error('observaciones') is-invalid @enderror"
                            name="observaciones" id="observaciones"
                            value="{{ old('observaciones', $archivo?->observaciones) }}"
                            placeholder="Observaciones">
                        {!! $errors->first('observaciones','<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="mb-3">
                        <label for="fecha_registro">Fecha Registro</label>
                        <input type="date" class="form-control @error('fecha_registro') is-invalid @enderror"
                            name="fecha_registro" id="fecha_registro"
                            value="{{ old('fecha_registro', $archivo?->fecha_registro) }}">
                        {!! $errors->first('fecha_registro','<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- Grupo de SELECTs en grid 2/2/1 --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="unidad_id">Unidad</label>
                            <select name="unidad_id" id="unidad_id"
                                class="form-control @error('unidad_id') is-invalid @enderror">
                                <option value="">-- Selecciona una unidad --</option>
                                @foreach($unidades as $id => $nombre)
                                <option value="{{ $id }}" {{ old('unidad_id', $archivo?->unidad_id)==$id?'selected':'' }}>
                                    {{ $nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado"
                                class="form-control @error('estado') is-invalid @enderror">
                                <option value="">-- Selecciona estado --</option>
                                <option {{ old('estado', $archivo?->estado) == 'Activo' ? 'selected':'' }}>Activo</option>
                                <option {{ old('estado', $archivo?->estado) == 'Inactivo' ? 'selected':'' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="categoria_id">Categoría</label>
                            <select name="categoria_id" id="categoria_id"
                                class="form-control @error('categoria_id') is-invalid @enderror">
                                <option value="">-- Selecciona una categoría --</option>
                                @foreach($categorias as $id => $nombre)
                                <option value="{{ $id }}" {{ old('categoria_id',$archivo?->categoria_id)==$id?'selected':'' }}>
                                    {{ $nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            {{-- DOCUMENTO --}}
            <div class="mb-3 mt-3 col-md-4">
                <label for="documento_adjunto" class="form-label">Documento Adjunto</label>
                <input type="file" name="documento_adjunto" id="documento_adjunto"
                    class="form-control @error('documento_adjunto') is-invalid @enderror"
                    accept=".pdf,.doc,.docx,.xls,.xlsx">
                {!! $errors->first('documento_adjunto','<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- BOTONES --}}
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">Registrar Archivo</button>
                <a href="{{ route('archivos.index') }}" class="btn btn-secondary">Volver</a>
            </div>

        </div>
    </div>
</div>
@endsection
