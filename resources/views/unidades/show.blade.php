@extends('layouts.admin')
@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Datos de la unidad registrado</h1><br>
    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Datos registrados</b></h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card-body" style="display: block;">
                    
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for=""> Nombre unidad</label>
                                <input type="text" name="nombre_unidad" value="{{$unidad->nombre_unidad}}"class="form-control"disabled>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for=""> Descripcion unidad</label>
                                <input type="text" name="descripcion" value="{{$unidad->descripcion}}" class="form-control"disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for=""> Fecha</label>
                                <input type="date" name="fecha_creacion" value="{{$unidad->fecha_creacion}}"class="form-control"disabled>
                            </div>
                        </div>
<!--  <div class="col-md-3"></div>-->
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                           
                                <button type="submit" class="btn btn-primary">Guardar Registro</button>
                                  <a href="{{ route('unidades.index') }}" class="btn btn-secondary">Volver</a>
                            </div>
                        </div>
                    </div>
                

                </div>

            </div>
        </div>
    </div>

</div>




@endsection