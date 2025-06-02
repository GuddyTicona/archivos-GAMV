@extends('layouts.admin')



@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear nuevo registro</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('financieras.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('financiera.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
