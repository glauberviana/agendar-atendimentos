<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horario;

class HorarioController extends Controller
{

    public function index()
    {
        $horarios = Horario::orderBy('hora')->get();

        return view('admin.horarios', compact('horarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hora' => 'required|unique:horarios,hora'
        ],[
            'hora.unique' => 'Esse horário já foi cadastrado'
        ]);

        Horario::create([
            'hora' => $request->hora
        ]);

        return back()->with('success','Horário adicionado');
    }


    public function update(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);

        $request->validate([
            'hora' => 'required|unique:horarios,hora,'.$horario->id
        ]);

        $horario->update([
            'hora' => $request->hora
        ]);

        return back()->with('success','Horário atualizado');
    }


    public function destroy($id)
    {
        Horario::findOrFail($id)->delete();

        return back()->with('success','Horário removido');
    }

}