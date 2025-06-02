@extends('layouts.admin')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear nuevo usuario</span>
                    </div>
                  
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('usuarios.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('usuarios.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
