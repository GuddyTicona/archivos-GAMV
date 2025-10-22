@extends('layouts.admin')

@section('content')
<section class="content container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">

                <div class="card-body">

                    {{-- Información General --}}
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white text-center">Información General</div>
                        <div class="card-body row g-3">
                            <div class="col-md-4">
                                <label>Entidad</label>
                                <input class="form-control" readonly value="{{ $financiera->entidad }}">
                            </div>
                            <div class="col-md-4">
                                <label>Unidad</label>
                                <input class="form-control" readonly value="{{ $financiera->unidad->nombre_unidad }}">
                            </div>
                            <div class="col-md-4">
                                <label>Área Receptora</label>
                                <input class="form-control" readonly value="{{ $financiera->area->nombre ?? 'No asignada' }}">
                            </div>
                            <div class="col-md-4">
                                <label>Estado Documento</label>
                                <input class="form-control" readonly value="{{ $financiera->estado_documento }}">
                            </div>
                            <div class="col-md-4">
                                <label>Tipo Documento</label>
                                <input class="form-control" readonly value="{{ $financiera->tipo_documento }}">
                            </div>
                            <div class="col-md-4">
                                <label>Tipo Ejecución</label>
                                <input class="form-control" readonly value="{{ $financiera->tipo_ejecucion }}">
                            </div>
                            <div class="col-md-4">
                                <label>Fecha Documento</label>
                                <input class="form-control" readonly value="{{ $financiera->fecha_documento }}">
                            </div>
                            <div class="col-md-4">
                                <label>Documento Adjunto</label><br>
                                @if ($financiera->documento_adjunto)
                                    <a href="{{ asset('storage/' . $financiera->documento_adjunto) }}" target="_blank" class="btn btn-outline-primary btn-sm">Ver Documento</a>
                                @else
                                    <span class="text-muted">No adjunto</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Números de Trámite --}}
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white text-center">Números de Trámite</div>
                        <div class="card-body row g-3">
                            @foreach ([
                                'numero_hoja_ruta' => 'N° Hoja Ruta',
                                'numero_compromiso' => 'N° Compromiso',
                                'numero_devengado' => 'N° Devengado',
                                'numero_pago' => 'N° Pago',
                                'numero_secuencia' => 'N° Secuencia'
                            ] as $campo => $etiqueta)
                                <div class="col-md-4">
                                    <label>{{ $etiqueta }}</label>
                                    <input class="form-control" readonly value="{{ $financiera->$campo }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Preventivos --}}
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-center">Nros. Preventivos del Trámite</div>
                        <div class="card-body table-responsive">
                            @if($financiera->preventivos->count())
                                <table class="table table-bordered table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>N° Preventivo</th>
                                            <th>Total Pago (Bs)</th>
                                            <th>Descripción</th>
                                            <th>Empresa</th>
                                            <th>Beneficiario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($financiera->preventivos as $p)
                                            <tr>
                                                <td>{{ $p->numero_preventivo }}</td>
                                                <td>{{ number_format($p->total_pago, 3, '.', ',') }}</td>
                                                <td>{{ $p->descripcion_gasto }}</td>
                                                <td>{{ $p->empresa }}</td>
                                                <td>{{ $p->beneficiario }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info">No se registraron preventivos en este trámite.</div>
                            @endif
                        </div>
                    </div>

                    {{-- Botón inferior --}}
                    <div class="text-end mt-4">
                        <a href="{{ route('financieras.index') }}" class="btn btn-secondary">Volver</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
