<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\FileAssistantController;

// Autenticación
Auth::routes(['register' => true]);

// Rutas protegidas por autenticación

    
    // Ruta principal
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Rutas resource
    Route::resource('/unidades', App\Http\Controllers\UnidadController::class);
    Route::resource('/archivos', App\Http\Controllers\ArchivoController::class)->middleware(middleware:'can:archivos');
    Route::resource('/categorias', App\Http\Controllers\CategoriaController::class);
    Route::resource('/financieras', App\Http\Controllers\FinancieraController::class);
    Route::resource('/historial-archivos', App\Http\Controllers\HistorialArchivoController::class);
    Route::resource('/usuarios', App\Http\Controllers\UserController::class);


//Route::get('/chat', function () {
  //  return view('assistent.chat');
//})->name('chat');
Route::get('/assistant', [FileAssistantController::class, 'index']);
Route::post('/assistant/message', [FileAssistantController::class, 'handleMessage']);




//para email
Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'twofactor']], function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('home');
});


