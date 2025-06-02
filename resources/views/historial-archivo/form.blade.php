<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="archivo_id" class="form-label">{{ __('Archivo') }}</label>
            <select name="archivo_id" id="archivo_id" class="form-control @error('archivo_id') is-invalid @enderror">
                <option value="">-- Selecciona un archivo --</option>
                @foreach($archivos as $id => $codigo)
                <option value="{{ $id }}"
                    {{ old('archivo_id', $historialArchivo?->archivo_id) == $id ? 'selected' : '' }}>
                    {{ $codigo }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('archivo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>
            ') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="user_id" class="form-label">{{ __('Usuario') }}</label>
            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                <option value="">-- Selecciona un usuario --</option>
                @foreach($usuarios as $id => $nombre)
                <option value="{{ $id }}" {{ old('user_id', $historialArchivo?->user_id) == $id ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>')
            !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="tipo_evento" class="form-label">{{ __('Tipo Evento') }}</label>
            <input type="text" name="tipo_evento" class="form-control @error('tipo_evento') is-invalid @enderror"
                value="{{ old('tipo_evento', $historialArchivo?->tipo_evento) }}" id="tipo_evento"
                placeholder="Tipo Evento">
            {!! $errors->first('tipo_evento', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="observaciones" class="form-label">{{ __('Observaciones') }}</label>
            <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror"
                value="{{ old('observaciones', $historialArchivo?->observaciones) }}" id="observaciones"
                placeholder="Observaciones">
            {!! $errors->first('observaciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_financiera" class="form-label">{{ __('Financiera') }}</label>
            <select name="id_financiera" id="id_financiera"
                class="form-control @error('id_financiera') is-invalid @enderror">
                <option value="">-- Selecciona una financiera --</option>
                @foreach($financieras as $id => $nombre)
                <option value="{{ $id }}"
                    {{ old('id_financiera', $historialArchivo?->id_financiera) == $id ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('id_financiera', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
            <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror"
                value="{{ old('fecha', $historialArchivo?->fecha) }}" id="fecha" placeholder="Fecha">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>')
            !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Registar</button>
        <a href="{{ route('historial-archivos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>