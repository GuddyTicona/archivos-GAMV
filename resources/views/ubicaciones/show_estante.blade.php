@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold text-center text-secondary mb-3">Ubicaciones Financieras — Estante {{ $estante }}</h5>
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
                            <td class="text-center">
                                {{ ($ubicaciones->currentPage() - 1) * $ubicaciones->perPage() + $loop->iteration }}
                            </td>
                            <td class="text-center">{{ $ubic->fila }}</td>
                            <td class="text-center">{{ $ubic->columna }}</td>
                            <td class="text-center">{{ $ubic->estante }}{{ $ubic->fila }}-{{ $ubic->columna }}</td>
                            <td class="text-center">
                                @forelse($ubic->financieras as $item)
                                <div class="mb-1">{{ $item->codigo }} - {{ $item->created_at->format('d/m/Y') }}</div>
                                @empty <span class="text-muted">0 archivos</span>@endforelse
                            </td>
                            <td class="text-center">
                                @forelse($ubic->financieras as $item)
                                <div class="d-flex justify-content-center align-items-center flex-wrap gap-2">
                                    <a href="{{ route('ubicaciones.show_registro', $item->id) }}"
                                        class="btn btn-outline-info btn-sm">
                                        <i class="bi bi-eye"></i> Ver detalles
                                    </a>
                                    @php
                                    $prestamoActivo = $item->prestamos()->whereNull('fecha_devolucion')->first();
                                    @endphp

                                    @if(!$prestamoActivo)
                                    <a href="{{ route('prestamos.create_financiera', $item->id) }}"
                                        class="btn btn-outline-success btn-sm">
                                        <i class="bi bi-box-arrow-in-down"></i> Prestar
                                    </a>
                                    @else
                                    <span class="badge bg-danger mx-2">Actualmente prestado</span>
                                    @endif

                                    <form action="{{ route('ubicaciones.destroy', $ubic->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar esta ubicación?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i>
                                            Eliminar</button>
                                    </form>
                                </div>
                                @empty <span class="text-muted">0 archivos</span> @endforelse
                            </td>
                        </tr>
                        @empty <tr>
                            <td colspan="6" class="text-center text-muted">No se encontraron ubicaciones</td>
                        </tr>@endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $ubicaciones->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection