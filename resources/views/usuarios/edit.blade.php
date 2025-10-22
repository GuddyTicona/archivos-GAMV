@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Editar Usuario: {{ $usuario->name }}</h2>

    @include('usuarios.partials.form', [
        'route' => route('usuarios.update', $usuario->id),
        'method' => 'PUT',
        'usuario' => $usuario,
        'rolActual' => $rolActual,
        'permisosActuales' => $permisosActuales
    ])
</div>
@endsection
