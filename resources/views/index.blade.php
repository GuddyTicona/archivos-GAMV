@extends('layouts.admin')

@section('content')

<style>
:root {
    --primary: #003366;
    --secondary: #0c0c0cff;
    --surface: #ffffff;
    --background: #f4f6f9;
    --muted: #6b7280;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
}

body {
    background-color: var(--background);
    font-family: "Inter", "Poppins", sans-serif;
}

.container {
    max-width: 1400px;
}

/* ---------- BANNER ---------- */
.welcome-banner {
    background: linear-gradient(135deg, #003366 0%, #1565c0 100%);
    color: white;
    padding: 2rem;
    border-radius: 16px;
    margin-bottom: 2rem;
    box-shadow: 0 8px 20px rgba(0, 51, 102, 0.15);
}

.welcome-banner h2 {
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
}

.welcome-banner p {
    font-size: 1rem;
    opacity: 0.9;
}

.role-badge {
    display: inline-block;
    padding: 0.4rem 1rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    margin-right: 0.5rem;
}

/* ---------- SECCIÓN ---------- */
.section-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 1.5rem;
    padding-left: 1rem;
    border-left: 5px solid var(--primary);
    display: flex;
    align-items: center;
}

/* ---------- TARJETAS ---------- */
.card {
    border: none;
    border-radius: 16px;
    background: var(--surface);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 280px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
}

.card-body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    flex: 1;
}

.icon-wrapper {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--primary) 0%, #1565c0 100%);
}

.icon-wrapper i {
    font-size: 28px;
    color: white;
}

.stat-label {
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.3rem;
}

.count-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary);
    margin: 0.5rem 0;
    line-height: 1;
}

.stat-desc {
    color: var(--muted);
    font-size: 0.85rem;
    margin-bottom: 1.2rem;
    flex-grow: 1;
}

.btn-details {
    border-radius: 10px;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--primary);
    border: 2px solid var(--primary);
    background: transparent;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}

.btn-details:hover {
    background: var(--primary);
    color: #fff;
    transform: translateY(-1px);
}


.chart-container h5 {
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    font-size: 1.1rem;
}

.chart-container h5 i {
    margin-right: 0.5rem;
}

/* ---------- MAPA ---------- */
.map-container {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    height: 400px;
    margin-top: 2rem;
}

.map-container iframe {
    width: 100%;
    height: 100%;
    border: none;
    display: block;
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 768px) {
    .welcome-banner {
        padding: 1.5rem;
        text-align: center;
    }
    
    .welcome-banner h2 {
        font-size: 1.5rem;
    }
    
    .card {
        height: 260px;
    }
    
    .card-body {
        padding: 1.25rem;
    }
    
    .count-number {
        font-size: 2rem;
    }
    
    .map-container {
        height: 300px;
    }
}
</style>

