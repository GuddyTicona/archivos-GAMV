@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Detalle Financiera - Despacho</h4>
        <a href="{{ route('financieras.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Entidad:</strong> {{ $financiera->entidad }}</p>
            <p><strong>Unidad:</strong> {{ $financiera->unidad->nombre_unidad ?? 'No asignada' }}</p>
            <p><strong>Área:</strong> {{ $financiera->area->nombre ?? 'No asignada' }}</p>
            <p><strong>Estado Documento:</strong> {{ ucfirst($financiera->estado_documento) }}</p>
            <p><strong>Estado Despacho:</strong> {{ $financiera->estado_despacho ?? 'Pendiente' }}</p>
            <p><strong>Tipo Documento:</strong> {{ $financiera->tipo_documento }}</p>
            <p><strong>Tipo Ejecución:</strong> {{ $financiera->tipo_ejecucion }}</p>
            <p><strong>Fecha Documento:</strong> {{ $financiera->fecha_documento }}</p>
            <p><strong>N° Compromiso:</strong> {{ $financiera->numero_compromiso }}</p>
            <p><strong>N° Devengado:</strong> {{ $financiera->numero_devengado }}</p>
            <p><strong>N° Pago:</strong> {{ $financiera->numero_pago }}</p>

            <hr>
            <h5>Preventivos Asociados</h5>
            @forelse($financiera->preventivos as $preventivo)
                <div class="border rounded p-3 mb-2 bg-light">
                    <p><strong>N° Preventivo:</strong> {{ $preventivo->numero_preventivo }}</p>
                    <p><strong>Total Pago:</strong> {{ number_format($preventivo->total_pago, 2) }} Bs</p>
                    <p><strong>Descripción:</strong> {{ $preventivo->descripcion_gasto }}</p>
                    <p><strong>Empresa:</strong> {{ $preventivo->empresa }}</p>
                </div>
            @empty
                <p>No hay preventivos registrados.</p>
            @endforelse

            @if($financiera->documento_adjunto)
                <hr>
                <p><strong>Documento Adjunto:</strong> 
                    <a href="{{ asset('storage/' . $financiera->documento_adjunto) }}" target="_blank" rel="noopener noreferrer">Ver documento</a>
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
