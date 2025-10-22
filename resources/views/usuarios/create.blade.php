@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Crear Usuario</h2>

    @include('usuarios.partials.form', ['route' => route('usuarios.store'), 'method' => 'POST', 'usuario' => $usuarios])
</div>
@endsection
