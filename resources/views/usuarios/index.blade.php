@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Listado de Usuarios</h2>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">Nuevo Usuario</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol(es)</th>
                <th>Permisos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->roles->pluck('name')->join(', ') }}</td>
                    <td>{{ $usuario->permissions->pluck('name')->join(', ') }}</td>
                    <td>
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')" class="btn btn-danger btn-sm">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $usuarios->links() }}
</div>
@endsection
