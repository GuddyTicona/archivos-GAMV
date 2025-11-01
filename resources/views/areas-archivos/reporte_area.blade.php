<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Área - Documentos Financieros</title>
    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 12px;
        margin: 20px;
    }

    .title {
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 5px;
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

    .signatures {
        margin-top: 40px;
        width: 100%;
        text-align: center;
    }

    .signatures td {
        width: 50%;
        padding-top: 30px;
        border: none;
    }

    .signatures p {
        margin: 4px 0;
    }
    </style>
</head>

<body>

    <div class="title">
        SECRETARÍA MUNICIPAL ADMINISTRATIVA FINANCIERA <br>
        DIRECCIÓN FINANCIERA
    </div>

    <div class="subtitle">
        <strong>ACTA DE ENTREGA - RECEPCIÓN DE DOCUMENTO FÍSICO Y DIGITAL DE PAGO ELECTRÓNICO A LA Unidad
        DE ARCHIVOS DE TESORERIA. EL SERVIDOR QUE ACEPTA ASUME LA RESPONSABILIDAD DE LA MISMA</strong><br>
        Área: {{ $areaArchivo->nombre ?? 'Sin área' }} <br>
        Acta Nº: {{ $actaNumero ?? 'N/A'}} | Fecha: {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}
    </div>

    {{-- PREVENTIVOS --}}
    <div class="section">
        <div class="section-title">Registro tesoreria</div>

        @if($todosPreventivos->isEmpty())
            <div class="no-records">No hay preventivos registrados para esta área.</div>
        @else

        @php
            $prevHoja = null;
            $prevFoja = null;
        @endphp

        <table class="table">
            <thead>
                <tr>
                    <th>Hoja Ruta</th>
                    <th>Número Foja</th>
                    <th>N° Preventivo</th>
                    <th>N° Secuencia</th>
                    <th>Empresa</th>
                    <th>Beneficiario</th>
                    <th>Descripción Gasto</th>
                    <th>Total Pago (Bs)</th>
                </tr>
            </thead>
            <tbody>
               @foreach($todosPreventivos as $preventivo)

                @php
                    $mostrarHoja = $preventivo->numero_hoja_ruta != $prevHoja;
                    $mostrarFoja = $preventivo->numero_foja != $prevFoja;
                    $prevHoja = $preventivo->numero_hoja_ruta;
                    $prevFoja = $preventivo->numero_foja;
                @endphp

                <tr>
                    <td>{{ $mostrarHoja ? $preventivo->numero_hoja_ruta : '' }}</td>
                    <td>{{ $mostrarFoja ? $preventivo->numero_foja : '' }}</td>
                    <td>{{ $preventivo->numero_preventivo }}</td>
                    <td>{{ $preventivo->numero_secuencia }}</td>
                    <td>{{ $preventivo->empresa }}</td>
                    <td>{{ $preventivo->beneficiario }}</td>
                    <td>{{ $preventivo->descripcion_gasto }}</td>
                    <td style="text-align:right">{{ number_format($preventivo->total_pago, 2, ',', '.') }}</td>
                </tr>
               @endforeach

                <tr>
                    <td colspan="7" style="text-align:right; font-weight:bold;">TOTAL</td>
                    <td style="text-align:right; font-weight:bold;">
                         {{ number_format($todosPreventivos->sum('total_pago'), 2, ',', '.') }}
                    </td>
                </tr>

            </tbody>
        </table>
        @endif
    </div>

    {{-- FIRMAS --}}
    <table class="signatures">
        <tr>
            <td>
                <p>__________________________</p>
                <p><strong>ENTREGUÉ CONFORME</strong></p>
                <p>Nombre:</p>
                <p>Cargo:</p>
            </td>
            <td>
                <p>__________________________</p>
                <p><strong>RECIBÍ CONFORME</strong></p>
                <p>Nombre:</p>
                <p>Cargo:</p>
            </td>
        </tr>
    </table>

</body>
</html>
