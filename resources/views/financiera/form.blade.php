<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="entidad" class="form-label">{{ __('Entidad') }}</label>
            <input type="text" name="entidad" class="form-control @error('entidad') is-invalid @enderror"
                value="{{ old('entidad', $financiera?->entidad) }}" id="entidad" placeholder="Entidad">
            {!! $errors->first('entidad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>')
            !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="unidad_id" class="form-label">{{ __('Unidad') }}</label>
            <select name="unidad_id" id="unidad_id" class="form-control @error('unidad_id') is-invalid @enderror">
                <option value="">-- Selecciona una unidad --</option>
                @foreach($unidades as $id => $nombre)
                <option value="{{ $id }}" {{ old('unidad_id', $financiera?->unidad_id) == $id ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('unidad_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>
            ') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion_gasto" class="form-label">{{ __('Descripcion Gasto') }}</label>
            <input type="text" name="descripcion_gasto"
                class="form-control @error('descripcion_gasto') is-invalid @enderror"
                value="{{ old('descripcion_gasto', $financiera?->descripcion_gasto) }}" id="descripcion_gasto"
                placeholder="Descripcion Gasto">
            {!! $errors->first('descripcion_gasto', '<div class="invalid-feedback" role="alert">
                <strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="total_pago" class="form-label">{{ __('Total Pago') }}</label>
            <input type="number" step="0.01" name="total_pago"
                class="form-control @error('total_pago') is-invalid @enderror"
                value="{{ old('total_pago', $financiera?->total_pago) }}" id="total_pago" placeholder="Total Pago">
            {!! $errors->first('total_pago', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>
            ') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="estado_documento" class="form-label">{{ __('Estado Documento') }}</label>
            <select name="estado_documento" id="estado_documento"
                class="form-control @error('estado_documento') is-invalid @enderror">
                <option value="">-Selccione el estado del documento--</option>
                <option value="pendiente"
                    {{ old('estado_documento', $financiera?->estado_documento) == 'pendiente' ? 'selected' : '' }}>
                    Pendiente</option>
                <option value="aprobado"
                    {{ old('estado_documento', $financiera?->estado_documento) == 'aprobado' ? 'selected' : '' }}>
                    Aprobado</option>
                <option value="rechazado"
                    {{ old('estado_documento', $financiera?->estado_documento) == 'rechazado' ? 'selected' : '' }}>
                    Rechazado</option>
            </select>
            {!! $errors->first('estado_documento', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="tipo_documento" class="form-label">{{ __('Tipo Documento') }}</label>
            <input type="text" name="tipo_documento" class="form-control @error('tipo_documento') is-invalid @enderror"
                value="{{ old('tipo_documento', $financiera?->tipo_documento) }}" id="tipo_documento"
                placeholder="Tipo Documento">
            {!! $errors->first('tipo_documento', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tipo_ejecucion" class="form-label">{{ __('Tipo Ejecucion') }}</label>
            <input type="text" name="tipo_ejecucion" class="form-control @error('tipo_ejecucion') is-invalid @enderror"
                value="{{ old('tipo_ejecucion', $financiera?->tipo_ejecucion) }}" id="tipo_ejecucion"
                placeholder="Tipo Ejecucion">
            {!! $errors->first('tipo_ejecucion', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_documento" class="form-label">{{ __('Fecha Documento') }}</label>
            <input type="date" name="fecha_documento"
                class="form-control @error('fecha_documento') is-invalid @enderror"
                value="{{ old('fecha_documento', $financiera?->fecha_documento) }}" id="fecha_documento"
                placeholder="Fecha Documento">
            {!! $errors->first('fecha_documento', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="documento_adjunto" class="form-label">{{ __('Documento Adjunto') }}</label>
            <input type="text" name="documento_adjunto"
                class="form-control @error('documento_adjunto') is-invalid @enderror"
                value="{{ old('documento_adjunto', $financiera?->documento_adjunto) }}" id="documento_adjunto"
                placeholder="Documento Adjunto">
            {!! $errors->first('documento_adjunto', '<div class="invalid-feedback" role="alert">
                <strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_hoja_ruta" class="form-label">{{ __('Numero Hoja Ruta') }}</label>
            <input type="number" name="numero_hoja_ruta"
                class="form-control @error('numero_hoja_ruta') is-invalid @enderror"
                value="{{ old('numero_hoja_ruta', $financiera?->numero_hoja_ruta) }}" id="numero_hoja_ruta"
                placeholder="Numero Hoja Ruta">
            {!! $errors->first('numero_hoja_ruta', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_preventivo" class="form-label">{{ __('Numero Preventivo') }}</label>
            <input type="number" name="numero_preventivo"
                class="form-control @error('numero_preventivo') is-invalid @enderror"
                value="{{ old('numero_preventivo', $financiera?->numero_preventivo) }}" id="numero_preventivo"
                placeholder="Numero Preventivo">
            {!! $errors->first('numero_preventivo', '<div class="invalid-feedback" role="alert">
                <strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_compromiso" class="form-label">{{ __('Numero Compromiso') }}</label>
            <input type="number" name="numero_compromiso"
                class="form-control @error('numero_compromiso') is-invalid @enderror"
                value="{{ old('numero_compromiso', $financiera?->numero_compromiso) }}" id="numero_compromiso"
                placeholder="Numero Compromiso">
            {!! $errors->first('numero_compromiso', '<div class="invalid-feedback" role="alert">
                <strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_devengado" class="form-label">{{ __('Numero Devengado') }}</label>
            <input type="number" name="numero_devengado"
                class="form-control @error('numero_devengado') is-invalid @enderror"
                value="{{ old('numero_devengado', $financiera?->numero_devengado) }}" id="numero_devengado"
                placeholder="Numero Devengado">
            {!! $errors->first('numero_devengado', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_pago" class="form-label">{{ __('Numero Pago') }}</label>
            <input type="number" name="numero_pago" class="form-control @error('numero_pago') is-invalid @enderror"
                value="{{ old('numero_pago', $financiera?->numero_pago) }}" id="numero_pago" placeholder="Numero Pago">
            {!! $errors->first('numero_pago', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_secuencia" class="form-label">{{ __('Numero Secuencia') }}</label>
            <input type="number" name="numero_secuencia"
                class="form-control @error('numero_secuencia') is-invalid @enderror"
                value="{{ old('numero_secuencia', $financiera?->numero_secuencia) }}" id="numero_secuencia"
                placeholder="Numero Secuencia">
            {!! $errors->first('numero_secuencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Guardar Registro</button>
        <a href="{{ route('financieras.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>