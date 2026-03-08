@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">
Gerenciar Horários
</h2>


{{-- Mensagens --}}

@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
{{ session('success') }}
</div>

@endif


@if(session('erro'))

<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
{{ session('erro') }}
</div>

@endif



{{-- Form adicionar horário --}}

<div class="bg-green-600 p-4 rounded mb-6">

<form method="POST" action="{{ route('admin.horarios.store') }}" class="flex gap-3">

@csrf

<input
type="time"
name="hora"
required
class="border rounded p-2">

<button class="bg-white px-4 py-2 rounded hover:bg-gray-200">
Adicionar
</button>

</form>

</div>



{{-- Tabela de horários --}}

<div class="bg-white rounded shadow p-6">

<table class="w-full">

<thead>

<tr class="border-b">

<th class="text-left py-3">
Horário
</th>

<th class="text-center py-3">
Ações
</th>

</tr>

</thead>


<tbody>

@foreach($horarios as $horario)

<tr class="border-b">

<td class="py-3">
{{ $horario->hora }}
</td>

<td>

<div class="flex justify-center gap-2">

{{-- editar --}}

<form method="POST" action="{{ route('admin.horarios.update',$horario->id) }}">

@csrf
@method('PUT')

<input
type="time"
name="hora"
value="{{ $horario->hora }}"
class="border rounded p-1">

<button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
Editar
</button>

</form>


{{-- remover --}}

<form method="POST" action="{{ route('admin.horarios.destroy',$horario->id) }}">

@csrf
@method('DELETE')

<button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
Remover
</button>

</form>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection