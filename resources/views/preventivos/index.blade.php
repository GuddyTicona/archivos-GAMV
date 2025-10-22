@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Listado de Preventivos</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Entidad</th>
                    <th>N° Preventivo</th>
                    <th>Total Pago</th>
                    <th>Descripción</th>
                    <th>Empresa</th>
                    <th>Beneficiario</th>
                    <th>Fecha Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($preventivos as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->financiera->entidad ?? 'Sin financiera' }}</td>
                    <td>{{ $p->numero_preventivo }}</td>
                    <td>{{ number_format($p->total_pago, 3) }}</td>
                    <td>{{ $p->descripcion_gasto }}</td>
                    <td>{{ $p->empresa }}</td>
                    <td>{{ $p->beneficiario }}</td>
                    <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-3">
        {!! $preventivos->links() !!}
    </div>
</div>
@endsection
