<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Atendimento;

class DashboardController extends Controller
{

public function index()
{

$totalUsuarios = User::count();

$totalAgendados = Atendimento::where('status','pendente')->count();

$totalConcluidos = Atendimento::where('status','concluido')->count();


$atendimentosHoje = Atendimento::whereDate('data', now()->toDateString())->get();


return view('admin.dashboard',[
'totalUsuarios'=>$totalUsuarios,
'totalAgendados'=>$totalAgendados,
'totalConcluidos'=>$totalConcluidos,
'atendimentosHoje'=>$atendimentosHoje
]);

}

}