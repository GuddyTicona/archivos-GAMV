<div class="container">
    <div class="card shadow-lg rounded-4 mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Registro de Archivo</h4>
        </div>
        <div class="card-body">
            <div class="row g-3">
                {{-- Primera columna --}}
                <div class="col-md-6">
                    {{-- Codigo Archivo --}}
                    <div class="form-group">
                        <label for="codigo_archivo">Código Archivo</label>
                        <input type="text" name="codigo_archivo" id="codigo_archivo"
                            class="form-control @error('codigo_archivo') is-invalid @enderror"
                            value="{{ old('codigo_archivo', $archivo?->codigo_archivo) }}" placeholder="Codigo archivo">
                        {!! $errors->first('codigo_archivo', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- Descripcion Documento --}}
                    <div class="form-group">
                        <label for="descripcion_documento"> Descripción Documento</label>
                        <input type="text" name="descripcion_documento" id="descripcion_documento"
                            class="form-control @error('descripcion_documento') is-invalid @enderror"
                            value="{{ old('descripcion_documento', $archivo?->descripcion_documento) }}"
                            placeholder="Descripcion del documento...">
                        {!! $errors->first('descripcion_documento', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- Tomo --}}
                    <div class="form-group">
                        <label for="tomo">Tomo</label>
                        <input type="text" name="tomo" id="tomo"
                            class="form-control @error('tomo') is-invalid @enderror"
                            value="{{ old('tomo', $archivo?->tomo) }}" placeholder="Numero de tomo">
                        {!! $errors->first('tomo', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- Numero Foja --}}
                    <div class="form-group">
                        <label for="numero_foja">Número Foja</label>
                        <input type="text" name="numero_foja" id="numero_foja"
                            class="form-control @error('numero_foja') is-invalid @enderror"
                            value="{{ old('numero_foja', $archivo?->numero_foja) }}" placeholder="Numero de foja">
                        {!! $errors->first('numero_foja', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- Gestión --}}
                    <div class="form-group">
                        <label for="gestion">Gestión</label>
                        <input type="text" name="gestion" id="gestion"
                            class="form-control @error('gestion') is-invalid @enderror"
                            value="{{ old('gestion', $archivo?->gestion) }}" placeholder="Gestion">
                        {!! $errors->first('gestion', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>

                {{-- Segunda columna --}}
                <div class="col-md-6">
                    {{-- Unidad Instalación --}}
                    <div class="form-group">
                        <label for="unidad_instalacion">Unidad Instalación</label>
                        <input type="text" name="unidad_instalacion" id="unidad_instalacion"
                            class="form-control @error('unidad_instalacion') is-invalid @enderror"
                            value="{{ old('unidad_instalacion', $archivo?->unidad_instalacion) }}"
                            placeholder="Empastado, folder amarrillo">
                        {!! $errors->first('unidad_instalacion', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- Observaciones --}}
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <input type="text" name="observaciones" id="observaciones"
                            class="form-control @error('observaciones') is-invalid @enderror"
                            value="{{ old('observaciones', $archivo?->observaciones) }}"
                            placeholder="Observaciones">
                        {!! $errors->first('observaciones', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- Fecha Registro --}}
                    <div class="form-group">
                        <label for="fecha_registro">Fecha Registro</label>
                        <input type="date" name="fecha_registro" id="fecha_registro"
                            class="form-control @error('fecha_registro') is-invalid @enderror"
                            value="{{ old('fecha_registro', $archivo?->fecha_registro) }}">
                        {!! $errors->first('fecha_registro', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- Unidad --}}
                    <div class="form-group">
                        <label for="unidad_id">Unidad</label>
                        <select name="unidad_id" id="unidad_id"
                            class="form-select @error('unidad_id') is-invalid @enderror">
                            <option value="">-- Selecciona una unidad --</option>
                            @foreach($unidades as $id => $nombre)
                            <option value="{{ $id }}"
                                {{ old('unidad_id', $archivo?->unidad_id) == $id ? 'selected' : '' }}>
                                {{ $nombre }}
                            </option>
                            @endforeach
                        </select>
                        {!! $errors->first('unidad_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- Estado --}}
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" name="estado" id="estado"
                            class="form-control @error('estado') is-invalid @enderror"
                            value="{{ old('estado', $archivo?->estado) }}" placeholder="Activo / Inactivo">
                        {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- Categoría --}}
                    <div class="form-group">
                        <label for="categoria_id">Categoría</label>
                        <select name="categoria_id" id="categoria_id"
                            class="form-select @error('categoria_id') is-invalid @enderror">
                            <option value="">-- Selecciona una categoría --</option>
                            @foreach($categorias as $id => $nombre)
                            <option value="{{ $id }}"
                                {{ old('categoria_id', $archivo?->categoria_id) == $id ? 'selected' : '' }}>
                                {{ $nombre }}
                            </option>
                            @endforeach
                        </select>
                        {!! $errors->first('categoria_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>



                </div>
            </div>

            <div class="col-md-4">
                <label for="documento_adjunto" class="form-label">Documento Adjunto</label>
                <input type="file" name="documento_adjunto"
                    class="form-control @error('documento_adjunto') is-invalid @enderror" id="documento_adjunto"
                    accept=".pdf,.doc,.docx,.xls,.xlsx">
                {!! $errors->first('documento_adjunto', '<div class="invalid-feedback"><strong>:message</strong>
                </div>')
                !!}
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary"> Registrar Archivo</button>
                <a href="{{ route('archivos.index') }}" class="btn btn-secondary"> Volver</a>
            </div>
        </div>
    </div>
</div>