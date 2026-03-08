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
            'hora' => 'required'
        ]);

        // verifica se já existe
        if(Horario::where('hora',$request->hora)->exists()){

            return back()->with('erro','Esse horário já existe.');

        }

        Horario::create([
            'hora'=>$request->hora
        ]);

        return back()->with('success','Horário cadastrado com sucesso.');

    }


    public function update(Request $request,$id)
    {

        $horario = Horario::findOrFail($id);

        $horario->update([
            'hora'=>$request->hora
        ]);

        return back()->with('success','Horário alterado com sucesso.');

    }


    public function destroy($id)
    {

        Horario::destroy($id);

        return back()->with('success','Horário removido com sucesso.');

    }

}