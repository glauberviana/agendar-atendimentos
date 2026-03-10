<?php

use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AgendamentoController;
use App\Models\Agendamento;
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

        $agendamentos = Agendamento::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        return view('User.dashboard', compact('agendamentos'));

    })->name('dashboard');


    // ROTAS DE AGENDAMENTO (USUÁRIO)

    Route::get('/agendamentos/create', [AgendamentoController::class, 'create'])
        ->name('agendamentos.create');

    Route::post('/agendamentos', [AgendamentoController::class, 'store'])
        ->name('agendamentos.store');


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

});


/*
|--------------------------------------------------------------------------
| Rotas de autenticação
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';