@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Registrar Nueva Área</h2>

    @include('areas.form', ['area' => new \App\Models\Area(), 'route' => route('areas.store'), 'method' => 'POST'])
</div>
@endsection
