@extends('layouts.admin')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Ver usuarios Registrados</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('usuarios.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Usuario:</strong>
                                    {{ $usuarios->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Correo Email:</strong>
                                    {{ $usuarios->email }}
                                </div>
                                                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Registrado:</strong>
                                    {{ $usuarios->fecha_ingreso }}
                                </div>
                                                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $usuarios->estado}}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
