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
        // 1. Total de Usuários
        $totalUsuarios = User::count();

        // 2. Histórico completo (Contagem de todos os registros)
        $totalAgendados = Agendamento::count();

        // 3. Total de agendamentos confirmados (Sistema todo)
        $totalConcluidos = Agendamento::where('status', 'confirmado')->count();

        // 4. Atendimentos de Hoje (Confirmados e Ordenados)
        // DICA: Verifique se o nome da coluna no banco é 'data' ou 'date'
        $atendimentosHoje = Agendamento::with('user')
            ->whereDate('data', Carbon::today()) 
            ->where('status', 'confirmado')
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