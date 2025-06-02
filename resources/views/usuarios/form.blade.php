<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">Nombre Usuario</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $usuarios?->name) }}" id="name" placeholder="Nombre Usuario">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $usuarios?->email) }}" id="email" placeholder="Correo del usuario">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>')
            !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control @error('fecha_ingreso') is-invalid @enderror"
                value="{{ old('fecha_ingreso', $usuarios?->fecha_ingreso) }}" id="fecha_ingreso"
                placeholder="Ingreso del usuario">
            {!! $errors->first('fecha_ingreso', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>')
            !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-control @error('estado') is-invalid @enderror" id="estado">
                <option value="">-- Selecciona estado --</option>
                <option value="Activo" {{ old('estado', $usuarios?->estado) == 'Activo' ? 'selected' : '' }}>Activo
                </option>
                <option value="Inactivo" {{ old('estado', $usuarios?->estado) == 'Inactivo' ? 'selected' : '' }}>
                    Inactivo</option>
            </select>
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>')
            !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                id="password" placeholder="Contraseña del usuario">
            {!! $errors->first('password', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>')
            !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                placeholder="Repetir contraseña">
        </div>
    </div>


    <div class="col-md-12 mt20 mt-2">

        <button type="submit" class="btn btn-primary">Registrar Usuario</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
    </div>



</div>