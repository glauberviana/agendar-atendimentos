<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Agendamento;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total de Usuários cadastrados
        $totalUsuarios = User::count();

        // 2. Histórico completo: Todos os agendamentos já feitos na história
        $totalAgendados = Agendamento::count();

        // 3. Total de agendamentos confirmados (no sistema todo)
        $totalConcluidos = Agendamento::where('status', 'confirmado')->count();

        // 4. Atendimentos de Hoje (SOMENTE OS CONFIRMADOS)
        // O 'with('user')' é o que permite puxar o nome do aluno na tabela
        $atendimentosHoje = Agendamento::with('user')
            ->whereDate('data', Carbon::today())
            ->where('status', 'confirmado') // <-- FILTRO ADICIONADO AQUI
            ->orderBy('hora', 'asc')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsuarios',
            'totalAgendados',
            'totalConcluidos',
            'atendimentosHoje'
        ));
    }
}