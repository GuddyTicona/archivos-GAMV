@extends('layouts.admin')


@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Usuario</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('usuarios.update', $usuarios->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('usuarios.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
