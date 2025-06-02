@extends('layouts.admin')


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Detalle del archivo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('archivos.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Codigo Archivo:</strong>
                                    {{ $archivo->codigo_archivo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion Documento:</strong>
                                    {{ $archivo->descripcion_documento }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tomo:</strong>
                                    {{ $archivo->tomo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Numero Foja:</strong>
                                    {{ $archivo->numero_foja }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Gestion:</strong>
                                    {{ $archivo->gestion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Unidad Instalacion:</strong>
                                    {{ $archivo->unidad_instalacion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Observaciones:</strong>
                                    {{ $archivo->observaciones }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Registro:</strong>
                                    {{ $archivo->fecha_registro }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Unidad que pertenece:</strong>
                                    {{ $archivo->unidad->nombre_unidad }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $archivo->estado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Categoria docuemntos que pertenece:</strong>
                                    {{ $archivo->Categorias ->nombre_categoria }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
