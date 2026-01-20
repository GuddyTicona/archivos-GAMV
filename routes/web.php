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
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN
|--------------------------------------------------------------------------
*/
Auth::routes(['register' => true]);

// Verificación 2FA
Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/
Route::get('/', [AdminController::class, 'index'])->name('index');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS POR AUTENTICACIÓN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'twofactor'])->group(function () {
    
    /*
    |----------------------------------------------------------------------
    | DASHBOARD Y VISTAS PRINCIPALES
    |----------------------------------------------------------------------
    */
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('home');
    });
    
    // Vistas principales por módulo
    Route::get('financiera/smaf', [AdminController::class, 'smaf'])->name('financiera.smaf');
    Route::get('financiera/despacho', [AdminController::class, 'despacho'])->name('financiera.despacho');
    Route::get('financiera/tesoreria', [AdminController::class, 'tesoreria'])->name('financiera.tesoreria');
    Route::get('financiera/archivos', [AdminController::class, 'archivos'])->name('financiera.archivos');
    
    /*
    |----------------------------------------------------------------------
    | ASISTENTE VIRTUAL / CHATBOT / N8N
    |----------------------------------------------------------------------
    */
    Route::get('/assistant', [FileAssistantController::class, 'index'])->name('assistant.index');
    Route::post('/assistant/message', [FileAssistantController::class, 'handleMessage'])->name('assistant.message');
    Route::post('/chatbot', [FileAssistantController::class, 'handleMessage'])->name('chatbot');
    Route::get('/chat', [ChatController::class, 'view'])->name('chat.view');
    Route::post('/n8n/chat', [ChatController::class, 'handle'])->name('chat.handle');
    
    /*
    |----------------------------------------------------------------------
    | NOTIFICACIONES
    |----------------------------------------------------------------------
    */
    Route::post('/notificaciones/marcar-leida/{id}', [NotificacionController::class, 'marcarLeida'])
        ->name('notificaciones.marcar-leida');
    
    /*
    |----------------------------------------------------------------------
    | PREVENTIVOS
    |----------------------------------------------------------------------
    */
    Route::get('/preventivos', [App\Http\Controllers\PreventivoController::class, 'index'])
        ->name('preventivos.index');

    /*
    |----------------------------------------------------------------------
    | MÓDULO: ADMINISTRACIÓN (Solo Administradores)
    |----------------------------------------------------------------------
    */
    Route::middleware(['role:administrador'])->group(function () {
        
        // Gestión de Usuarios
        Route::get('/admin/usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::resource('usuarios', UserController::class)->except(['index']);
        Route::post('/admin/usuarios/{user}/asignar-rol', [UserController::class, 'asignarRol'])
            ->name('usuarios.asignarRol');
        
        // Gestión de Roles
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        
        // Gestión de Permisos
        Route::resource('permissions', PermissionController::class)->names('permissions');
        Route::get('/admin/permissions/asignar', [PermissionController::class, 'asignarPermisos'])
            ->name('permissions.assign');
        Route::post('/admin/permissions/asignar', [PermissionController::class, 'guardarAsignacion'])
            ->name('permissions.store_assign');
        Route::get('permissions/modular/{rol}', [PermissionController::class, 'asignarPorModulo'])
            ->name('permissions.modular');
        Route::post('permissions/modular/{rol}', [PermissionController::class, 'guardarPorModulo'])
            ->name('permissions.guardarModulo');
        
        // Recursos Generales
        Route::resource('/unidades', App\Http\Controllers\UnidadController::class);
        Route::resource('/archivos', App\Http\Controllers\ArchivoController::class);
        Route::resource('/categorias', App\Http\Controllers\CategoriaController::class);
        Route::resource('/historial-archivos', App\Http\Controllers\HistorialArchivoController::class);
    });

    /*
    |----------------------------------------------------------------------
    | MÓDULO: ÁREAS (Con permisos)
    |----------------------------------------------------------------------
    */
    Route::resource('areas', AreaController::class)->middleware('permission:areas.index|role:administrador|smaf');
    
    // Reportes de Áreas
    Route::get('/areas/{id}/reporte', [AreaController::class, 'generarReporte'])
        ->middleware('permission:areas.index|role:administrador|smaf')
        ->name('areas.generarReporte');
    Route::get('/areas/{area}/financieras/{financiera}/reporte', [AreaController::class, 'reporteFinanciera'])
        ->middleware('permission:areas.index|role:administrador|smaf')
        ->name('areas.financieras.reporte');
    Route::get('areas/{area}/reporte/{registro?}', [AreaController::class, 'reporteFinanciera'])
        ->middleware('permission:areas.index|role:administrador|smaf')
        ->name('areas.reporte_financiera');

    /*
    |----------------------------------------------------------------------
    | MÓDULO: ÁREA DESPACHO (Con permisos)
    |----------------------------------------------------------------------
    */
    Route::resource('areas-despacho', AreaDespachoController::class)
        ->middleware('permission:areas-despacho.index|role:administrador|despacho');
    
    // Reportes Área Despacho
// Reportes Área Despacho
Route::get('areas-despacho/{id}/reporte', [AreaDespachoController::class, 'generarReporte'])
    ->middleware('permission:areas-despacho.index|role:administrador|despacho')
    ->name('areas-despacho.generarReporte');

Route::get('areas-despacho/{areaId}/financiera/{financieraId}/reporte', [AreaDespachoController::class, 'reporteFinanciera'])
    ->middleware('permission:areas-despacho.index|role:administrador|despacho')
    ->name('areas-despacho.financiera.reporte');

    /*
    |----------------------------------------------------------------------
    | MÓDULO: ÁREA ARCHIVOS (Con permisos)
    |----------------------------------------------------------------------
    */
    Route::resource('areas-archivos', AreaArchivoController::class)
        ->middleware('permission:areas-archivos.index|role:administrador|tesoreria');
    
    // Reportes Área Archivos
    Route::get('/areas-archivos/{id}/generar-reporte', [AreaArchivoController::class, 'generarReporte'])
        ->middleware('permission:areas-archivos.index|role:administrador|tesoreria')
        ->name('areas-archivos.generarReporte');
    Route::get('areas-archivos/{areaId}/financieras/{financieraId}/reporte', [AreaArchivoController::class, 'generarReporte'])
        ->middleware('permission:areas-archivos.index|role:administrador|tesoreria')
        ->name('areas-archivos.financiera.reporte');
    Route::get('/areas-archivos/{areaId}/financieras/{financieraId}/reporte', [AreaArchivoController::class, 'reporteFinanciera'])
        ->middleware('permission:areas-archivos.index|role:administrador|tesoreria')
        ->name('areas-archivos.financiera.reporte2');
    Route::get('areas-archivos/{id}/reporte', [AreaArchivoController::class, 'generarReporte'])
        ->middleware('permission:areas-archivos.index|role:administrador|tesoreria')
        ->name('financieras.reporte');

    /*
    |----------------------------------------------------------------------
    | MÓDULO: UBICACIONES (Con permisos)
    |----------------------------------------------------------------------
    */
    Route::resource('ubicaciones', UbicacionController::class)
        ->middleware('permission:ubicaciones.index|role:administrador|archivos');
    
    // Funcionalidades especiales de ubicaciones
    Route::post('/ubicaciones/generar', [UbicacionController::class, 'generar'])
        ->middleware('permission:ubicaciones.create|role:administrador|archivos')
        ->name('ubicaciones.generar');
    Route::delete('/ubicaciones/eliminar-estante/{estante}', [UbicacionController::class, 'eliminarEstante'])
        ->middleware('permission:ubicaciones.destroy|role:administrador|archivos')
        ->name('ubicaciones.eliminar_estante');
    Route::get('/ubicaciones/estante/{estante}', [UbicacionController::class, 'verEstante'])
        ->middleware('permission:ubicaciones.index|role:administrador|archivos')
        ->name('ubicaciones.ver_estante');
    Route::get('/ubicaciones/ver-estante/{estante}', [UbicacionController::class, 'showEstante'])
        ->middleware('permission:ubicaciones.index|role:administrador|archivos')
        ->name('ubicaciones.show_estante');
    Route::get('/ubicaciones/{id}/detalle', [UbicacionController::class, 'showRegistro'])
        ->middleware('permission:ubicaciones.index|role:administrador|archivos')
        ->name('ubicaciones.show_registro');
    
    // Asignación de archivos/financieras a ubicaciones
    Route::get('/ubicaciones/asignar/{archivo}', [UbicacionController::class, 'seleccionarEstante'])
        ->middleware('permission:ubicaciones.edit|role:administrador|archivos')
        ->name('ubicaciones.seleccionarEstante');
    Route::post('/ubicaciones/asignar/{archivo}', [UbicacionController::class, 'asignarUbicacion'])
        ->middleware('permission:ubicaciones.edit|role:administrador|archivos')
        ->name('ubicaciones.asignarUbicacion');
    Route::get('/ubicaciones/asignar/{financiera}', [UbicacionController::class, 'asignar'])
        ->middleware('permission:ubicaciones.edit|role:administrador|archivos')
        ->name('ubicaciones.asignar');
    Route::put('/ubicaciones/actualizar/{financiera}', [UbicacionController::class, 'actualizar'])
        ->middleware('permission:ubicaciones.edit|role:administrador|archivos')
        ->name('ubicaciones.actualizar');

    /*
    |----------------------------------------------------------------------
    | MÓDULO: FINANCIERAS - RUTAS GENERALES
    |----------------------------------------------------------------------
    */
    Route::resource('financieras', FinancieraController::class)
        ->middleware('permission:financieras.index|role:administrador|smaf');
    
    // Actualizaciones de estado
    Route::post('financieras/{id}/estado', [FinancieraController::class, 'actualizarEstado'])
        ->middleware('permission:financieras.edit|role:administrador|smaf')
        ->name('financieras.actualizarEstado');
    Route::put('/financieras/{id}/estado', [FinancieraController::class, 'actualizarEstado'])
        ->middleware('permission:financieras.edit|role:administrador|smaf')
        ->name('financieras.estado_administrativo');
    Route::put('/financieras/{id}/actualizar-estado', [FinancieraController::class, 'actualizarEstado'])
        ->middleware('permission:financieras.edit|role:administrador|smaf')
        ->name('financieras.actualizarEstado2');
    Route::put('/financieras/{id}/estado-administrativo', [FinancieraController::class, 'cambiarEstadoAdministrativo'])
        ->middleware('permission:financieras.edit|role:administrador|smaf')
        ->name('financieras.cambiar_estado_administrativo');
    Route::put('/financieras/{id}/estado-despacho', [FinancieraController::class, 'actualizarEstadoDespacho'])
        ->middleware('permission:despacho.edit|role:administrador|tesoreria')
        ->name('financieras.estado_despacho');
    Route::put('/financieras/{id}/estado-tesoreria', [FinancieraController::class, 'actualizarEstadoTesoreria'])
        ->middleware('permission:tesoreria.edit|role:administrador')
        ->name('financieras.estado_tesoreria');
    Route::put('/financieras/{id}/tesoreria', [FinancieraController::class, 'actualizarTesoreria'])
        ->middleware('permission:tesoreria.edit|role:administrador')
        ->name('financieras.actualizarTesoreria');
    
    // Envío entre áreas
    Route::put('/financieras/enviar/{id}', [FinancieraController::class, 'enviarArchivo'])
        ->middleware('permission:financieras.edit|role:administrador')
        ->name('financieras.enviar');
    
    // Archivos
    Route::get('/archivos-financieras', [FinancieraController::class, 'archivos'])
        ->middleware('permission:financieras.index|role:administrador|smaf')
        ->name('financieras.archivos.index');
    Route::get('financieras/archivos/{id}', [FinancieraController::class, 'showArchivos'])
        ->middleware('permission:financieras.index|role:administrador')
        ->name('financieras.archivos.show');
    Route::get('/financieras/{id}/edit-archivo', [FinancieraController::class, 'editArchivo'])
        ->middleware('permission:financieras.edit|role:administrador')
        ->name('financieras.editArchivo');
    Route::patch('/financieras/{financiera}/update-archivo', [FinancieraController::class, 'updateArchivo'])
        ->middleware('permission:financieras.edit|role:administrador')
        ->name('financieras.updateArchivo');
    
    // Tesorería
    Route::get('/financieras/tesoreria', [FinancieraController::class, 'tesoreria'])
        ->middleware('permission:tesoreria.index|role:administrador')
        ->name('financieras.tesoreria');
    
    // Vista por área
    Route::get('/financieras-area', [FinancieraController::class, 'indexArea'])
        ->middleware('permission:financieras.index|role:administrador')
        ->name('financieras.area');

    /*
    |----------------------------------------------------------------------
    | MÓDULO: SMAF
    |----------------------------------------------------------------------
    */
    Route::prefix('smaf/financieras')->name('smaf.financieras.')->group(function () {
        Route::get('/', [FinancieraController::class, 'indexSmaf'])
            ->middleware('permission:smaf.index|role:administrador|smaf')
            ->name('index');
        
        Route::get('create', [FinancieraController::class, 'create'])
            ->middleware('permission:smaf.create|role:administrador|smaf')
            ->name('create');
        
        Route::post('/', [FinancieraController::class, 'store'])
            ->middleware('permission:smaf.create|role:administrador|smaf')
            ->name('store');
        
        Route::get('{financiera}/edit', [FinancieraController::class, 'editSmaf'])
            ->middleware('permission:smaf.edit|role:administrador|smaf')
            ->name('edit');
        
        Route::put('{financiera}', [FinancieraController::class, 'updateSmaf'])
            ->middleware('permission:smaf.edit|role:administrador|smaf')
            ->name('update');
        
        Route::delete('{financiera}', [FinancieraController::class, 'destroy'])
            ->middleware('permission:smaf.destroy|role:administrado|smaf')
            ->name('destroy');
        
        Route::post('{id}/enviar', [FinancieraController::class, 'enviar'])
            ->middleware('permission:smaf.edit|role:administrador|smaf')
            ->name('enviar');
    });
    
    // Ruta adicional SMAF
    Route::patch('/financieras/smaf/{financiera}', [FinancieraController::class, 'updateSmaf'])
        ->middleware('permission:smaf.edit|role:administrador|smaf')
        ->name('financieras.smaf.update');

    /*
    |----------------------------------------------------------------------
    | MÓDULO: DESPACHO
    |----------------------------------------------------------------------
    */
    Route::prefix('despacho/financieras')->name('despacho.financieras.')->group(function () {
        Route::get('/', [FinancieraController::class, 'indexDespacho'])
            ->middleware('permission:despacho.index|role:administrador|despacho')
            ->name('index');
        
        Route::get('{id}/edit', [FinancieraController::class, 'editDespacho'])
            ->middleware('permission:despacho.edit|role:administrador|despacho')
            ->name('edit');
        
        Route::put('{financiera}', [FinancieraController::class, 'updateDespacho'])
            ->middleware('permission:despacho.edit|role:administrador|despacho')
            ->name('update');
        
        Route::delete('{financiera}', [FinancieraController::class, 'destroy'])
            ->middleware('permission:despacho.destroy|role:administrador|despacho')
            ->name('destroy');
        
        Route::put('{id}/enviar', [FinancieraController::class, 'enviarTesoreria'])
            ->middleware('permission:despacho.edit|role:administrador|despacho')
            ->name('enviar');
    });

    /*
    |----------------------------------------------------------------------
    | MÓDULO: TESORERÍA
    |----------------------------------------------------------------------
    */
    Route::prefix('tesoreria/financieras')->name('tesoreria.financieras.')->group(function () {
        Route::get('/', [FinancieraController::class, 'indexTesoreria'])
            ->middleware('permission:tesoreria.index|role:administrador|tesoreria')
            ->name('index');
        
        Route::get('{id}/edit', [FinancieraController::class, 'editTesoreria'])
            ->middleware('permission:tesoreria.edit|role:administrador|tesoreria')
            ->name('edit');
        
        Route::put('{financiera}', [FinancieraController::class, 'updateTesoreria'])
            ->middleware('permission:tesoreria.edit|role:administrador|tesoreria')
            ->name('update');
        
        Route::delete('{financiera}', [FinancieraController::class, 'destroy'])
            ->middleware('permission:tesoreria.destroy|role:administrador|tesoreria')
            ->name('destroy');
    });

    /*
    |----------------------------------------------------------------------
    | MÓDULO: PRÉSTAMOS DE ARCHIVOS (Con permisos)
    |----------------------------------------------------------------------
    */
    Route::resource('prestamos', PrestamoArchivoController::class)
        ->middleware('permission:prestamos.index|role:administrador|archivos');
    
    Route::get('/prestamos/{financiera}/create', [PrestamoArchivoController::class, 'create'])
        ->middleware('permission:prestamos.create|role:administrador|archivos')
        ->name('prestamos.create_financiera');
    Route::post('/prestamos', [PrestamoArchivoController::class, 'store'])
    ->middleware('permission:prestamos.create|role:administrador|archivos')
    ->name('prestamos.store');
    Route::patch('/prestamos/{prestamo}/devolver', [PrestamoArchivoController::class, 'devolver'])
        ->middleware('permission:prestamos.edit|role:administrador|archivos')
        ->name('prestamos.devolver');

    /*
    |----------------------------------------------------------------------
    | MÓDULO: PRÉSTAMOS ARCHIVO CENTRAL (VIACHA) - Con permisos
    |----------------------------------------------------------------------
    */
    Route::resource('prestamo_central', PrestamoArchivocentralController::class)
        ->middleware('permission:prestamo-central.index|role:administrador|central');
    
    Route::get('prestamo_central/create/{archivo_id?}', [PrestamoArchivocentralController::class, 'create'])
        ->middleware('permission:prestamo-central.create|role:administrador|central')
        ->name('prestamo_central.create_archivo');
    Route::patch('prestamo_central/{prestamo}/devolver', [PrestamoArchivocentralController::class, 'devolver'])
        ->middleware('permission:prestamo-central.edit|role:administrador|central')
        ->name('prestamo_central.devolver');
});