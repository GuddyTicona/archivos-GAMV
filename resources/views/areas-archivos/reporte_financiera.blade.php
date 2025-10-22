<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Financiera</title>
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

    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 10px;
    }

    .form-item label {
        font-weight: bold;
        display: block;
        margin-bottom: 3px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    .value-box {
        border: 1px solid #000;
        padding: 6px;
        min-height: 22px;
        border-radius: 4px;
        background-color: #f8f9fa;
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
        margin-top: 50px;
        display: flex;
        justify-content: space-between;
    }

    .signature-box {
        text-align: center;
        width: 45%;
    }

    .signature-line {
        margin-top: 50px;
        border-top: 1px solid #000;
        width: 80%;
        margin: 0 auto;
    }
    </style>
</head>

<body>

    {{-- 🔹 ENCABEZADO --}}
    <div class="title">
        SECRETARÍA MUNICIPAL ADMINISTRATIVA FINANCIERA <br>
        DIRECCIÓN FINANCIERA
    </div>

    <div class="subtitle">
        <strong>ACTA DE ENTREGA - RECEPCIÓN DE DOCUMENTO FÍSICO Y DIGITAL DE PAGO ELECTRÓNICO</strong><br>
        Acta Nº: {{ $actaNumero }} | Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
    </div>

    {{-- 🔹 INFORMACIÓN GENERAL --}}
    <div class="section">
        <div class="section-title">Información General</div>
        <table style="width:100%; border-collapse: collapse; margin-bottom:15px;">
            <tr>
                <td style="width:50%; padding:6px; border:1px solid #000; vertical-align: top;">
                    <div style="font-weight:bold; text-transform:uppercase; margin-bottom:2px;">Entidad</div>
                    <div style="padding:4px;">{{ $financiera->entidad }}</div>
                </td>
                <td style="width:50%; padding:6px; border:1px solid #000; vertical-align: top;">
                    <div style="font-weight:bold; text-transform:uppercase; margin-bottom:2px;">Unidad</div>
                    <div style="padding:4px;">{{ $financiera->unidad->nombre_unidad ?? 'No asignada' }}</div>
                </td>
            </tr>
            <tr>
                <td style="padding:6px; border:1px solid #000; vertical-align: top;">
                    <div style="font-weight:bold; text-transform:uppercase; margin-bottom:2px;">Área</div>
                    <div style="padding:4px;">{{ $financiera->areaArchivo->nombre ?? '' }}</div>
                </td>
                <td style="padding:6px; border:1px solid #000; vertical-align: top;">
                    <div style="font-weight:bold; text-transform:uppercase; margin-bottom:2px;">Tipo Documento</div>
                    <div style="padding:4px;">{{ $financiera->tipo_documento }}</div>
                </td>
            </tr>
            <tr>
                <td style="padding:6px; border:1px solid #000; vertical-align: top;">
                    <div style="font-weight:bold; text-transform:uppercase; margin-bottom:2px;">Tipo Ejecución</div>
                    <div style="padding:4px;">{{ $financiera->tipo_ejecucion }}</div>
                </td>
                <td style="padding:6px; border:1px solid #000; vertical-align: top;">
                    <div style="font-weight:bold; text-transform:uppercase; margin-bottom:2px;">Fecha Documento</div>
                    <div style="padding:4px;">{{ \Carbon\Carbon::parse($financiera->fecha_documento)->format('d/m/Y') }}
                    </div>
                </td>

            </tr>
            <tr>
                <td style="padding:6px; border:1px solid #000; vertical-align: top;">
                    <div style="font-weight:bold; text-transform:uppercase; margin-bottom:2px;">Hoja de Ruta</div>
                    <div style=" padding:4px; border-radius:3px;">{{ $financiera->numero_hoja_ruta }}</div>
                </td>
                <td style="padding:6px; border:1px solid #000; vertical-align: top;">

                    <div style="font-weight:bold; text-transform:uppercase; margin-bottom:2px;">Número Foja</div>
                    <div style=" padding:4px; border-radius:3px;">{{ $financiera->numero_foja }}</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- 🔹 PREVENTIVOS --}}
    <div class="section">
        <div class="section-title">Preventivos</div>
        <table class="table">
            <thead>
                <tr>
                    <th>N° Preventivo</th>
                    <th>Secuencia</th>
                    <th>Beneficiario</th>
                    <th>Descripción Gasto</th>
                    <th>Total Pago (Bs)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($financiera->preventivos as $preventivo)
                <tr>
                    <td>{{ $preventivo->numero_preventivo }}</td>
                    <td>{{ $preventivo->numero_secuencia }}</td>
                    <td>{{ $preventivo->beneficiario ?? 'No asignado' }}</td>
                    <td>{{ $preventivo->descripcion_gasto }}</td>
                    <td style="text-align:right">{{ number_format($preventivo->total_pago, 2, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align:right; font-weight:bold;">TOTAL</td>
                    <td style="text-align:right; font-weight:bold;">
                        {{ number_format($financiera->preventivos->sum('total_pago'), 2, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- 🔹 SEGUIMIENTO --}}
    <div class="section">
        <div class="section-title">Seguimiento Administrativo</div>
        <div class="grid">
            <div class="form-item">
                <label>Estado Administrativo</label>
                <div class="value-box">{{ ucfirst($financiera->estado_administrativo) }}</div>
            </div>
            <div class="form-item">
                <label>Última Actualización</label>
                <div class="value-box">
                    {{ $financiera->updated_at ? $financiera->updated_at->timezone('America/La_Paz')->format('d/m/Y H:i') : '' }}
                </div>
            </div>
        </div>
    </div>

    {{-- 🔹 FIRMAS --}}
    <div style="margin-top: 60px;">
        <table style="width: 100%; text-align: center; border: none;">
            <tr>
                <td style="width: 50%; border: none;">
                    <p>__________________________</p>
                    <p><strong>ENTREGUÉ CONFORME</strong></p>
                    <p>Nombre:</p>
                    <p>Cargo:</p>
                </td>
                <td style="width: 50%; border: none;">
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