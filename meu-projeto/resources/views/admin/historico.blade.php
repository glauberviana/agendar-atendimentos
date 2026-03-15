@extends('layouts.admin')

@section('content')

<div class="p-8">

<div class="bg-[#269C73] rounded-xl p-8 shadow-lg w-[800px]">

<!-- FILTROS -->
<div class="flex gap-10 mb-6">

<div>
<label class="text-white text-sm block mb-2">
Hora
</label>

<input
type="date"
class="bg-transparent border border-white rounded px-3 py-1 text-white text-sm outline-none"
/>

</div>

<div>
<label class="text-white text-sm block mb-2">
Aluno
</label>

<input
type="text"
placeholder="Nome"
class="bg-transparent border border-white rounded px-3 py-1 text-white text-sm outline-none"
/>

</div>

</div>


<!-- TABELA -->
<div class="border border-white rounded-lg overflow-hidden">

<table class="w-full text-white text-sm">

<thead class="border-b border-white">

<tr class="text-left">

<th class="px-4 py-2">Aluno</th>
<th class="px-4 py-2">Data</th>
<th class="px-4 py-2">Horário</th>
<th class="px-4 py-2">Serviço</th>
<th class="px-4 py-2">Status</th>

</tr>

</thead>


<tbody>

<tr class="border-b border-white/30">

<td class="px-4 py-2">Glauber</td>
<td class="px-4 py-2">23.3.26</td>
<td class="px-4 py-2">11:30</td>
<td class="px-4 py-2">Matrícula</td>

<td class="px-4 py-2">

<span class="bg-green-200 text-green-900 text-xs px-3 py-1 rounded-full">
Confirmado
</span>

</td>

</tr>


<tr class="border-b border-white/30">

<td class="px-4 py-2">Glauber</td>
<td class="px-4 py-2">23.3.26</td>
<td class="px-4 py-2">11:30</td>
<td class="px-4 py-2">Matrícula</td>

<td class="px-4 py-2">

<span class="bg-green-200 text-green-900 text-xs px-3 py-1 rounded-full">
Confirmado
</span>

</td>

</tr>


<tr>

<td class="px-4 py-2">Glauber</td>
<td class="px-4 py-2">23.3.26</td>
<td class="px-4 py-2">11:30</td>
<td class="px-4 py-2">Matrícula</td>

<td class="px-4 py-2">

<span class="bg-green-200 text-green-900 text-xs px-3 py-1 rounded-full">
Confirmado
</span>

</td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

@endsection