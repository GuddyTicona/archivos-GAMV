@extends('layouts.admin')

@section('content')
<div class="container">
    <h4>Editar financiera (SMAF)</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>¡Errores encontrados!</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('financieras.smaf.update', $financiera->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- Aquí va tu formulario parcial --}}
        @include('financiera.smaf.form', ['financiera' => $financiera])
    </form>

</div>
@endsection