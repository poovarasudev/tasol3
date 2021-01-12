<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'verify' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contact-admin', [App\Http\Controllers\HomeController::class, 'contactAdmin'])->name('contact.admin');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::group(['middleware' => ['auth']], function () {
    // Users CRUD
    Route::group(['prefix' => 'users'], function () {
        Route::get('', [App\Http\Controllers\UserController::class, 'index'])->name('users.index')->middleware('can:users.index');
        Route::get('get-users', [App\Http\Controllers\UserController::class, 'getUsers'])->name('users.datatable')->middleware('can:users.index');
        Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create')->middleware('can:users.create');
        Route::post('', [App\Http\Controllers\UserController::class, 'store'])->name('users.store')->middleware('can:users.create');
        Route::get('{userId}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show')->middleware('can:users.view');
        Route::get('{userId}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit')->middleware('can:users.edit');
        Route::patch('{userId}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update')->middleware('can:users.edit');
        Route::delete('{userId}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete')->middleware('can:users.delete');
    });

    // Teams CRUD
    Route::group(['prefix' => 'teams'], function () {
        Route::get('', [App\Http\Controllers\TeamController::class, 'index'])->name('teams.index')->middleware('can:teams.index');
        Route::get('get-teams', [App\Http\Controllers\TeamController::class, 'getTeams'])->name('teams.datatable')->middleware('can:teams.index');
        Route::get('create', [App\Http\Controllers\TeamController::class, 'create'])->name('teams.create')->middleware('can:teams.create');
        Route::post('', [App\Http\Controllers\TeamController::class, 'store'])->name('teams.store')->middleware('can:teams.create');
        Route::get('{teamId}/edit', [App\Http\Controllers\TeamController::class, 'edit'])->name('teams.edit')->middleware('can:teams.edit');
        Route::patch('{teamId}', [App\Http\Controllers\TeamController::class, 'update'])->name('teams.update')->middleware('can:teams.edit');
        Route::delete('{teamId}', [App\Http\Controllers\TeamController::class, 'destroy'])->name('teams.delete')->middleware('can:teams.delete');
    });

    // Roles CRUD
    Route::group(['prefix' => 'roles'], function () {
        Route::get('', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index')->middleware('can:roles.index');
        Route::get('get-roles', [App\Http\Controllers\RoleController::class, 'getRoles'])->name('roles.datatable')->middleware('can:roles.index');
        Route::get('create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create')->middleware('can:roles.create');
        Route::post('', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store')->middleware('can:roles.create');
        Route::get('{roleId}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show')->middleware('can:roles.view');
        Route::get('{roleId}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit')->middleware('can:roles.edit');
        Route::patch('{roleId}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update')->middleware('can:roles.edit');
        Route::delete('{roleId}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.delete')->middleware('can:roles.delete');
    });

    // Assign Roles CRUD
    Route::group(['prefix' => 'assign-role'], function () {
        Route::get('', [App\Http\Controllers\AssignRoleController::class, 'index'])->name('assign_role.index')->middleware('can:assign_role.index');
        Route::get('get-assigned-roles', [App\Http\Controllers\AssignRoleController::class, 'getAssignedRoles'])->name('assign_role.datatable')->middleware('can:roles.index');
        Route::get('create', [App\Http\Controllers\AssignRoleController::class, 'create'])->name('assign_role.create')->middleware('can:assign_role.create');
        Route::post('', [App\Http\Controllers\AssignRoleController::class, 'store'])->name('assign_role.store')->middleware('can:assign_role.create');
        Route::get('{userId}/edit', [App\Http\Controllers\AssignRoleController::class, 'edit'])->name('assign_role.edit')->middleware('can:assign_role.edit');
        Route::patch('{userId}', [App\Http\Controllers\AssignRoleController::class, 'update'])->name('assign_role.update')->middleware('can:assign_role.edit');
        Route::delete('{userId}', [App\Http\Controllers\AssignRoleController::class, 'destroy'])->name('assign_role.delete')->middleware('can:assign_role.delete');
    });
});
