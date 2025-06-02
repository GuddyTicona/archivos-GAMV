<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request): View
    {
        $usuarios = User::paginate();
         return view('usuarios.index', compact('usuarios'))
        ->with('i', ($request->input('page', 1) - 1) * $usuarios->perPage());
    //   return view('usuarios.index', ['usuarios' => $usuarios]);

    }

    public function create(){
       $usuarios = new User();
        
        return view('usuarios.create', compact('usuarios'));
       
    }
    public function store(UserRequest $request): RedirectResponse 
    {
    $data = $request->validated();
    $data['password'] = Hash::make($request->input('password')); // Encriptar contraseña
    User::create($data);

    return Redirect::route('usuarios.index')
        ->with('Mensaje', 'Usuario creado correctamente.');
    }
    public function show($id){
        $usuarios = User::find($id);

        return view('usuarios.show', compact('usuarios'));
    }
    public function edit($id){
         $usuarios = User::find($id);

        return view('usuarios.edit', compact('usuarios'));
    }
    public function update(UserRequest $request, User $usuarios): RedirectResponse 
    {
    $data = $request->validated();

    // Solo actualiza la contraseña si se proporciona una nueva
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->input('password'));
    } else {
        unset($data['password']); // Si está vacía, no actualices la contraseña
    }

    $usuarios->update($data);

    return Redirect::route('usuarios.index')
        ->with('Mensaje', 'Se actualizó el usuario correctamente.');
    }
    public function destroy($id){
         User::find($id)->delete();

        return Redirect::route('usuarios.index')
            ->with('Mensaje', 'Usuario eliminado correctamente');

    }
}
