<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    /**
     * Lista todos os agendamentos.
     */
    public function index()
    {
        // Buscamos do model Agendamento com o relacionamento do usuário
        $agendamentos = Agendamento::with('user')->latest()->get();

        return view('admin.atendimentos', compact('agendamentos'));
    }

    /**
     * Confirma um agendamento pendente.
     */
    public function confirmar($id)
    {
        $agendamento = Agendamento::findOrFail($id);

        // ATENÇÃO: Mudamos apenas o status. O 'tipo' continua intacto.
        $agendamento->update([
            'status' => 'confirmado'
        ]);

        return redirect()->back()->with('success', 'Agendamento confirmado!');
    }

    /**
     * Recusa (remove) um agendamento.
     */
    public function recusar($id)
    {
        $agendamento = Agendamento::findOrFail($id);

        // Aqui você pode optar por deletar o registro 
        // ou apenas mudar o status para 'recusado' (ex: $agendamento->update(['status' => 'recusado']))
        $agendamento->delete();

        return redirect()->back()->with('success', 'Agendamento recusado e removido.');
    }

    /**
     * Caso você precise criar atendimentos manualmente pelo admin futuramente.
     */
    public function store(Request $request)
    {
        // Lógica para salvar novo atendimento, se necessário
    }
}
