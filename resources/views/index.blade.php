@extends('layouts.admin')
@include('components.chat')
@section('content')

<style>
    .card:hover {
        transform: scale(1.03);
        transition: all 0.3s ease;
        box-shadow: 0 0 16px rgba(0, 0, 0, 0.15);
    }

    .icon-box {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #fff;
    }

    .text-container {
        flex: 1;               /* Ocupa el espacio restante */
        text-align: center;    /* Centra el texto dentro del espacio */
    }

    .stat-label {
        font-weight: 600;
        font-size: 1.1rem;
        color: #333;
    }

    .stat-desc {
        font-size: 0.9rem;
        color: #666;
    }
</style>

<div class="container py-4">
    
    <div class="row g-4">
        @php
        $cards = [
            [
                'label' => 'UNIDADES',
                'count' => count($unidades),
                'desc' => 'Total de unidades registradas',
                'icon' => 'bi-diagram-3-fill',
                'color' => '#4a90e2',
                'url' => 'unidades'
            ],
            [
                'label' => 'ARCHIVOS',
                'count' => count($archivos),
                'desc' => 'Archivos disponibles en el sistema',
                'icon' => 'bi-folder-fill',
                'color' => '#50e3c2',
                'url' => 'archivos'
            ],
            [
                'label' => 'CATEGORIAS',
                'count' => count($categorias),
                'desc' => 'Categorías de clasificación',
                'icon' => 'bi-tags-fill',
                'color' => '#f5a623',
                'url' => 'categorias'
            ],
            [
                'label' => 'FINANCIERA',
                'count' => count($financieras),
                'desc' => 'Registros financieros gestionados',
                'icon' => 'bi-currency-dollar',
                'color' => '#7ed321',
                'url' => 'financieras'
            ],
            [
                'label' => 'HISTORIAL ARCHIVOS',
                'count' => count($historialArchivos),
                'desc' => 'Modificaciones realizadas en archivos',
                'icon' => 'bi-clock-history',
                'color' => '#bd10e0',
                'url' => 'historial-archivo'
            ],
            [
                'label' => 'USUARIOS',
                'count' => count($usuarios),
                'desc' => 'Usuarios registrados en el sistema',
                'icon' => 'bi-people-fill',
                'color' => '#9b9b9b',
                'url' => 'usuarios'
            ],
        ];
        @endphp

        @foreach($cards as $card)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; background: #fefefe;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3 shadow-sm" style="background-color: {{ $card['color'] }};">
                            <i class="bi {{ $card['icon'] }}"></i>
                        </div>
                        <div class="text-container">
                            <div class="stat-label">{{ $card['label'] }}</div>
                            <div class="stat-desc">{{ $card['desc'] }}</div>
                        </div>
                    </div>
                    <div class="text-center my-3">
                        <h2 class="fw-bold" style="font-size: 2.7rem;">{{ $card['count'] }}</h2>
                    </div>
                    <div class="text-center">
                        <a href="{{ url($card['url']) }}" class="btn btn-outline-primary btn-sm px-3 fw-semibold" style="border-radius: 10px;">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- GRÁFICO -->
    <div class="mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">Resumen General</h5>
                <canvas id="graficoResumen" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- MAPA -->
    <div class="mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">Ubicación de la Alcaldía Municipal de Viacha</h5>
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3822.4576916871947!2d-68.30454602597409!3d-16.65396474470572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915eda909b20328b%3A0x6e5d2987744f6f7b!2sGobierno%20Aut%C3%B3nomo%20Municipal%20de%20Viacha!5e0!3m2!1ses-419!2sbo!4v1748968795566!5m2!1ses-419!2sbo"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('graficoResumen').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Unidades', 'Archivos', 'Categorías', 'Financiera', 'Historial', 'Usuarios'],
        datasets: [{
            label: 'Cantidad',
            data: [
                {{ count($unidades) }},
                {{ count($archivos) }},
                {{ count($categorias) }},
                {{ count($financieras) }},
                {{ count($historialArchivos) }},
                {{ count($usuarios) }}
            ],
            backgroundColor: [
                '#4a90e2', '#50e3c2', '#f5a623', '#7ed321', '#bd10e0', '#9b9b9b'
            ],
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: { enabled: true }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

@endsection
