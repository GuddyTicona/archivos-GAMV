<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\FinancieraController;
use App\Http\Controllers\FileAssistantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AreaDespachoController;
use App\Http\Controllers\AreaArchivoController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\PrestamoArchivoController;
use App\Http\Controllers\PrestamoArchivocentralController;

// Autenticación
Auth::routes(['register' => true]);

// Verificación por email
Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);

// Rutas públicas protegidas
Route::get('/', [AdminController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Recursos generales
Route::resource('/unidades', App\Http\Controllers\UnidadController::class);
Route::resource('/archivos', App\Http\Controllers\ArchivoController::class);
Route::resource('/categorias', App\Http\Controllers\CategoriaController::class);
Route::resource('/financieras', FinancieraController::class);
Route::resource('/historial-archivos', App\Http\Controllers\HistorialArchivoController::class);
Route::resource('/usuarios', UserController::class);
Route::resource('areas', AreaController::class);

//resorces de las areas
Route::resource('areas-despacho', AreaDespachoController::class);
Route::resource('areas-archivos', AreaArchivoController::class);
Route::resource('ubicaciones', UbicacionController::class);
Route::post('/ubicaciones/generar', [UbicacionController::class, 'generar'])->name('ubicaciones.generar');
// Eliminar todas las ubicaciones del estante
Route::delete('/ubicaciones/eliminar-estante/{estante}', [UbicacionController::class, 'eliminarEstante'])
    ->name('ubicaciones.eliminar_estante');
Route::get('/ubicaciones/estante/{estante}', [UbicacionController::class, 'verEstante'])->name('ubicaciones.ver_estante');
// asignacion de archivos 
Route::get('/ubicaciones/asignar/{archivo}', [UbicacionController::class, 'seleccionarEstante'])
    ->name('ubicaciones.seleccionarEstante');

Route::post('/ubicaciones/asignar/{archivo}', [UbicacionController::class, 'asignarUbicacion'])
    ->name('ubicaciones.asignarUbicacion');
// Asistente virtual
Route::get('/assistant', [FileAssistantController::class, 'index']);
Route::post('/assistant/message', [FileAssistantController::class, 'handleMessage']);
Route::post('/chatbot', [FileAssistantController::class, 'handleMessage'])->name('chatbot');

// Preventivos
Route::get('/preventivos', [App\Http\Controllers\PreventivoController::class, 'index'])->name('preventivos.index');

// Rutas administrativas
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'twofactor']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('home');
});

// Gestión de usuarios por administrador
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/admin/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/admin/usuarios/{user}/asignar-rol', [UserController::class, 'asignarRol'])->name('usuarios.asignarRol');

    // Roles y permisos
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class)->names('permissions');

    Route::get('/admin/permissions/asignar', [PermissionController::class, 'asignarPermisos'])->name('permissions.assign');
    Route::post('/admin/permissions/asignar', [PermissionController::class, 'guardarAsignacion'])->name('permissions.assign');

    Route::get('permissions/modular/{rol}', [PermissionController::class, 'asignarPorModulo'])->name('permissions.modular');
    Route::post('permissions/modular/{rol}', [PermissionController::class, 'guardarPorModulo'])->name('permissions.guardarModulo');
});

// Financieras - rutas generales
Route::get('financieras', [FinancieraController::class, 'index'])->name('financieras.index');
Route::get('financieras/{id}', [FinancieraController::class, 'show'])->name('financieras.show');
Route::delete('financieras/{id}', [FinancieraController::class, 'destroy'])->name('financieras.destroy');
Route::post('financieras/{id}/estado', [FinancieraController::class, 'actualizarEstado'])->name('financieras.actualizarEstado');
Route::get('/areas-archivos/{areaId}/financieras/{financieraId}/reporte', 
    [AreaArchivoController::class, 'reporteFinanciera'])
    ->name('areas-archivos.financiera.reporte');

Route::get('areas-archivos/{id}/reporte', [AreaArchivoController::class, 'generarReporte'])
     ->name('financieras.reporte');

// Ruta para generar PDF de una financiera en Área Despacho
Route::get('/{areaId}/financiera/{financieraId}/reporte', 
        [AreaDespachoController::class, 'reporteFinanciera'])
        ->name('areas-despacho.financiera.reporte');
Route::get('areas-despacho/{id}/reporte', [AreaDespachoController::class, 'generarReporte'])
    ->name('despacho.reporte');


Route::get('/areas/{area}/financieras/{financiera}/reporte', [AreaController::class, 'reporteFinanciera'])
    ->name('areas.financieras.reporte');
//Route::get('/areas/{id}/reporte', [AreaController::class, 'generarReporte'])
   //  ->name('areas.reporte');

Route::get('areas/{area}/reporte/{registro?}', [AreaController::class, 'reporteFinanciera'])
    ->name('areas.reporte_financiera');

// Rutas para áreas
Route::get('/areas/{id}/reporte', [AreaController::class, 'generarReporte'])
     ->name('areas.generarReporte');
     // web.php
// Mostrar formulario de actas despacho
Route::get('areas-despacho/{id}/reporte', [AreaDespachoController::class, 'generarReporte'])
    ->name('areas-despacho.generarReporte');
