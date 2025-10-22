@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-sm p-3">
        <h4 class="mb-3">Detalle Archivo Financiero</h4>

        <!-- Información general -->
        <div class="mb-3">
            <p><strong>Código:</strong> {{ $financiera->codigo }}</p>
            <p><strong>Entidad:</strong> {{ $financiera->entidad }}</p>
            <p><strong>Unidad:</strong> {{ $financiera->unidad->nombre_unidad ?? 'N/D' }}</p>
            <p><strong>Área:</strong> {{ $financiera->area->nombre ?? 'N/D' }}</p>
            <p><strong>Estado Tesorería:</strong> {{ ucfirst($financiera->estado_tesoreria ?? 'N/D') }}</p>

            <p><strong>Ubicación:</strong>
                @if($financiera->ubicacion)
                    Estante {{ $financiera->ubicacion->estante }},
                    Fila {{ $financiera->ubicacion->fila }},
                    Columna {{ $financiera->ubicacion->columna }}
                @else
                    <span class="text-muted">No asignada</span>
                @endif
            </p>
        </div>

        <hr>

        <!-- Preventivos -->
        <h5>Preventivos</h5>
        @forelse($financiera->preventivos as $preventivo)
        <div class="card mb-2 p-2">
            <p><strong>N° Preventivo:</strong> {{ $preventivo->numero_preventivo }}</p>
            <p><strong>N° Secuencia:</strong> {{ $preventivo->numero_secuencia }}</p>
            <p><strong>Empresa:</strong> {{ $preventivo->empresa ?? 'N/D' }}</p>
            <p><strong>Beneficiario:</strong> {{ $preventivo->beneficiario }}</p>
            <p><strong>Descripción:</strong> {{ $preventivo->descripcion_gasto ?? 'N/D' }}</p>
            <p><strong>Total:</strong> {{ number_format($preventivo->total_pago, 2) }} Bs</p>
        </div>
        @empty
        <p class="text-muted">No hay preventivos asociados.</p>
        @endforelse

        <hr>

        <div class="mt-3">
            <a href="{{ route('financieras.index') }}" class="btn btn-secondary">← Volver al listado</a>
           
            <a href="{{ route('ubicaciones.asignar', $financiera->id) }}" class="btn btn-primary">Asignar/Actualizar Ubicación</a>
        </div>
    </div>
</div>
@endsection
