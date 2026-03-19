<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AgendamentoController extends Controller
{
    public function index()
    {
        // Usamos 'with' para carregar os dados do usuário de uma vez só
        $query = Agendamento::with('user');

        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $agendamentos = $query->orderBy('data', 'desc')
                             ->orderBy('hora', 'asc')
                             ->get();

        return view('User.agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        return view('User.agendamentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'tipo' => 'required|string',
            'descricao' => 'nullable|string|max:255',
        ]);

        $dataHoraSelecionada = Carbon::parse($request->data . ' ' . $request->hora);

        // Validação: não permitir horários que já passaram hoje
        if ($dataHoraSelecionada->isPast()) {
            return back()->withErrors([
                'hora' => 'Este horário já passou. Escolha um horário futuro.'
            ])->withInput();
        }

        // Verifica se o horário já está ocupado por outro atendimento ativo
        $existe = Agendamento::where('data', $request->data)
            ->where('hora', $request->hora)
            ->where('status', '!=', 'cancelado')
            ->exists();

        if ($existe) {
            return back()->withErrors([
                'hora' => 'Este horário já está ocupado.'
            ])->withInput();
        }

        Agendamento::create([
            'user_id' => Auth::id(),
            'data' => $request->data,
            'hora' => $request->hora,
            'tipo' => $request->tipo,
            'descricao' => $request->descricao,
            'status' => 'pendente', // Garante que comece como pendente
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Agendamento criado com sucesso!');
    }

    public function show($id)
    {
        $agendamento = Agendamento::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $agendamento->user_id != Auth::id()) {
            abort(403);
        }

        return view('User.agendamentos.show', compact('agendamento'));
    }

    public function edit($id)
    {
        $agendamento = Agendamento::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $agendamento->user_id != Auth::id()) {
            abort(403);
        }

        return view('User.agendamentos.edit', compact('agendamento'));
    }

    public function update(Request $request, $id)
    {
        $agendamento = Agendamento::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $agendamento->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'data' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'tipo' => 'required|string',
            'descricao' => 'nullable|string|max:255',
        ]);

        $dataHoraSelecionada = Carbon::parse($request->data . ' ' . $request->hora);

        if ($dataHoraSelecionada->isPast()) {
            return back()->withErrors([
                'hora' => 'Escolha um horário futuro para o reagendamento.'
            ])->withInput();
        }

        // Verifica ocupação ignorando o próprio registro
        $existe = Agendamento::where('data', $request->data)
            ->where('hora', $request->hora)
            ->where('status', '!=', 'cancelado')
            ->where('id', '!=', $id)
            ->exists();

        if ($existe) {
            return back()->withErrors(['hora' => 'Este horário já está ocupado.'])->withInput();
        }

        // ATUALIZAÇÃO: Reseta o status para pendente ao reagendar
        $agendamento->update([
            'data' => $request->data,
            'hora' => $request->hora,
            'tipo' => $request->tipo,
            'descricao' => $request->descricao,
            'status' => 'pendente', 
        ]);

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento reagendado! Aguarde a nova confirmação.');
    }

    public function destroy($id)
    {
        $agendamento = Agendamento::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $agendamento->user_id != Auth::id()) {
            abort(403);
        }

        $agendamento->delete();

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento cancelado com sucesso!');
    }
}