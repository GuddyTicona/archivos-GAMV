@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1>Editar Usuario</h1><br>

    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label>Roles</label>
                            <select name="roles[]" class="form-control" multiple required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" @if($user->roles->pluck('name')->contains($role->name)) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
