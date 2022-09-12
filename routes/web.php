<?php

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

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

//  Permisos

// Route::get('/role', 'RoleController@index')->name('role.index');
// Route::post('/dashboard/role/store', 'RoleController@store')->name('role.create');
// Route::get('/roles/create','RoleController@create')->name('role.add');
// Route::get('dashboard/roles/{id}/edit','RoleController@edit')->name('role.edit');
// Route::post('dashboard/roles/update', 'RoleController@update')->name('role.update');
// route::get('/dashboard/roles/destroy/{id}', 'RoleController@destroy')->name('role.destroy');
// Route::get('/roles/ver/{id}','RoleController@verPermisos')->name('roles.ver');


//Rutas de permisos

// Route::get('/dashboard/permission/{id}/edit', 'PermissionController@edit')->name('permisos.editar');
// Route::post('/dashboard/permission/store', 'PermissionController@store')->name('permisos.create');
// Route::post('/dashboard/permission/update', 'PermissionController@update')->name('permisos.update');
// Route::get('/dashboard/permission/destroy/{id}','PermissionController@destroy')->name('permisos.destroy');

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
    Route::get('/prueba',[PruebaController::class,'index'])->name('prueba');
    
    Route::get('/logout',function(){
        auth()->logout();
        return redirect('/login');
        
    });
    //permisos
    Route::get('/permission', Permission::class)->name('permisos.index');
    Route::get('/roles', Roles::class)->name('roles.index');
    Route::get('/users', Users::class)->name('user.index');
});
