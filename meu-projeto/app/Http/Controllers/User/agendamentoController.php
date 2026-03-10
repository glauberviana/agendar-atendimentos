<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{

    public function index()
    {
        // Admin vê todos os agendamentos
        if (Auth::user()->role === 'admin') {
            $agendamentos = Agendamento::all();
        } 
        // Usuário comum vê apenas os seus
        else {
            $agendamentos = Agendamento::where('user_id', Auth::id())->get();
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
            'data' => 'required|date',
            'hora' => 'required',
            'descricao' => 'nullable|string|max:255',
        ]);

        Agendamento::create([
            'user_id' => Auth::id(),
            'data' => $request->data,
            'hora' => $request->hora,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Agendamento criado com sucesso!');
    }


    public function show($id)
    {
        $agendamento = Agendamento::findOrFail($id);

        // Usuário só pode ver o próprio
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
            'data' => 'required|date',
            'hora' => 'required',
            'descricao' => 'nullable|string|max:255',
        ]);

        $agendamento->update([
            'data' => $request->data,
            'hora' => $request->hora,
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
            ->with('success', 'Agendamento excluído!');
    }

}