// routes/web.php
Route::get('areas-archivos/{areaId}/financieras/{financieraId}/reporte', [AreaArchivoController::class, 'generarReporte'])
    ->name('areas-archivos.financiera.reporte');
Route::get('/areas-archivos/{id}/generar-reporte', [AreaArchivoController::class, 'generarReporte'])
    ->name('areas-archivos.generarReporte');



// Estado administrativo financiero (PUT redundante evitado)
Route::put('/financieras/{id}/estado', [FinancieraController::class, 'actualizarEstado'])->name('financieras.estado_administrativo');

// Financieras por área
Route::get('/financieras-area', [FinancieraController::class, 'indexArea'])->name('financieras.area');

// SMAF
//Route::prefix('smaf/financieras')->name('smaf.financieras.')->group(function () {
 //   Route::get('/', [FinancieraController::class, 'indexSmaf'])->name('index');
  //  Route::get('create', [FinancieraController::class, 'create'])->name('create');
  //  Route::get('{financiera}/edit', [FinancieraController::class, 'editSmaf'])->name('edit');
  //  Route::put('{financiera}', [FinancieraController::class, 'updateSmaf'])->name('update');
//});


Route::patch('/financieras/smaf/{financiera}', [FinancieraController::class, 'updateSmaf'])->name('financieras.smaf.update');


Route::prefix('smaf/financieras')->name('smaf.financieras.')->middleware('auth')->group(function () {
    Route::get('/', [FinancieraController::class, 'indexSmaf'])
        ->middleware('permission:smaf.index')
        ->name('index');

    Route::get('create', [FinancieraController::class, 'create'])
        ->middleware('permission:smaf.create')
        ->name('create');

    Route::get('{financiera}/edit', [FinancieraController::class, 'editSmaf'])
        ->middleware('permission:smaf.edit')
        ->name('edit');

    Route::put('{financiera}', [FinancieraController::class, 'updateSmaf'])
        ->middleware('permission:smaf.edit')
        ->name('update');

    Route::delete('{financiera}', [FinancieraController::class, 'destroy'])
        ->middleware('permission:smaf.destroy')
        ->name('destroy');
});


// Despacho
//Route::prefix('despacho/financieras')->name('despacho.financieras.')
  //  ->middleware(['auth', 'permission:despacho.edit'])
  //  ->group(function () {
   //     Route::get('{id}/edit', [FinancieraController::class, 'editDespacho'])->name('edit');
   //     Route::put('{financiera}', [FinancieraController::class, 'updateDespacho'])->name('update');
//});

// DESPACHO
Route::prefix('despacho')->group(function () {
    Route::get('financieras', [FinancieraController::class, 'indexDespacho'])->name('despacho.financieras.index');
    Route::get('financieras/{id}/edit', [FinancieraController::class, 'editDespacho'])->name('despacho.financieras.edit');
    Route::put('financieras/{financiera}', [FinancieraController::class, 'updateDespacho'])->name('despacho.financieras.update');
});
//cambiar el estado para desvolver de despacho a smaf 
Route::put('/financieras/{id}/estado-administrativo', [FinancieraController::class, 'cambiarEstadoAdministrativo'])->name('financieras.estado_administrativo');
//enviar de despacho a tesoreria
Route::put('/despacho/financieras/{id}/enviar', [FinancieraController::class, 'enviarTesoreria'])
    ->name('despacho.financieras.enviar');

//permisos de despacho
Route::prefix('despacho/financieras')->name('despacho.financieras.')->middleware('auth')->group(function () {
    Route::get('/', [FinancieraController::class, 'indexDespacho'])
        ->middleware('permission:despacho.index')
        ->name('index');

    Route::get('{id}/edit', [FinancieraController::class, 'editDespacho'])
        ->middleware('permission:despacho.edit')
        ->name('edit');

    Route::put('{financiera}', [FinancieraController::class, 'updateDespacho'])
        ->middleware('permission:despacho.edit')
        ->name('update');

    Route::delete('{financiera}', [FinancieraController::class, 'destroy'])
        ->middleware('permission:despacho.destroy')
        ->name('destroy');
});


// Vistas individuales SMAF/Despacho (si necesitas mantenerlas por separado)
Route::get('smaf/financieras', [FinancieraController::class, 'indexSmaf'])->name('smaf.financieras.index');
Route::get('despacho/financieras', [FinancieraController::class, 'indexDespacho'])->name('despacho.financieras.index');


//TESORERIA
Route::put('/financieras/{id}/tesoreria', [FinancieraController::class, 'actualizarTesoreria'])->name('financieras.actualizarTesoreria');
// TESORERÍA
Route::get('/tesoreria/financieras', [FinancieraController::class, 'indexTesoreria'])->name('tesoreria.financieras.index');
Route::get('/tesoreria/financieras/{id}/edit', [FinancieraController::class, 'editTesoreria'])->name('tesoreria.financieras.edit');
Route::put('/tesoreria/financieras/{financiera}', [FinancieraController::class, 'updateTesoreria'])->name('tesoreria.financieras.update');
Route::put('/financieras/{id}/actualizar-estado', [FinancieraController::class, 'actualizarEstado'])->name('financieras.actualizarEstado');
// FINANCIERA - Enviar a Archivos
// Enviar un registro a Archivos
Route::put('/financieras/enviar/{id}', [FinancieraController::class, 'enviarArchivo'])->name('financieras.enviar');

