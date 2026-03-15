@extends('layouts.admin')

@section('content')

<div class="space-y-6">


<div class="grid grid-cols-3 gap-6">


<div class="bg-[#269C73] text-white p-6 rounded-xl shadow-lg">

<div class="text-3xl font-bold">
{{ $totalUsuarios }}
</div>

<div class="text-sm">
Total de Usuários
</div>

</div>



<div class="bg-[#269C73] text-white p-6 rounded-xl shadow-lg">

<div class="text-3xl font-bold">
{{ $totalAgendados }}
</div>

<div class="text-sm">
Atendimentos Agendados
</div>

</div>



<div class="bg-[#269C73] text-white p-6 rounded-xl shadow-lg">

<div class="text-3xl font-bold">
{{ $totalConcluidos }}
</div>

<div class="text-sm">
Atendimentos Concluídos
</div>

</div>


</div>



<div class="bg-[#269C73] p-6 rounded-xl text-white shadow-lg">

<h3 class="font-semibold mb-4">

Atendimentos de Hoje

</h3>


<div class="bg-white rounded-lg overflow-hidden text-black">


<table class="w-full text-sm">

<thead class="border-b">

<tr>

<th class="text-left px-4 py-3">Aluno</th>

<th class="text-left px-4 py-3">Data</th>

<th class="text-left px-4 py-3">Hora</th>

<th class="text-left px-4 py-3">Status</th>

</tr>

</thead>


<tbody>

@forelse($atendimentosHoje as $atendimento)

<tr>

<td class="px-4 py-3">

{{ $atendimento->aluno }}

</td>

<td class="px-4 py-3">

{{ \Carbon\Carbon::parse($atendimento->data)->format('d/m/Y') }}

</td>

<td class="px-4 py-3">

{{ $atendimento->hora }}

</td>

<td class="px-4 py-3">

@if($atendimento->status == 'confirmado')

<span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">
Confirmado
</span>

@elseif($atendimento->status == 'pendente')

<span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full text-xs">
Pendente
</span>

@elseif($atendimento->status == 'cancelado')

<span class="bg-red-200 text-red-800 px-2 py-1 rounded-full text-xs">
Cancelado
</span>

@else

<span class="bg-blue-200 text-blue-800 px-2 py-1 rounded-full text-xs">
Concluído
</span>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="4" class="text-center py-4">

Nenhum atendimento marcado para hoje.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

@endsection