<?php

use App\Http\Controllers\Admin\AtendimentoController;
use App\Http\Controllers\Admin\DashboardController;
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
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Área do USUÁRIO (apenas usuários logados)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $agendamentos = Agendamento::where('user_id', auth()->id())
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        $proximoAgendamento = $agendamentos->first();
        $recentes = $agendamentos->take(3);

        return view('User.dashboard', compact('agendamentos','proximoAgendamento','recentes'));
    })->name('dashboard');


    // ROTAS DE AGENDAMENTO (USUÁRIO)
    Route::get('/agendamentos/create', [AgendamentoController::class, 'create'])
        ->name('agendamentos.create');

    Route::post('/agendamentos', [AgendamentoController::class, 'store'])
        ->name('agendamentos.store');

    Route::delete('/agendamentos/{id}', [AgendamentoController::class, 'destroy'])
        ->name('agendamentos.destroy');

    Route::get('/agendamentos', function () {
        $agendamentos = \App\Models\Agendamento::where('user_id', auth()->id())
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        return view('User.agendamentos.index', compact('agendamentos'));
    })->name('agendamentos.index');

    Route::get('/agendamentos/{id}/edit', [AgendamentoController::class, 'edit'])
        ->name('agendamentos.edit');

    Route::put('/agendamentos/{id}', [AgendamentoController::class, 'update'])
        ->name('agendamentos.update');


    // Perfil do usuário
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

    Route::get('/dashboard',[DashboardController::class,'index'])
        ->name('dashboard');

    // Listagem de atendimentos
    Route::get('/atendimentos',[AtendimentoController::class,'index'])
        ->name('atendimentos');

    // Ações de Aceitar e Recusar
    Route::patch('/atendimentos/{id}/confirmar', [AtendimentoController::class, 'confirmar'])
        ->name('atendimentos.confirmar');

    Route::delete('/atendimentos/{id}/recusar', [AtendimentoController::class, 'recusar'])
        ->name('atendimentos.recusar');

    Route::post('/atendimentos',[AtendimentoController::class,'store'])
        ->name('atendimentos.store');

});


/*
|--------------------------------------------------------------------------
| Rotas de autenticação
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';