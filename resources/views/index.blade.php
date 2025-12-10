@extends('layouts.admin')


@section('content')

<style>
:root {
    --primary: #003366;
    --secondary: #0c0c0cff;
    --surface: #ffffff;
    --background: #f4f6f9;
    --muted: #6b7280;
}

body {
    background-color: var(--background);
    font-family: "Poppins", sans-serif;
}

.container {
    max-width: 1350px;
}

/* ---------- TARJETAS ---------- */
.card {
    border: none;
    border-radius: 18px;
    background: var(--surface);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 300px;
    position: relative;
    overflow: hidden;
    text-align: center;
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.icon-box {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 32px;
    margin: 0 auto 10px;
}

.stat-label {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--primary);
}

.stat-desc {
    color: var(--muted);
    font-size: 0.85rem;
}

.count-number {
    font-size: 2.3rem;
    font-weight: 800;
    color: var(--secondary);
    margin: 8px 0;
}

.btn-details {
    border-radius: 8px;
    padding: 0.4rem 1rem;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--primary);
    border: 2px solid var(--primary);
    background: transparent;
    transition: 0.3s;
}

.btn-details:hover {
    background: var(--primary);
    color: #fff;
}

/* ---------- SECCIONES ---------- */
.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 1.2rem;
    border-left: 6px solid var(--secondary);
    padding-left: 10px;
}

.map-container {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
}
</style>

<div class="container py-5">
    <!-- TARJETAS -->
    <div class="row g-4">
        @php
        $cards = [
            ['label'=>'Unidades','count'=>count($unidades),'desc'=>'Cantidad total de unidades registradas','icon'=>'bi-building','color'=>'#003366','url'=>'unidades'],
            ['label'=>'Archivos','count'=>count($archivos),'desc'=>'Documentos disponibles','icon'=>'bi-file-earmark-text','color'=>'#b71c1c','url'=>'archivos'],
            ['label'=>'Categorías','count'=>count($categorias),'desc'=>'Clasificación de documentos','icon'=>'bi-folder2','color'=>'#ffb300','url'=>'categorias'],
            ['label'=>'Financiera SMAF','count'=>count($financierasSmaf ?? []),'desc'=>'Registros del sistema SMAF','icon'=>'bi-cash-stack','color'=>'#00695c','url'=>'financiera/smaf'],
            ['label'=>'Financiera Despacho','count'=>count($financierasDespacho ?? []),'desc'=>'Registros de Despacho','icon'=>'bi-person-badge','color'=>'#1565c0','url'=>'financiera/despacho'],
            ['label'=>'Financiera Tesorería','count'=>count($financierasTesoreria ?? []),'desc'=>'Registros de Tesorería','icon'=>'bi-bank','color'=>'#4a148c','url'=>'financiera/tesoreria'],
            ['label'=>'Financiera Archivos','count'=>count($financierasArchivos ?? []),'desc'=>'Registros archivados','icon'=>'bi-archive','color'=>'#795548','url'=>'financiera/archivos'],
            ['label'=>'Historial Archivos','count'=>count($historialArchivos),'desc'=>'Cambios y modificaciones','icon'=>'bi-clock-history','color'=>'#607d8b','url'=>'historial-archivo'],
            ['label'=>'Usuarios','count'=>count($usuarios),'desc'=>'Usuarios con acceso al sistema','icon'=>'bi-people','color'=>'#9e9d24','url'=>'usuarios'],
        ];
        @endphp

        @foreach($cards as $card)
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="icon-box" style="background: {{ $card['color'] }}">
                        <i class="bi {{ $card['icon'] }}"></i>
                    </div>
                    <div class="stat-label">{{ $card['label'] }}</div>
                    <div class="stat-desc">{{ $card['desc'] }}</div>
                    <div class="count-number">{{ $card['count'] }}</div>
                    <div class="mt-2">
                        <a href="{{ url($card['url']) }}" class="btn btn-details">
                            Ver registros
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- GRÁFICO -->
     @role('administrador')
    <div class="mt-5">
        <h5 class="section-title">
            <i class="bi bi-bar-chart-fill text-danger me-2"></i>Resumen General de Datos
        </h5>
        <canvas id="graficoResumen" height="120"></canvas>
    </div>
    @endrole

   <!-- MAPA -->
<div class="mt-5 mb-5">
    <h5 class="section-title">
        <i class="bi bi-geo-alt-fill text-danger me-2"></i>
        Ubicación de la Alcaldía Municipal de Viacha
    </h5>
    <div class="map-container mt-3" style="height: 450px;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3822.4576916871947!2d-68.30454602597409!3d-16.65396474470572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915eda909b20328b%3A0x6e5d2987744f6f7b!2sGobierno%20Aut%C3%B3nomo%20Municipal%20de%20Viacha!5e0!3m2!1ses-419!2sbo!4v1748968795566!5m2!1ses-419!2sbo"
            width="100%"
            height="100%"
            style="border:0; border-radius:16px;"
            allowfullscreen=""
            aria-hidden="false"
            tabindex="0">
        </iframe>
    </div>
</div>

</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('graficoResumen');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Unidades', 'Archivos', 'Categorías',
                'SMAF', 'Despacho', 'Tesorería',
                'Archivos Financieros', 'Historial', 'Usuarios'
            ],
            datasets: [{
                label: 'Cantidad',
                data: [
                    {{ count($unidades) }},
                    {{ count($archivos) }},
                    {{ count($categorias) }},
                    {{ count($financierasSmaf ?? []) }},
                    {{ count($financierasDespacho ?? []) }},
                    {{ count($financierasTesoreria ?? []) }},
                    {{ count($financierasArchivos ?? []) }},
                    {{ count($historialArchivos) }},
                    {{ count($usuarios) }}
                ],
                backgroundColor: [
                    '#003366', '#b71c1c', '#ffb300',
                    '#00695c', '#1565c0', '#4a148c',
                    '#795548', '#607d8b', '#9e9d24'
                ],
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#003366',
                    titleColor: '#fff',
                    bodyColor: '#fff'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#333' }
                },
                x: {
                    ticks: { color: '#333' }
                }
            }
        }
    });
});
</script>
@endsection
