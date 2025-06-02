@extends('layouts.app') 
  
@section('content') 
<div class="container"> 
    <div class="row"> 
        <div class="col-md-12 mt-4"> 
            <div class="card card-default"> 
                <h4 class="card-heading text-center mt-4">Configurar Google Authenticator</h4> 
   
                <div class="card-body" style="text-align: center;"> 
                    <p>Configure su autenticación de dos factores escaneando el código QR con Google Authenticator. También puede usar el código <strong>{{ $secret }}</strong></p> 
                    <div> 
                        {!! $QR_Image !!} 
                    </div> 
                    <p>Debe configurar su aplicación Google Authenticator antes de continuar. De lo contrario no podrá iniciar sesión.</p> 
                    <form method="POST" action="{{ route('complete.registration') }}"> 
                        @csrf 
                        <button type="submit" class="btn btn-primary mt-3">Continuar</button> 
                    </form> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection