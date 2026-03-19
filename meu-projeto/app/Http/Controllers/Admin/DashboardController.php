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
        // 1. CORRIGIDO: Conta apenas usuários que NÃO são administradores
        // Isso garante que o seu número reflita apenas o total de alunos/clientes.
        $totalUsuarios = User::where('role', '!=', 'admin')->count();

        // 2. Histórico completo (Soma de todos os registros no banco)
        $totalAgendados = Agendamento::count();

        // 3. Total de agendamentos confirmados (No sistema todo)
        $totalConcluidos = Agendamento::where('status', 'confirmado')->count();

        // 4. Atendimentos de Hoje (Apenas os Confirmados para a listagem)
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