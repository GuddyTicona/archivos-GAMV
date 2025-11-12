<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Financiera - Área {{ $area->nombre }}</title>
    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 12px;
        margin: 20px;
    }

    .title {
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .subtitle {
        text-align: center;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .section {
        margin-bottom: 20px;
    }

    .section-title {
        font-weight: bold;
        font-size: 13px;
        margin-bottom: 8px;
        text-transform: uppercase;
        border-bottom: 1px solid #000;
        padding-bottom: 3px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
    }

    .table th,
    .table td {
        border: 1px solid #000;
        padding: 6px;
        font-size: 12px;
    }

    .table th {
        background-color: #f2f2f2;
        text-align: center;
    }

    .no-records {
        text-align: center;
        font-style: italic;
        margin-top: 20px;
    }
    </style>
</head>

<body>

    @php
    $fechaActa = !empty($fecha) ? \Carbon\Carbon::parse($fecha)->format('d/m/Y') : 'N/A';
    @endphp

    <div class="title">
        SECRETARÍA MUNICIPAL ADMINISTRATIVA FINANCIERA <br>
        DIRECCIÓN FINANCIERA SMAF
    </div>

    <div class="subtitle">
        <strong>ACTA DE ENTREGA - RECEPCIÓN DE DOCUMENTO FÍSICO Y DIGITAL DE PAGO ELECTRÓNICO A LA Unidad
            DE DESPACHO DE SAMF. EL SERVIDOR QUE ACEPTA ASUME LA RESPONSABILIDAD DE LA MISMA
        </strong><br>
        Acta Nº: {{ $actaNumero ?? 'N/A' }} | Fecha: {{ $fechaActa }}
    </div>

    <div class="section">
        <div class="section-title">Registros</div>

        @if($todosPreventivos->isEmpty())
        <div class="no-records">No hay preventivos para la fecha seleccionada.</div>
        @else
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
                @foreach($todosPreventivos as $preventivo)
                <tr>
                    <td>{{ $preventivo->numero_preventivo }}</td>
                    <td>{{ $preventivo->empresa }}</td>
                    <td>{{ $preventivo->descripcion_gasto }}</td>
                    <td style="text-align:right">{{ number_format($preventivo->total_pago, 2, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align:right; font-weight:bold;">TOTAL</td>
                    <td style="text-align:right; font-weight:bold;">
                        {{ number_format($todosPreventivos->sum('total_pago'), 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        @endif

    </div>
    {{-- FIRMAS --}}
    <div style="text-align: center; margin-top: 40px;">
        <table class="signatures" style="margin: 0 auto; border-collapse: collapse; text-align: center;">
            <tr>
                <td style="padding: 20px;">
                    <p>__________________________</p>
                    <p><strong>ENTREGUÉ CONFORME</strong></p>
                    <p>Nombre:</p>
                    <p>Cargo:</p>
                </td>
                <td style="padding: 20px;">
                    <p>__________________________</p>
                    <p><strong>RECIBÍ CONFORME</strong></p>
                    <p>Nombre:</p>
                    <p>Cargo:</p>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>