<div class="container py-4">
    @auth
    <!-- BANNER DE BIENVENIDA -->
    <!--<div class="welcome-banner">
      
        <p class="mb-2">Sistema en Gestion de Archivos Financieros</p>
        <div class="roles-container">
            @foreach(Auth::user()->getRoleNames() as $role)
                <span class="role-badge">{{ ucfirst($role) }}</span>
            @endforeach
        </div>
    </div>-->

    {{-- ADMINISTRADOR --}}
    @role('administrador')
    <div class="mb-4">
       
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #003366 0%, #1e88e5 100%);">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="stat-label">Unidades</div>
                        <div class="count-number">{{ count($unidades) }}</div>
                        <div class="stat-desc">Unidades registradas</div>
                        <a href="{{ url('unidades') }}" class="btn btn-details">
                            Ver registros
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #b71c1c 0%, #e53935 100%);">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div class="stat-label">Archivos</div>
                        <div class="count-number">{{ count($archivos) }}</div>
                        <div class="stat-desc">Documentos del sistema</div>
                        <a href="{{ url('archivos') }}" class="btn btn-details">
                            Ver registros
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #ffb300 0%, #ffca28 100%);">
                            <i class="bi bi-folder2"></i>
                        </div>
                        <div class="stat-label">Categorías</div>
                        <div class="count-number">{{ count($categorias) }}</div>
                        <div class="stat-desc">Clasificaciones</div>
                        <a href="{{ url('categorias') }}" class="btn btn-details">
                             Ver registros
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #9e9d24 0%, #cddc39 100%);">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-label">Usuarios</div>
                        <div class="count-number">{{ count($usuarios) }}</div>
                        <div class="stat-desc">Usuarios activos</div>
                        <a href="{{ url('usuarios') }}" class="btn btn-details">
                          Ver registros
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico compacto -->
        <div class="chart-container">
            <h5>
                <i class="bi bi-bar-chart text-primary"></i>
                Resumen de Datos
            </h5>
            <canvas id="graficoResumen" height="80"></canvas>
        </div>
    </div>
    @endrole

    {{-- SMAF --}}
    @role('smaf')
    <div class="mb-4">
    
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #00695c 0%, #26a69a 100%);">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div class="stat-label">Registros</div>
                        <div class="count-number">{{ count($financierasSmaf ?? []) }}</div>
                        <div class="stat-desc">Documentos en SMAF</div>
                        <a href="{{ url('smaf/financieras') }}" class="btn btn-details">
                            <i class="bi bi-gear me-1"></i> Gestionar
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #ffa726 0%, #ffb74d 100%);">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="stat-label">Pendientes</div>
                        <div class="count-number">
                            {{ collect($financierasSmaf ?? [])->where('estado_administrativo', 'pendiente')->count() }}
                        </div>
                        <div class="stat-desc">Por revisar</div>
                        <a href="{{ url('smaf/financieras') }}" class="btn btn-details">
                            Ver registros
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-label">Completados</div>
                        <div class="count-number">
                            {{ collect($financierasSmaf ?? [])->where('enviado_a_despacho', true)->count() }}
                        </div>
                        <div class="stat-desc">Enviados a Despacho</div>
                        <a href="{{ url('areas') }}" class="btn btn-details">
                            <i class="bi bi-file-text me-1"></i> Actas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    {{-- DESPACHO --}}
    @role('despacho')
    <div class="mb-4">
        <h3 class="section-title">
            <i class="bi bi-person-badge me-2"></i>Panel Despacho
        </h3>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #1565c0 0%, #42a5f5 100%);">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div class="stat-label">Registros</div>
                        <div class="count-number">{{ count($financierasDespacho ?? []) }}</div>
                        <div class="stat-desc">Total asignados</div>
                        <a href="{{ url('despacho/financieras') }}" class="btn btn-details">
                            <i class="bi bi-gear me-1"></i> Gestionar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #e53935 0%, #ef5350 100%);">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <div class="stat-label">Por Revisar</div>
                        <div class="count-number">
                            {{ collect($financierasDespacho ?? [])->where('estado_administrativo', 'pendiente')->count() }}
                        </div>
                        <div class="stat-desc">Requieren atención</div>
                        <a href="{{ url('despacho/financieras') }}" class="btn btn-details">
                            Ver registros
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);">
                            <i class="bi bi-send-check"></i>
                        </div>
                        <div class="stat-label">Enviados</div>
                        <div class="count-number">
                            {{ collect($financierasDespacho ?? [])->where('enviado_a_tesoreria', true)->count() }}
                        </div>
                        <div class="stat-desc">A Tesorería</div>
                        <a href="{{ url('areas-despacho') }}" class="btn btn-details">
                            <i class="bi bi-file-text me-1"></i> Actas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    {{-- TESORERÍA --}}
    @role('tesoreria')
    <div class="mb-4">
        <h3 class="section-title">
            <i class="bi bi-bank me-2"></i>Panel Tesorería
        </h3>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #4a148c 0%, #7e57c2 100%);">
                            <i class="bi bi-bank"></i>
                        </div>
                        <div class="stat-label">Registros</div>
                        <div class="count-number">{{ count($financierasTesoreria ?? []) }}</div>
                        <div class="stat-desc">Total recibidos</div>
                        <a href="{{ url('tesoreria/financieras') }}" class="btn btn-details">
                            <i class="bi bi-gear me-1"></i> Gestionar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #795548 0%, #a1887f 100%);">
                            <i class="bi bi-archive"></i>
                        </div>
                        <div class="stat-label">Archivados</div>
                        <div class="count-number">{{ count($financierasArchivos ?? []) }}</div>
                        <div class="stat-desc">Documentos guardados</div>
                        <a href="{{ url('areas-archivos') }}" class="btn btn-details">
                            <i class="bi bi-eye me-1"></i> Ver
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #0277bd 0%, #29b6f6 100%);">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label">Procesando</div>
                        <div class="count-number">
                            {{ collect($financierasTesoreria ?? [])->where('estado_tesoreria', 'recibido')->count() }}
                        </div>
                        <div class="stat-desc">En curso</div>
                        <a href="{{ url('tesoreria/financieras') }}" class="btn btn-details">
                            <i class="bi bi-eye me-1"></i> Ver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    {{-- ARCHIVOS --}}
    @role('archivos')
    <div class="mb-4">
        <h3 class="section-title">
            <i class="bi bi-archive-fill me-2"></i>Panel Archivos
        </h3>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #795548 0%, #a1887f 100%);">
                            <i class="bi bi-archive"></i>
                        </div>
                        <div class="stat-label">Archivos</div>
                        <div class="count-number">{{ count($archivos) }}</div>
                        <div class="stat-desc">Total almacenados</div>
                        <a href="{{ url('archivos') }}" class="btn btn-details">
                            <i class="bi bi-gear me-1"></i> Gestionar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #607d8b 0%, #90a4ae 100%);">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="stat-label">Historial</div>
                        <div class="count-number">{{ count($historialArchivos) }}</div>
                        <div class="stat-desc">Movimientos</div>
                        <a href="{{ url('historial-archivos') }}" class="btn btn-details">
                            <i class="bi bi-eye me-1"></i> Ver
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #00897b 0%, #4db6ac 100%);">
                            <i class="bi bi-box-arrow-in-down"></i>
                        </div>
                        <div class="stat-label">Ubicaciones</div>
                        <div class="count-number">-</div>
                        <div class="stat-desc">Gestión física</div>
                        <a href="{{ url('ubicaciones') }}" class="btn btn-details">
                            <i class="bi bi-eye me-1"></i> Ver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    {{-- ARCHIVO CENTRAL --}}
    @role('central')
    <div class="mb-4">
        <h3 class="section-title">
            <i class="bi bi-building me-2"></i>Panel Archivo Central
        </h3>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #003366 0%, #1e88e5 100%);">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="stat-label">Unidades</div>
                        <div class="count-number">{{ count($unidades) }}</div>
                        <div class="stat-desc">Registradas</div>
                        <a href="{{ url('unidades') }}" class="btn btn-details">
                            <i class="bi bi-gear me-1"></i> Gestionar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #b71c1c 0%, #e53935 100%);">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div class="stat-label">Archivos</div>
                        <div class="count-number">{{ count($archivos) }}</div>
                        <div class="stat-desc">Documentos</div>
                        <a href="{{ url('archivos') }}" class="btn btn-details">
                            <i class="bi bi-eye me-1"></i> Ver
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="icon-wrapper" style="background: linear-gradient(135deg, #ffb300 0%, #ffca28 100%);">
                            <i class="bi bi-folder2"></i>
                        </div>
                        <div class="stat-label">Categorías</div>
                        <div class="count-number">{{ count($categorias) }}</div>
                        <div class="stat-desc">Clasificaciones</div>
                        <a href="{{ url('categorias') }}" class="btn btn-details">
                            <i class="bi bi-eye me-1"></i> Ver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    <!-- MAPA -->
    <div class="mt-4">
        <h5 >
            <i class="bi bi-geo-alt-fill text-danger me-2"></i>
            Ubicación Alcaldía Municipal de Viacha
        </h5>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3822.4576916871947!2d-68.30454602597409!3d-16.65396474470572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915eda909b20328b%3A0x6e5d2987744f6f7b!2sGobierno%20Aut%C3%B3nomo%20Municipal%20de%20Viacha!5e0!3m2!1ses-419!2sbo!4v1748968795566!5m2!1ses-419!2sbo"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
    @endauth
</div>

<!-- SCRIPTS -->
@role('administrador')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('graficoResumen');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Unidades', 'Archivos', 'Categorías',
                    'SMAF', 'Despacho', 'Tesorería',
                    'Archivos Financieros', 'Usuarios'
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
    }
});
</script>
@endrole


@endsection