// Vista Archivos
// Archivos financieros enviados
Route::get('/archivos-financieras', [FinancieraController::class, 'archivos'])
    ->name('financieras.archivos.index');
Route::get('financieras/archivos/{id}', [FinancieraController::class, 'showArchivos'])
    ->name('financieras.archivos.show');

// ===== ARCHIVOS – TESORERÍA =====
Route::get('/financieras/{id}/edit-archivo', [FinancieraController::class, 'editArchivo'])
    ->name('financieras.editArchivo');

Route::patch('/financieras/{financiera}/update-archivo', [FinancieraController::class, 'updateArchivo'])
    ->name('financieras.updateArchivo');


Route::get('/financieras/tesoreria', [FinancieraController::class, 'tesoreria'])->name('financieras.tesoreria');





//Route::put('/tesoreria/{id}', [TesoreriaController::class, 'update'])->name('tesoreria.update');

Route::put('/financieras/{id}/estado-despacho', [FinancieraController::class, 'actualizarEstadoDespacho'])
    ->name('financieras.estado_despacho');
    //estado tesoreria de archivps
    Route::put('/financieras/{id}/estado-tesoreria', [FinancieraController::class, 'actualizarEstadoTesoreria'])
    ->name('financieras.estado_tesoreria');

//boton de asignacion
Route::get('/ubicaciones/asignar/{financiera}', [UbicacionController::class, 'asignar'])
    ->name('ubicaciones.asignar');

Route::put('/ubicaciones/actualizar/{financiera}', [UbicacionController::class, 'actualizar'])
    ->name('ubicaciones.actualizar');

//PARTE GESTION ARCHIVOS
//UBICACION-PRESTAMOS

Route::resource('prestamos', PrestamoArchivoController::class);

//prestamos de archivos
Route::get('/prestamos', [PrestamoArchivoController::class, 'index'])->name('prestamos.index');
Route::post('/prestamos', [PrestamoArchivoController::class, 'store'])->name('prestamos.store');
Route::patch('/prestamos/{prestamo}/devolver', [PrestamoArchivoController::class, 'devolver'])->name('prestamos.devolver');
Route::get('/ubicaciones/estante/{estante}', [UbicacionController::class, 'showEstante'])
    ->name('ubicaciones.show_estante');
Route::get('/ubicaciones/{id}/detalle', [UbicacionController::class, 'showRegistro'])
     ->name('ubicaciones.show_registro');

Route::get('/ubicaciones/ver-estante/{estante}', [UbicacionController::class, 'showEstante'])
    ->name('ubicaciones.ver_estante');
Route::delete('/prestamos/{prestamo}', [PrestamoArchivoController::class, 'destroy'])->name('prestamos.destroy');
Route::get('/prestamos/{financiera}/create', [PrestamoArchivoController::class, 'create'])
    ->name('prestamos.create');


//vista principal
Route::get('financiera/smaf', [AdminController::class, 'smaf'])->name('financiera.smaf');
Route::get('financiera/despacho', [AdminController::class, 'despacho'])->name('financiera.despacho');
Route::get('financiera/tesoreria', [AdminController::class, 'tesoreria'])->name('financiera.tesoreria');
Route::get('financiera/archivos', [AdminController::class, 'archivos'])->name('financiera.archivos');


//prestamos de archivo central viacha 
Route::resource('prestamo_central', PrestamoArchivocentralController::class);


// Listado de préstamos
Route::get('prestamo_central', [PrestamoArchivocentralController::class, 'index'])
    ->name('prestamo_central.index');

// Crear préstamo (opcional archivo_id para precargar)
Route::get('prestamo_central/create/{archivo_id?}', [PrestamoArchivocentralController::class, 'create'])
    ->name('prestamo_central.create');

// Guardar préstamo
Route::post('prestamo_central', [PrestamoArchivocentralController::class, 'store'])
    ->name('prestamo_central.store');

// Editar préstamo
Route::get('prestamo_central/{prestamo}/edit', [PrestamoArchivocentralController::class, 'edit'])
    ->name('prestamo_central.edit');

// Actualizar préstamo
Route::put('prestamo_central/{prestamo}', [PrestamoArchivocentralController::class, 'update'])
    ->name('prestamo_central.update');

// Mostrar detalle de préstamo
Route::get('prestamo_central/{prestamo}', [PrestamoArchivocentralController::class, 'show'])
    ->name('prestamo_central.show');

// Eliminar préstamo
Route::delete('prestamo_central/{prestamo}', [PrestamoArchivocentralController::class, 'destroy'])
    ->name('prestamo_central.destroy');

// Marcar préstamo como devuelto
Route::patch('prestamo_central/{prestamo}/devolver', [PrestamoArchivocentralController::class, 'devolver'])
    ->name('prestamo_central.devolver');
