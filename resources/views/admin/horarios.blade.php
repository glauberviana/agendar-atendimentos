@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto">

<h1 class="text-2xl font-bold mb-6">
Gerenciar Horários
</h1>


{{-- MENSAGENS --}}

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4 border border-green-300">
{{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="bg-red-100 text-red-700 p-3 rounded mb-4 border border-red-300">
{{ $errors->first() }}
</div>
@endif


{{-- CARD ADICIONAR HORÁRIO --}}

<div class="bg-[#269C73] p-6 rounded-lg mb-8 text-white">

<h2 class="font-semibold mb-4">
Adicionar novo horário
</h2>

<form method="POST" action="{{ route('admin.horarios.store') }}" class="flex items-center gap-4">

@csrf

<input
type="time"
name="hora"
required
class="text-black p-2 rounded border w-40">

<button class="bg-white text-[#269C73] px-6 py-2 rounded font-semibold hover:bg-gray-200 transition">
Adicionar
</button>

</form>

</div>



{{-- CARD TABELA --}}

<div class="bg-white shadow rounded-lg">

<div class="p-4 border-b">

<h2 class="font-semibold text-gray-700">
Horários Cadastrados
</h2>

</div>


<table class="w-full text-sm">

<thead class="bg-gray-100">

<tr>

<th class="p-4 text-center">
Horário
</th>

<th class="p-4 text-center">
Ações
</th>

</tr>

</thead>


<tbody>

@foreach($horarios as $horario)

<tr class="border-t hover:bg-gray-50">

<td class="p-4 text-center font-medium text-gray-700">
{{ $horario->hora }}
</td>

<td class="p-4">

<div class="flex justify-center items-center gap-3">

<form method="POST" action="{{ route('admin.horarios.update',$horario->id) }}" class="flex items-center gap-2">

@csrf
@method('PUT')

<input
type="time"
name="hora"
value="{{ $horario->hora }}"
class="border p-1 rounded text-black">

<button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
Editar
</button>

</form>


<form method="POST" action="{{ route('admin.horarios.destroy',$horario->id) }}">

@csrf
@method('DELETE')

<button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
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

</div>

@endsection