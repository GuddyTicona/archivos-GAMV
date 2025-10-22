@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle del Usuario</h2>

    <div class="card">
        <div class="card-body">
            <h4>{{ $usuario->name }}</h4>
            <p><strong>Correo:</strong> {{ $usuario->email }}</p>
            <p><strong>Rol(es):</strong> {{ $usuario->roles->pluck('name')->join(', ') }}</p>
            <p><strong>Permisos:</strong> {{ $usuario->permissions->pluck('name')->join(', ') }}</p>

            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
