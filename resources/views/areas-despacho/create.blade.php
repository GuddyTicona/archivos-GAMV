@extends('layouts.admin')

@section('content')
<div class="container my-4">
    <h2>Registrar Nueva Área - Despacho</h2>

    @include('areas-despacho.form', [
        'area' => new \App\Models\AreaDespacho(),
        'route' => route('areas-despacho.store'),
        'method' => 'POST'
    ])
</div>
@endsection
