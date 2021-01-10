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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
});

//Route::group(['middleware' => ['auth']], function () {
    // Users CRUD
//    Route::group(['prefix' => 'users'], function () {
//        Route::get('', [App\Http\Controllers\UserController::class, 'index'])->middleware('can:users.index');
//        Route::get('get-users-for-datatable', [App\Http\Controllers\UserController::class, 'getAllUsersForDatatable'])->middleware('can:users.index');
//        Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->middleware('can:users.create');
//        Route::post('', [App\Http\Controllers\UserController::class, 'store'])->middleware('can:users.create');
//        Route::get('{userId}', [App\Http\Controllers\UserController::class, 'show'])->middleware('can:users.view');
//        Route::get('{userId}/edit', [App\Http\Controllers\UserController::class, 'edit'])->middleware('can:users.edit');
//        Route::patch('{userId}', [App\Http\Controllers\UserController::class, 'update'])->middleware('can:users.edit');
//        Route::delete('{userId}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('can:users.delete');
//    });

    // Teams CRUD
    Route::group(['prefix' => 'teams'], function () {
//        Route::get('', [App\Http\Controllers\TeamController::class, 'index'])->name('teams.index')->middleware('can:teams.index');
//        Route::get('create', [App\Http\Controllers\TeamController::class, 'create'])->name('teams.create')->middleware('can:teams.create');
//        Route::post('', [App\Http\Controllers\TeamController::class, 'store'])>name('teams.store')->middleware('can:teams.create');
//        Route::get('{teamId}/edit', [App\Http\Controllers\TeamController::class, 'edit'])->name('teams.edit')->middleware('can:teams.edit');
//        Route::patch('{teamId}', [App\Http\Controllers\TeamController::class, 'update'])->name('teams.update')->middleware('can:teams.edit');
//        Route::get('get-teams', [App\Http\Controllers\TeamController::class, 'getTeams'])->name('teams.datatable')->middleware('can:teams.index');

        Route::get('', [App\Http\Controllers\TeamController::class, 'index'])->name('teams.index');
        Route::get('create', [App\Http\Controllers\TeamController::class, 'create'])->name('teams.create');
        Route::post('', [App\Http\Controllers\TeamController::class, 'store'])->name('teams.store');
        Route::get('{teamId}/edit', [App\Http\Controllers\TeamController::class, 'edit'])->name('teams.edit');
        Route::patch('{teamId}', [App\Http\Controllers\TeamController::class, 'update'])->name('teams.update');
        Route::delete('{teamId}', [App\Http\Controllers\TeamController::class, 'destroy'])->name('teams.delete');
        Route::get('get-teams', [App\Http\Controllers\TeamController::class, 'getTeams'])->name('teams.datatable');
    });
//});
