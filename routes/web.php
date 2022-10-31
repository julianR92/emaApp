<?php

use App\Http\Controllers\EjeController;
use App\Http\Controllers\MallaController;
use App\Http\Controllers\ColectivoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\InstrumentosController;
use App\Http\Controllers\AsignaturasController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\OfertaAcademicaController;
use App\Http\Controllers\PruebaController;
use App\Http\Livewire\BootstrapTables;
use App\Http\Livewire\Components\Buttons;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Components\Modals;
use App\Http\Livewire\Components\Notifications;
use App\Http\Livewire\Components\Typography;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\ForgotPasswordExample;
use App\Http\Livewire\Index;
use App\Http\Livewire\LoginExample;
use App\Http\Livewire\ProfileExample;
use App\Http\Livewire\RegisterExample;
use App\Http\Livewire\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResetPasswordExample;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\UsersDos;
use App\Http\Livewire\Permission;
use App\Http\Livewire\Roles\Roles;
use App\Http\Livewire\Users\Users;
use App\Http\Livewire\Areas\Areas;
use App\Http\Livewire\Procesos\Procesos;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');

Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)
    ->name('reset-password')
    ->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile-example', ProfileExample::class)->name('profile-example');
    Route::get('/userdos', UsersDos::class)->name('usersdos');
    Route::get('/login-example', LoginExample::class)->name('login-example');
    Route::get('/register-example', RegisterExample::class)->name('register-example');
    Route::get('/forgot-password-example', ForgotPasswordExample::class)->name('forgot-password-example');
    Route::get('/reset-password-example', ResetPasswordExample::class)->name('reset-password-example');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/bootstrap-tables', BootstrapTables::class)->name('bootstrap-tables');
    Route::get('/lock', Lock::class)->name('lock');
    Route::get('/buttons', Buttons::class)->name('buttons');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/forms', Forms::class)->name('forms');
    Route::get('/modals', Modals::class)->name('modals');
    Route::get('/typography', Typography::class)->name('typography');
    Route::get('/prueba', [PruebaController::class, 'index'])->name('prueba');

    Route::get('/logout', function () {
        auth()->logout();
        return redirect('/login');
    });
    //permisos

    Route::group(['middleware' => ['permission:control-total']], function () {
        Route::get('/permission', Permission::class)->name('permisos.index');
        Route::get('/roles', Roles::class)->name('roles.index');
        Route::get('/users', Users::class)->name('user.index');
    });
    //configuracion
    Route::group(['middleware' => ['permission:control-total|ver-configuracion']], function () {
        Route::get('/areas', Areas::class)->name('areas.index');
        Route::get('/procesos', Procesos::class)->name('procesos.index');
        Route::get('/ejes', [EjeController::class, 'index'])->name('eje.index');
        // Route::get('/listarEjes',[EjeController::class, 'listarEjes'])->name('eje.listar');
        Route::get('/edit/eje/{id}', [EjeController::class, 'edit'])->name('eje.editar');
        Route::delete('/delete/eje/{id}', [EjeController::class, 'delete'])->name('eje.delete');
        Route::post('/ejes', [EjeController::class, 'store'])->name('eje.store');

        Route::get('/programas', [ProgramaController::class, 'index'])->name('programas.index');
        Route::get('/programas/{id}', [ProgramaController::class, 'areaProgramas'])->name('programas.areas');
        Route::get('/programa/proceso/{id}', [ProgramaController::class, 'programaProceso'])->name('programas.proceso');
        Route::post('/programas', [ProgramaController::class, 'store'])->name('programas.store');
        Route::get('/edit/programa/{id}', [ProgramaController::class, 'edit'])->name('programas.editar');
        Route::get('/activate/programa/{id}', [ProgramaController::class, 'changeState'])->name('programas.estado');
        Route::delete('/delete/programa/{id}', [ProgramaController::class, 'delete'])->name('programas.delete');

        //mallas
        Route::get('/mallas',[MallaController::class, 'index'])->name('mallas.index');
        Route::get('/mallas/{id}',[MallaController::class, 'areaMallas'])->name('mallas.areas');
        Route::get('/mallas/colectivos/{id}',[MallaController::class, 'mallaColectivos'])->name('mallas.colectivos');
        Route::get('/mallas/asignaturas/{id}/{area_id}',[MallaController::class, 'mallaAsignaturas'])->name('mallas.asignaturas');
        Route::post('/mallas',[MallaController::class, 'store'])->name('mallas.store');
        Route::get('/edit/malla/{id}',[MallaController::class, 'edit'])->name('mallas.editar');
        Route::delete('/delete/malla/{id}',[MallaController::class, 'delete'])->name('mallas.delete');
        Route::post('/mallas-asignaturas',[MallaController::class, 'storeAsignatura'])->name('mallas.store-asignatura');
        Route::post('/mallas-colectivos',[MallaController::class, 'storeColectivos'])->name('mallas.store-colectivos');
        Route::get('/edit/malla-asignatura/{id}',[MallaController::class, 'editAsignatura'])->name('mallas.editar-asignatura');
        Route::get('/edit/malla-colectivo/{id}',[MallaController::class, 'editColectivo'])->name('mallas.editar-colectivo');
        Route::delete('/delete/malla-asignatura/{id}',[MallaController::class, 'deleteMallaAsignatura'])->name('mallas.delete-asignatura');
        Route::delete('/delete/malla-colectivo/{id}',[MallaController::class, 'deleteMallaColectivo'])->name('mallas.delete-asignatura');

        //oferta acadmica
        Route::get('/oferta-academica',[OfertaAcademicaController::class, 'index'])->name('oferta-academica.index');
        Route::get('/oferta-academica/{id}',[OfertaAcademicaController::class, 'areaOferta'])->name('oferta-academica.areas');
        Route::get('/oferta-academica/{id}/nuevo',[OfertaAcademicaController::class, 'ofertaNuevo'])->name('oferta-academica.nuevo');
        Route::post('/oferta-academica',[OfertaAcademicaController::class, 'store'])->name('oferta-academica.store');
        Route::get('/oferta-academica/{id}/edit',[OfertaAcademicaController::class, 'edit'])->name('oferta-academica.edit');
        Route::delete('/delete/oferta-academica/{id}',[OfertaAcademicaController::class, 'delete'])->name('oferta-academica.delete');
        
    });

    Route::group(['middleware' => ['permission:control-total|ver-configuracion|ver-parametrizacion']], function () {
        Route::get('/colectivos', [ColectivoController::class, 'index'])->name('colectivos.index');
        Route::get('/edit/colectivos/{id}', [ColectivoController::class, 'edit'])->name('colectivos.editar');
        Route::delete('/delete/colectivos/{id}', [ColectivoController::class, 'delete'])->name('colectivos.delete');
        Route::post('/colectivos', [ColectivoController::class, 'store'])->name('colectivos.store');
        //instrumentos
        Route::get('/instrumentos', [InstrumentosController::class, 'index'])->name('instrumentos.index');
        Route::get('/edit/instrumentos/{id}', [InstrumentosController::class, 'edit'])->name('instrumentos.editar');
        Route::delete('/delete/instrumentos/{id}', [InstrumentosController::class, 'delete'])->name('instrumentos.delete');
        Route::post('/instrumentos', [InstrumentosController::class, 'store'])->name('instrumentos.store');
        //asignaturas
        Route::get('/asignaturas', [AsignaturasController::class, 'index'])->name('asignaturas.index');
        Route::get('/asignaturas/{id}', [AsignaturasController::class, 'areaAsignaturas'])->name('asignaturas.areas');        
        Route::post('/asignaturas', [AsignaturasController::class, 'store'])->name('asignaturas.store');
        Route::get('/edit/asignatura/{id}', [AsignaturasController::class, 'edit'])->name('asignaturas.editar');
        Route::get('/activate/asignatura/{id}', [AsignaturasController::class, 'changeState'])->name('asignaturas.estado');
        Route::delete('/delete/asignatura/{id}', [AsignaturasController::class, 'delete'])->name('asignaturas.delete');
        //docentes
        Route::get('/docentes',[ProfesorController::class, 'index'])->name('profesor.index');
        Route::get('/docentes/create',[ProfesorController::class, 'create'])->name('profesor.create');
        Route::get('/docentes/{id}/edit',[ProfesorController::class, 'edit'])->name('profesor.edit');
        Route::post('/docentes',[ProfesorController::class, 'store'])->name('profesor.store');
        Route::delete('/delete/docente/{id}',[ProfesorController::class, 'delete'])->name('profesor.delete');
        // Route::get('/mallas/colectivos/{id}',[MallaController::class, 'mallaColectivos'])->name('mallas.colectivos');
        // Route::get('/mallas/asignaturas/{id}/{area_id}',[MallaController::class, 'mallaAsignaturas'])->name('mallas.asignaturas');
        // Route::get('/edit/malla/{id}',[MallaController::class, 'edit'])->name('mallas.editar');
        
    });
});
