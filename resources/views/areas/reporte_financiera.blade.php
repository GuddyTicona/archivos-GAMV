<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Financiera - Área {{ $area->nombre }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size:12px; margin:20px; }
        .title { text-align:center; font-weight:bold; text-transform:uppercase; margin-bottom:10px; }
        .subtitle { text-align:center; font-size:12px; margin-bottom:15px; }
        .section { margin-bottom:20px; }
        .section-title { font-weight:bold; font-size:13px; margin-bottom:8px; text-transform:uppercase; border-bottom:1px solid #000; padding-bottom:3px; }
        .table { width:100%; border-collapse:collapse; margin-top:8px; }
        .table th, .table td { border:1px solid #000; padding:6px; font-size:12px; }
        .table th { background-color:#f2f2f2; text-align:center; }
        .no-records { text-align:center; font-style:italic; margin-top:20px; }
    </style>
</head>
<body>

@php
    $fechaActa = !empty($fecha) ? \Carbon\Carbon::parse($fecha)->format('d/m/Y') : 'N/A';
@endphp

@if($financieras->isEmpty())
    <div class="no-records">
        No hay registros financieros para la fecha seleccionada ({{ $fechaActa }}).
    </div>
@else

@foreach($financieras as $financiera)

<div class="title">
    SECRETARÍA MUNICIPAL ADMINISTRATIVA FINANCIERA <br>
    DIRECCIÓN FINANCIERA SMAF
</div>

<div class="subtitle">
    <strong>ACTA DE ENTREGA - RECEPCIÓN DE DOCUMENTO FÍSICO Y DIGITAL DE PAGO ELECTRÓNICO</strong><br>
    Acta Nº: {{ $actaNumero ?? 'N/A' }} | Fecha: {{ $fechaActa }}
</div>

<div class="section">
    <div class="section-title">Información General</div>
    <table>
        <tr>
            <td><strong>Entidad</strong><br>{{ $financiera->entidad }}</td>
            <td><strong>Unidad</strong><br>{{ $financiera->unidad->nombre_unidad ?? 'No asignada' }}</td>
        </tr>
        <tr>
            <td><strong>Tipo Documento</strong><br>{{ $financiera->tipo_documento }}</td>
            <td><strong>Tipo Ejecución</strong><br>{{ $financiera->tipo_ejecucion }}</td>
        </tr>
        <tr>
            <td><strong>Fecha Documento</strong><br>{{ $fechaActa }}</td>
            <td><strong>Hoja de Ruta</strong><br>{{ $financiera->numero_hoja_ruta }}</td>
        </tr>
        <tr>
            <td><strong>Número Compromiso</strong><br>{{ $financiera->numero_compromiso }}</td>
            <td><strong>Número Devengado</strong><br>{{ $financiera->numero_devengado }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Número Pago</strong><br>{{ $financiera->numero_pago }}</td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Preventivos</div>
    <table class="table">
        <thead>
            <tr>
                <th>N° Preventivo</th>
                <th>Empresa</th>
                <th>Descripción Gasto</th>
                <th>Total Pago (Bs)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($financiera->preventivos as $preventivo)
            <tr>
                <td>{{ $preventivo->numero_preventivo }}</td>
                <td>{{ $preventivo->empresa }}</td>
                <td>{{ $preventivo->descripcion_gasto }}</td>
                <td style="text-align:right">{{ number_format($preventivo->total_pago, 2, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align:right; font-weight:bold;">TOTAL</td>
                <td style="text-align:right; font-weight:bold;">{{ number_format($financiera->preventivos->sum('total_pago'), 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</div>

<div style="page-break-after: always;"></div>

@endforeach

@endif

</body>
</html>
