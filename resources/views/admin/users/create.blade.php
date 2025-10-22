@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Registrar Usuario</h1><br>

    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control" value="{{ date('Y-m-d') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="estado" class="form-control" required>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Roles</label>
                            <select name="roles[]" class="form-control" multiple required>
                                @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection