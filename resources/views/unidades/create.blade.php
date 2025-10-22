@extends('layouts.admin')
@section('content')
<div class="content" style="margin-left: 70px">
    
    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Registro de datos unidad</b></h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card-body" style="display: block;">
                    <form action="{{url('/unidades')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> Nombre unidad</label>
                                    <input type="text" name="nombre_unidad" value="{{old('nombre_unidad')}}"
                                        class="form-control" required>
                                    @error('nombre_unidad')
                                    <small style="color: red;">Este campo debe ser llenado</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Descripcion unidad</label>
                                    <input type="text" name="descripcion" value="{{old('descripcion')}}"
                                        class="form-control" required>
                                    @error('descripcion')
                                    <small style="color: red;">Este campo debe ser llenado</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> Fecha</label>
                                    <input type="date" name="fecha_creacion" value="{{old('fecha_creacion')}}"
                                        class="form-control" required>
                                    @error('fecha_creacion')
                                    <small style="color: red;">Este campo debe ser llenado</small>
                                    @enderror
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
                    </form>

                </div>

            </div>
        </div>
    </div>

</div>




@endsection