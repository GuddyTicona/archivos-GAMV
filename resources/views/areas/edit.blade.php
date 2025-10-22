@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Editar Área: {{ $area->nombre }}</h2>

    @include('areas.form', [
        'area' => $area,
        'route' => route('areas.update', $area->id),
        'method' => 'PUT'
    ])
</div>
@endsection
