@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Usuarios Registrados</h1><br>

    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Lista de Usuarios</b></h3>
                    <div class="card-tools">
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">Nuevo Usuario</a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-info">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
