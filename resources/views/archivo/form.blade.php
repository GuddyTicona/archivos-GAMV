<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="codigo_archivo" class="form-label">{{ __('Codigo Archivo') }}</label>
            <input type="text" name="codigo_archivo" class="form-control @error('codigo_archivo') is-invalid @enderror"
                value="{{ old('codigo_archivo', $archivo?->codigo_archivo) }}" id="codigo_archivo"
                placeholder="Codigo Archivo">
            {!! $errors->first('codigo_archivo', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion_documento" class="form-label">{{ __('Descripcion Documento') }}</label>
            <input type="text" name="descripcion_documento"
                class="form-control @error('descripcion_documento') is-invalid @enderror"
                value="{{ old('descripcion_documento', $archivo?->descripcion_documento) }}" id="descripcion_documento"
                placeholder="Descripcion Documento">
            {!! $errors->first('descripcion_documento', '<div class="invalid-feedback" role="alert">
                <strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tomo" class="form-label">{{ __('Tomo') }}</label>
            <input type="text" name="tomo" class="form-control @error('tomo') is-invalid @enderror"
                value="{{ old('tomo', $archivo?->tomo) }}" id="tomo" placeholder="Tomo">
            {!! $errors->first('tomo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_foja" class="form-label">{{ __('Numero Foja') }}</label>
            <input type="text" name="numero_foja" class="form-control @error('numero_foja') is-invalid @enderror"
                value="{{ old('numero_foja', $archivo?->numero_foja) }}" id="numero_foja" placeholder="Numero Foja">
            {!! $errors->first('numero_foja', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="gestion" class="form-label">{{ __('Gestion') }}</label>
            <input type="text" name="gestion" class="form-control @error('gestion') is-invalid @enderror"
                value="{{ old('gestion', $archivo?->gestion) }}" id="gestion" placeholder="Gestion">
            {!! $errors->first('gestion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>')
            !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="unidad_instalacion" class="form-label">{{ __('Unidad Instalacion') }}</label>
            <input type="text" name="unidad_instalacion"
                class="form-control @error('unidad_instalacion') is-invalid @enderror"
                value="{{ old('unidad_instalacion', $archivo?->unidad_instalacion) }}" id="unidad_instalacion"
                placeholder="Unidad Instalacion">
            {!! $errors->first('unidad_instalacion', '<div class="invalid-feedback" role="alert">
                <strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="observaciones" class="form-label">{{ __('Observaciones') }}</label>
            <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror"
                value="{{ old('observaciones', $archivo?->observaciones) }}" id="observaciones"
                placeholder="Observaciones">
            {!! $errors->first('observaciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_registro" class="form-label">{{ __('Fecha Registro') }}</label>
            <input type="date" name="fecha_registro" class="form-control @error('fecha_registro') is-invalid @enderror"
                value="{{ old('fecha_registro', $archivo?->fecha_registro) }}" id="fecha_registro"
                placeholder="Fecha Registro">
            {!! $errors->first('fecha_registro', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="unidad_id" class="form-label">{{ __('Unidad') }}</label>
            <select name="unidad_id" id="unidad_id" class="form-control @error('unidad_id') is-invalid @enderror">
                <option value="">-- Selecciona una unidad --</option>
                @foreach($unidades as $id => $nombre)
                <option value="{{ $id }}" {{ old('unidad_id', $archivo?->unidad_id) == $id ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('unidad_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>
            ') !!}
        </div>


        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror"
                value="{{ old('estado', $archivo?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>')
            !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="categoria_id" class="form-label">{{ __('Categoría') }}</label>
            <select name="categoria_id" id="categoria_id"
                class="form-control @error('categoria_id') is-invalid @enderror">
                <option value="">-- Selecciona una categoría --</option>
                @foreach($categorias as $id => $nombre)
                <option value="{{ $id }}" {{ old('categoria_id', $archivo?->categoria_id) == $id ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('categoria_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>



    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Registrar Archivo</button>
        <a href="{{ route('archivos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
    
</div>