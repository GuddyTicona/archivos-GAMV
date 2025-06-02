@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:70vh;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold">Verificar OTP</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first() }}</strong>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('2fa.verify') }}">
                        @csrf
                        <div class="form-group">
                            <label for="one_time_password">Contraseña de un solo uso (OTP)</label>
                          <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Validar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection