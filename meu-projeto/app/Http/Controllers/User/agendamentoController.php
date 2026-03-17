<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // ✅ IMPORTANTE

class AgendamentoController extends Controller
{

    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $agendamentos = Agendamento::orderBy('data')->orderBy('hora')->get();
        } else {
            $agendamentos = Agendamento::where('user_id', Auth::id())
                ->orderBy('data')
                ->orderBy('hora')
                ->get();
        }

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

        // 🔥 VALIDAÇÃO CORRETA COM CARBON
        $dataHoraSelecionada = Carbon::parse($request->data . ' ' . $request->hora);

        // margem de 5 minutos
        $agora = Carbon::now()->subMinutes(5);

        if ($dataHoraSelecionada->lessThanOrEqualTo($agora)) {
            return back()->withErrors([
                'hora' => 'Escolha um horário um pouco mais à frente.'
            ])->withInput();
        }

        // horário já ocupado
        $existe = Agendamento::where('data', $request->data)
            ->where('hora', $request->hora)
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

        // 🔥 VALIDAÇÃO CORRETA COM CARBON
        $dataHoraSelecionada = Carbon::parse($request->data . ' ' . $request->hora);

        $agora = Carbon::now()->subMinutes(5);

        if ($dataHoraSelecionada->lessThanOrEqualTo($agora)) {
            return back()->withErrors([
                'hora' => 'Escolha um horário um pouco mais à frente.'
            ])->withInput();
        }

        // horário ocupado (exceto ele mesmo)
        $existe = Agendamento::where('data', $request->data)
            ->where('hora', $request->hora)
            ->where('id', '!=', $id)
            ->exists();

        if ($existe) {
            return back()->withErrors([
                'hora' => 'Este horário já está ocupado.'
            ])->withInput();
        }

        $agendamento->update([
            'data' => $request->data,
            'hora' => $request->hora,
            'tipo' => $request->tipo,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento atualizado!');
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