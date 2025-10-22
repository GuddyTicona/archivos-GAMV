@extends('layouts.admin')

@section('content')
<div class="container my-4">

    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tesoreria - Financiera</h4>
            <a href="{{ route('areas-archivos.create') }}" class="btn btn-sm btn-light text-primary">
                <i class="fas fa-plus"></i> Nueva Área
            </a>
        </div>

        <div class="card-body">
            @if(session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 50px;">Nro</th>
                            <th  style="width: 70px;">Nombre del Área</th>
                            <th  style="width: 90px;">Descripción</th>
                            <th style="width: 150px;">Actas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($areas as $areaArchivo)
                        <tr>
                            <td class="text-center">{{ $areaArchivo->id }}</td>
                            <td>{{ $areaArchivo->nombre }}</td>
                            <td>{{ $areaArchivo->descripcion }}</td>
                            <td class="text-center">
                                <a href="{{ route('areas-archivos.show', $areaArchivo->id) }}"
                                    class="btn btn-outline-info btn-sm">Ver registros</a>
                             <!--   <a href="{{ route('areas-archivos.edit', $areaArchivo->id) }}"
                                    class="btn btn-outline-success btn-sm">Editar</a>-->
                                {{-- Generar reporte de todas las financieras del área --}}
                                <a href="{{ route('financieras.reporte', $areaArchivo->id) }}"
                                    class="btn btn-outline-dark btn-sm">
                                    <i class="bi bi-printer"></i> Generar Reporte
                                </a>




                               <!-- <form action="{{ route('areas-archivos.destroy', $areaArchivo->id) }}" method="POST"
                                    class="d-inline-block"
                                    onsubmit="return confirm('¿Está seguro de eliminar esta área?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                                </form>-->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                No existen áreas de archivos registradas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($areas instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-3 d-flex justify-content-center">
                {{ $areas->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>

</div>
@endsection