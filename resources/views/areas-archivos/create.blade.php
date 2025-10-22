@extends('layouts.admin')

@section('content')
<div class="container my-4">
    <h2>Registrar Nueva Área - Archivos</h2>

    @include('areas-archivos.form', [
        'area' => new \App\Models\AreaArchivo,
        'route' => route('areas-archivos.store'),
        'method' => 'POST'
    ])
</div>
@endsection
