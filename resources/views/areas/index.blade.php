@extends('layouts.admin')

@section('content')
<div class="container my-5">
    
            {{-- Mensaje de sesión --}}
            @if(session('mensaje'))
                <script>
                    Swal.fire({
                        title: "Felicidades",
                        text: "{{ session('mensaje') }}",
                        icon: "success"
                    });
                </script>
            @endif

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">SMAF - Financiera </h4>
                <a href="{{ route('areas.create') }}" class="btn btn-sm"
                    style="background-color: #ffffff; color: #0d6efd; border: 1px solid #ffffff;">
                    <i class="fas fa-plus"></i> Nueva Área
                </a>

            </div>
        </div>


        <div class="card-body">
           

            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 50px;">Nro</th>
                            <th style="width: 60px;">Área</th>
                            <th style="width: 70px;">Descripción</th>
                            <th style="width: 150px;">Actas </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($areas as $area)
                        <tr>
                            <td class="text-center">{{ $area->id }}</td>
                            <td>{{ $area->nombre }}</td>
                            <td>{{ $area->descripcion }}</td>
                            <td class="text-center">
                                <a href="{{ route('areas.show', $area->id) }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-folder-open"></i> Ver registros 
                                </a>
                                <!--<a href="{{ route('areas.generarReporte', $area->id) }}" class="btn btn-outline-dark btn-sm">
                                    <i class="fa fa-file-pdf"></i> Generar Reporte
                                </a>-->

                                 <!--<form action="{{ route('areas.destroy', $area->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Está seguro de eliminar esta área?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>-->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                No existen áreas registradas actualmente.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        @if($areas instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="card-footer text-center">
            {{ $areas->links() }}
        </div>
        @endif
    </div>

</div>
@endsection