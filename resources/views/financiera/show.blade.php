@extends('layouts.admin')



@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Informacion financiera</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('financieras.index') }}">Volver</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Entidad:</strong>
                                    {{ $financiera->entidad }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Unidad Id:</strong>
                                    {{ $financiera->unidad_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion Gasto:</strong>
                                    {{ $financiera->descripcion_gasto }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Total Pago:</strong>
                                    {{ $financiera->total_pago }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado Documento:</strong>
                                    {{ $financiera->estado_documento }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tipo Documento:</strong>
                                    {{ $financiera->tipo_documento }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tipo Ejecucion:</strong>
                                    {{ $financiera->tipo_ejecucion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Documento:</strong>
                                    {{ $financiera->fecha_documento }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Documento Adjunto:</strong>
                                    {{ $financiera->documento_adjunto }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Numero Hoja Ruta:</strong>
                                    {{ $financiera->numero_hoja_ruta }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Numero Preventivo:</strong>
                                    {{ $financiera->numero_preventivo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Numero Compromiso:</strong>
                                    {{ $financiera->numero_compromiso }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Numero Devengado:</strong>
                                    {{ $financiera->numero_devengado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Numero Pago:</strong>
                                    {{ $financiera->numero_pago }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Numero Secuencia:</strong>
                                    {{ $financiera->numero_secuencia }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
