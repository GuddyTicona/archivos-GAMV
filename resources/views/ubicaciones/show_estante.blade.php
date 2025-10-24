@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- 🔹 Tabla de ubicaciones --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <h5 class="fw-bold text-center text-secondary mb-3">
                Ubicaciones Financieras — Estante {{ $estante }}
            </h5>

            <a href="{{ route('ubicaciones.index') }}" class="btn btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Volver
            </a>

            <form action="{{ route('ubicaciones.show_estante', $estante) }}" method="GET" class="d-flex mb-3">
                <input type="text" name="search" class="form-control form-control-sm me-2"
                    placeholder="Buscar fila, columna o código" value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-search"></i></button>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Nro</th>
                            <th>Fila</th>
                            <th>Columna</th>
                            <th>Ubicación</th>
                            <th>Archivos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ubicaciones as $index => $ubic)
                        <tr>
                            {{-- Numeración compatible con paginación --}}
                            <td class="text-center">
                                {{ ($ubicaciones->currentPage() - 1) * $ubicaciones->perPage() + $loop->iteration }}
                            </td>

                            <td class="text-center">{{ $ubic->fila }}</td>
                            <td class="text-center">{{ $ubic->columna }}</td>
                            <td class="text-center">{{ $ubic->estante }}{{ $ubic->fila }}-{{ $ubic->columna }}</td>

                            {{-- 🔹 Archivos --}}
                            <td class="text-center">
                                @forelse($ubic->financieras as $item)
                                <div class="mb-1">
                                    {{ $item->codigo }} - {{ $item->created_at->format('d/m/Y') }}
                                </div>
                                @empty
                                <span class="text-muted">0 archivos</span>
                                @endforelse
                            </td>

                            {{--  Acciones --}}
                            <td class="text-center">
                                @forelse($ubic->financieras as $item)
                                <div class="d-flex justify-content-center align-items-center flex-wrap gap-2">

                                    {{-- Botón Ver --}}
                                    <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalArchivo{{ $item->id }}">
                                        <i class="bi bi-eye"></i> Ver detalles
                                    </button>

                                    @php
                                    $prestamoActivo = $item->prestamos()->whereNull('fecha_devolucion')->first();
                                    @endphp

                                    @if(!$prestamoActivo)
                                    {{-- Botón Prestar --}}
                                    <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#prestamoArchivo{{ $item->id }}">
                                        <i class="bi bi-box-arrow-in-down"></i> Prestar
                                    </button>
                                    @else
                                    {{-- Badge separado --}}
                                    <span class="badge bg-danger mx-2">Actualmente prestado</span>
                                    @endif

                                    {{-- Botón Eliminar ubicación --}}
                                    <form action="{{ route('ubicaciones.destroy', $ubic->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar esta ubicación?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>

                                </div>
                                @empty
                                <span class="text-muted">0 archivos</span>
                                @endforelse
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No se encontraron ubicaciones</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 🔹 Paginación (preserva parámetros de búsqueda) --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $ubicaciones->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
            </div>

        </div>
    </div>
</div>

{{--  MODALES: los imprimimos fuera de la tabla para no romper la estructura --}}
@foreach($ubicaciones as $ubic)
@foreach($ubic->financieras as $item)
{{-- Modal Préstamo --}}
<div class="modal fade" id="prestamoArchivo{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Préstamo del Archivo — {{ $item->codigo }}</h5>

            </div>
            <form action="{{ route('prestamos.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="financiera_id" value="{{ $item->id }}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Solicitante</label>
                            <input type="text" name="solicitante" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cargo / Departamento</label>
                            <input type="text" name="cargo_departamento" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha de Préstamo</label>
                            <input type="date" name="fecha_prestamo" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Motivo del Préstamo</label>
                            <textarea name="motivo_prestamo" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success btn-sm">Registrar Préstamo</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Detalle Archivo --}}
<div class="modal fade" id="modalArchivo{{ $item->id }}" tabindex="-1"
    aria-labelledby="modalArchivoLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalArchivoLabel{{ $item->id }}">Detalle del Archivo — {{ $item->codigo }}
                </h5>

            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Entidad</label>
                            <input type="text" class="form-control" value="{{ $item->entidad }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Unidad</label>
                            <input type="text" class="form-control" value="{{ $item->unidad->nombre_unidad ?? 'N/D' }}"
                                disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tipo Documento</label>
                            <input type="text" class="form-control" value="{{ $item->tipo_documento }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Fecha Documento</label>
                            <input type="text" class="form-control" value="{{ $item->fecha_documento }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Hoja Ruta</label>
                            <input type="text" class="form-control" value="{{ $item->numero_hoja_ruta }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">N° Foja</label>
                            <input type="text" class="form-control" value="{{ $item->numero_foja }}" disabled>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Ubicación</label>
                            <input type="text" class="form-control"
                                value="Estante {{ $ubic->estante }} — Fila {{ $ubic->fila }} — Columna {{ $ubic->columna }}"
                                disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Documento adjunto</label>
                            <input type="text" class="form-control" value="{{ $item->documento_adjunto }}" readonly>
                        </div>

                        {{-- Documento adjunto --}}
                        <div class="col-12 mt-2">
                            @if($item->documento_adjunto)
                            <label class="form-label">Documento Adjunto</label>
                            <div>
                                <a href="{{ asset('storage/' . $item->documento_adjunto) }}" target="_blank"
                                    class="btn btn-outline-primary btn-sm">
                                    Ver / Descargar
                                </a>
                            </div>
                            @else
                            <span class="text-muted">No hay documento adjunto</span>
                            @endif
                        </div>

                        <hr>
                        <h6 class="fw-bold text-primary">Preventivos</h6>
                        @forelse($item->preventivos as $preventivo)
                        <div class="border rounded p-3 mb-2 bg-light">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">N° Preventivo</label>
                                    <input type="text" class="form-control" value="{{ $preventivo->numero_preventivo }}"
                                        disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">N° Secuencia</label>
                                    <input type="text" class="form-control" value="{{ $preventivo->numero_secuencia }}"
                                        disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Empresa</label>
                                    <input type="text" class="form-control" value="{{ $preventivo->empresa ?? 'N/D' }}"
                                        disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Beneficiario</label>
                                    <input type="text" class="form-control" value="{{ $preventivo->beneficiario }}"
                                        disabled>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">Descripción</label>
                                    <textarea class="form-control" rows="2"
                                        disabled>{{ $preventivo->descripcion_gasto ?? 'N/D' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Total</label>
                                    <input type="text" class="form-control"
                                        value="{{ number_format($preventivo->total_pago, 2) }} Bs" disabled>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted">No hay preventivos registrados.</p>
                        @endforelse

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endforeach

@endsection