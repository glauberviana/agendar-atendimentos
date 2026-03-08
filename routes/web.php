<?php

use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rota pública
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Área do USUÁRIO (apenas usuários logados)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Área do ADMINISTRADOR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])
->prefix('admin')
->name('admin.')
->group(function(){

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    Route::get('/horarios',[HorarioController::class,'index'])->name('horarios');
    Route::post('/horarios',[HorarioController::class,'store'])->name('horarios.store');
    Route::put('/horarios/{id}',[HorarioController::class,'update'])->name('horarios.update');
    Route::delete('/horarios/{id}',[HorarioController::class,'destroy'])->name('horarios.destroy');

    Route::view('/agendamentos','admin.agendamentos')->name('agendamentos');
    Route::view('/historico','admin.historico')->name('historico');
    Route::view('/usuarios','admin.usuarios')->name('usuarios');

});

/*
|--------------------------------------------------------------------------
| Rotas de autenticação
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';