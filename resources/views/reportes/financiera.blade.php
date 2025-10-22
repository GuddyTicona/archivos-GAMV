<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Financiera</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 20px; }
        .title { text-align: center; font-weight: bold; text-transform: uppercase; margin-bottom: 10px; }
        .subtitle { text-align: center; font-size: 12px; margin-bottom: 15px; }
        .section { margin-bottom: 20px; }
        .section-title { font-weight: bold; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; border-bottom: 1px solid #000; padding-bottom: 3px; }
        .form-item { margin-bottom: 10px; }
        .form-item label { font-weight: bold; display:block; margin-bottom:3px; }
        .value-box { border: 1px solid #000; padding:6px; min-height:22px; border-radius:4px; }
        .table { width:100%; border-collapse: collapse; margin-top:8px; }
        .table th, .table td { border:1px solid #000; padding:6px; font-size:12px; }
        .table th { background-color:#f2f2f2; text-align:center; }
        .signatures { margin-top:50px; display:flex; justify-content:space-between; }
        .signature-box { text-align:center; width:45%; }
        .signature-line { margin-top:50px; border-top:1px solid #000; width:80%; margin:0 auto; }
    </style>
</head>
<body>

    <div class="title">
        SECRETARÍA MUNICIPAL ADMINISTRATIVA FINANCIERA <br>
        DIRECCIÓN FINANCIERA
    </div>

    <div class="subtitle">
        <strong>ACTA DE ENTREGA - RECEPCIÓN DE DOCUMENTO FÍSICO Y DIGITAL DE PAGO ELECTRÓNICO</strong><br>
        A partir de esta entrega - recepción, el servidor que acepta la documentación asume la responsabilidad.
    </div>

    <div class="section">
        <div class="form-item">
            <label>FECHA:</label>
            <div class="value-box">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
        </div>
        <div class="form-item">
            <label>ACTA Nº:</label>
            <div class="value-box">{{ $financiera->id }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Información General</div>
        <div class="form-item">
            <label>ENTIDAD:</label>
            <div class="value-box">{{ $financiera->entidad }}</div>
        </div>
        <div class="form-item">
            <label>UNIDAD:</label>
            <div class="value-box">{{ $financiera->unidad->nombre_unidad ?? '' }}</div>
        </div>
        <div class="form-item">
            <label>ÁREA:</label>
            <div class="value-box">{{ $financiera->areaArchivo->nombre ?? '' }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Documento</div>
        <div class="form-item">
            <label>TIPO DOCUMENTO:</label>
            <div class="value-box">{{ $financiera->tipo_documento }}</div>
        </div>
        <div class="form-item">
            <label>TIPO EJECUCIÓN:</label>
            <div class="value-box">{{ $financiera->tipo_ejecucion }}</div>
        </div>
        <div class="form-item">
            <label>FECHA DOCUMENTO:</label>
            <div class="value-box">{{ \Carbon\Carbon::parse($financiera->fecha_documento)->format('d/m/Y') }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Preventivos</div>
        <table class="table">
            <thead>
                <tr>
                    <th>N° Preventivo</th>
                    <th>Secuencia</th>
                    <th>Descripción Gasto</th>
                    <th>Total Pago (Bs)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($financiera->preventivos as $preventivo)
                <tr>
                    <td>{{ $preventivo->numero_preventivo }}</td>
                    <td>{{ $preventivo->numero_secuencia }}</td>
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

    <div class="section">
        <div class="section-title">Seguimiento Administrativo</div>
        <div class="form-item">
            <label>ESTADO:</label>
            <div class="value-box">{{ ucfirst($financiera->estado_administrativo) }}</div>
        </div>
        <div class="form-item">
            <label>FECHA ACTUALIZACIÓN:</label>
            <div class="value-box">{{ $financiera->updated_at ? $financiera->updated_at->format('d/m/Y H:i') : '' }}</div>
        </div>
    </div>

    <div class="signatures">
        <div class="signature-box">
            <div class="signature-line"></div>
            <div>ENTREGUÉ CONFORME</div>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <div>RECIBÍ CONFORME</div>
        </div>
    </div>

</body>
</html>
