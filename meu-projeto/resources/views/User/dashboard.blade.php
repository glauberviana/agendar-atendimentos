<x-app-layout>

<div class="flex min-h-screen bg-gray-300">

<!-- SIDEBAR -->
<div class="w-72 bg-gradient-to-b from-[#28A279] to-[#18663C] text-white flex flex-col p-6">

<h1 class="text-xl font-bold mb-10">
INSTITUIÇÃO
</h1>

<nav class="space-y-4">

<a href="{{ route('dashboard') }}"
class="flex items-center gap-3 bg-[#1E7F5A] p-3 rounded-lg">

<img src="{{ asset('icons/inicio.svg') }}" class="w-5 h-5">
Início
</a>

<a href="{{ route('agendamentos.create') }}"
class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg">

<img src="{{ asset('icons/agendamento.svg') }}" class="w-5 h-5">
Novo Agendamento
</a>

<a href="{{ route('agendamentos.index') }}"
class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg">

<img src="{{ asset('icons/meusagendamentos.svg') }}" class="w-5 h-5">
Meus Agendamentos
</a>

</nav>

</div>



<!-- ÁREA PRINCIPAL -->
<div class="flex-1 flex flex-col">

<!-- HEADER -->
<div class="flex justify-between items-center bg-white border-b border-gray-200 px-8 h-[70px]">

<h2 class="text-[#28A279] font-semibold text-lg">
Olá, {{ Auth::user()->name }}
</h2>

<div class="relative">

<button onclick="toggleMenu()"
class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center font-semibold">

{{ strtoupper(substr(Auth::user()->name,0,1)) }}

</button>

<div id="menuUser"
class="hidden absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow">

<a href="{{ route('profile.edit') }}"
class="block px-4 py-2 hover:bg-gray-100">
Perfil
</a>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit"
class="w-full text-left px-4 py-2 hover:bg-gray-100">
Sair
</button>
</form>

</div>

</div>

</div>



<!-- CONTEÚDO -->
<div class="flex flex-col items-center px-10 py-10 gap-10">

<!-- CARDS -->
<div class="grid grid-cols-2 gap-8 w-full max-w-6xl">

<!-- PRÓXIMO ATENDIMENTO -->
<div class="bg-[#269C73] text-white p-6 rounded-xl shadow flex flex-col justify-between min-h-[200px]">

<h3 class="text-lg font-semibold mb-2">
Próximo Atendimento
</h3>

@if($proximoAgendamento)

<p>
Data: {{ $proximoAgendamento->data }} às {{ $proximoAgendamento->hora }}
</p>

@if($proximoAgendamento->descricao)
<p class="text-sm mt-2">
{{ $proximoAgendamento->descricao }}
</p>
@endif

@else

<p>Nenhum atendimento</p>

@endif

<div class="flex gap-4 mt-4">

<button class=" bg-red-500 text-white px-4 py-1 rounded hover:bg-red-900 transition">
Cancelar
</button>

<button class="bg-[#1E7F5A] px-4 py-1 rounded hover:bg-[#16694a] transition">
Reagendar
</button>

</div>

</div>



<!-- AGENDAR NOVO -->
<a href="{{ route('agendamentos.create') }}"
class="bg-[#269C73] text-white p-6 rounded-xl shadow flex flex-col items-center justify-center hover:scale-105 transition min-h-[200px]">

<img src="{{ asset('icons/calendario.svg') }}" class="w-20 mb-4">

<p class="text-lg font-semibold">
Agendar Novo
</p>

</a>

</div>



<!-- ATENDIMENTOS RECENTES -->
<div class="bg-[#269C73] text-white p-6 rounded-xl shadow w-full max-w-6xl">

<h3 class="text-lg font-semibold mb-6">
Atendimentos Recentes
</h3>

@if($recentes->isEmpty())

<p>Nenhum atendimento recente</p>

@else

<table class="w-full bg-white text-black rounded-xl overflow-hidden">

<thead class="bg-gray-100">
<tr>
<th class="p-3  text-center">Data</th>
<th class="p-3  text-center">Hora</th>
<th class="p-3 text-center">Descrição</th>
</tr>
</thead>

<tbody>

@foreach($recentes as $agendamento)

<tr class="border-t">

<td class="p-3 text-center">
{{ $agendamento->data }}
</td>

<td class="p-3 text-center">
{{ $agendamento->hora }}
</td>

<td class="p-3 text-center">
{{ $agendamento->descricao }}
</td>

</tr>

@endforeach

</tbody>

</table>

@endif

</div>

</div>

</div>

</div>


<script>

function toggleMenu(){
let menu = document.getElementById('menuUser');
menu.classList.toggle('hidden');
}

</script>

</x-app-layout>