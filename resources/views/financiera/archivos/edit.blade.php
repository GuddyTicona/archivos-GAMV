@extends('layouts.admin')

@section('content')
<section class="content container-fluid">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
          
            <div class="card-body bg-white">
                <form method="POST" action="{{ route('financieras.updateArchivo', $financiera->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- Validación --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>¡Hay errores en el formulario!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Información General (solo lectura) --}}
                    <div class="card mb-4 border">
                        <div class="card-header bg-primary text-white">Información General</div>
                        <div class="card-body row g-3">
                            <div class="col-md-4">
                                <label>Entidad</label>
                                <input type="text" class="form-control" value="{{ $financiera->entidad }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Unidad</label>
                                <input type="text" class="form-control" value="{{ $financiera->unidad->nombre_unidad ?? 'N/D' }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Área</label>
                                <input type="text" class="form-control" value="{{ $financiera->area->nombre ?? 'N/D' }}" disabled>
                            </div>
                        </div>
                    </div>

                    {{-- Preventivos (solo lectura) --}}
                    <div class="card mb-4 border">
                        <div class="card-header bg-warning text-dark">Preventivos del Trámite</div>
                        <div class="card-body">
                            @foreach($financiera->preventivos as $preventivo)
                                <div class="row g-3 mb-3 border-bottom pb-3">
                                    <div class="col-md-4">
                                        <label>N° Preventivo</label>
                                        <input type="text" class="form-control" value="{{ $preventivo->numero_preventivo }}" disabled>
                                    </div>
                                     <div class="col-md-4">
                                        <label>N° Secuencia</label>
                                        <input type="text" class="form-control" value="{{ $preventivo->numero_secuencia }}" disabled>
                                    </div>
                                     <div class="col-md-4">
                                        <label>Empresa</label>
                                        <input type="text" class="form-control" value="{{ $preventivo->empresa }}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Beneficiario</label>
                                        <input type="text" class="form-control" value="{{ $preventivo->beneficiario }}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Total Pago</label>
                                        <input type="text" class="form-control" value="{{ $preventivo->total_pago }}" disabled>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Descripción del Gasto</label>
                                        <textarea class="form-control" disabled>{{ $preventivo->descripcion_gasto }}</textarea>
                                    </div>
                                   
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Números de Trámite (solo lectura) --}}
                    <div class="card mb-4 border">
                        <div class="card-header bg-dark text-white">Números de Trámite</div>
                        <div class="card-body row g-3">
                            @foreach ([
                                'numero_hoja_ruta' => 'N° Hoja Ruta',
                                'numero_foja' => 'N° Foja',
                                'numero_compromiso' => 'N° Compromiso',
                                'numero_devengado' => 'N° Devengado',
                                'numero_pago' => 'N° Pago',
                                
                            ] as $name => $label)
                                <div class="col-md-4">
                                    <label>{{ $label }}</label>
                                    <input type="text" class="form-control" value="{{ $financiera->$name }}" disabled>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Datos del Documento (editable solo documento adjunto) --}}
                    <div class="card mb-4 border">
                        <div class="card-header bg-success text-white">Documento Adjunto</div>
                        <div class="card-body row g-3">
                            <div class="col-md-6">
                                <label>Cargar documento</label>
                                <input type="file" name="documento_adjunto" class="form-control">
                                @if ($financiera->documento_adjunto)
                                    <p class="mt-2">
                                        <a href="{{ asset('storage/'.$financiera->documento_adjunto) }}" target="_blank" class="text-primary">
                                            Ver documento actual
                                        </a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">Actualizar archivo</button>
                        <a href="{{ route('financieras.archivos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection
