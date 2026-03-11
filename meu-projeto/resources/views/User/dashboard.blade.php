<x-app-layout>

<div class="flex min-h-screen bg-[#F6F6F6]">

<!-- SIDEBAR -->

<div class="w-80 bg-gradient-to-b from-[#28A279] to-[#18663C] text-white flex flex-col p-6">

<h1 class="text-xl font-bold mb-10">
INSTITUIÇÃO
</h1>

<nav class="space-y-4">

<a href="{{ route('dashboard') }}"
class="flex items-center gap-3 bg-[#1E7F5A] p-3 rounded-lg transition duration-200">

<img src="{{ asset('icons/inicio.svg') }}" class="w-5 h-5">

Início

</a>

<a href="{{ route('agendamentos.create') }}"
class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg transition duration-200">

<img src="{{ asset('icons/agendamento.svg') }}" class="w-5 h-5">

Novo Agendamento

</a>

<a href="#"
class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg transition duration-200">

<img src="{{ asset('icons/meusagendamentos.svg') }}" class="w-5 h-5">

Meus Agendamentos

</a>

</nav>

</div>



<!-- CONTEÚDO -->

<div class="flex-1 flex flex-col">

<!-- TOPO -->

<div class="flex justify-between items-center px-10 pt-10">

<h2 class="text-xl font-semibold text-[#28A279]">
Olá, {{ Auth::user()->name }}
</h2>


<!-- BOLINHA USUÁRIO -->

<div class="relative">

<button onclick="toggleMenu()"
class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold">

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


<!-- LINHA -->

<div class="w-full h-[4px] bg-[#D9D9D9] mt-6"></div>



<!-- CONTEÚDO CENTRAL -->

<div class="flex flex-col items-center p-10">

<!-- CARDS SUPERIORES -->

<div class="flex gap-10 justify-center">


<!-- PRÓXIMO ATENDIMENTO -->

<div class="bg-[#269C73] text-white p-6 rounded-[20px] shadow w-[480px] h-[220px] flex flex-col justify-between">

<h3 class="text-lg font-semibold">
Próximo Atendimento
</h3>

@if($proximoAgendamento)

<p>
Data: {{ $proximoAgendamento->data }} {{ $proximoAgendamento->hora }}
</p>

@if($proximoAgendamento->descricao)
<p class="text-sm">
{{ $proximoAgendamento->descricao }}
</p>
@endif

@else

<p>
Nenhum atendimento
</p>

@endif

<div class="flex gap-4">

<button class="border border-red-500 text-red-500 px-4 py-1 rounded hover:bg-red-500 hover:text-white transition">
Cancelar
</button>

<button class="bg-[#1E7F5A] px-4 py-1 rounded hover:bg-[#16694a] transition">
Reagendar
</button>

</div>

</div>



<!-- AGENDAR NOVO -->

<a href="{{ route('agendamentos.create') }}"
class="bg-[#269C73] text-white p-6 rounded-[20px] shadow w-[480px] h-[220px] flex flex-col items-center justify-center hover:scale-105 transition">

<img src="{{ asset('icons/calendario.svg') }}" class="w-28 h-28 mb-4">

<p class="text-lg font-semibold">
Agendar Novo
</p>

</a>

</div>



<!-- ATENDIMENTOS RECENTES -->

<div class="bg-[#269C73] text-white p-6 rounded-[20px] mt-10 w-[1000px] h-[260px] shadow">

<h3 class="text-lg font-semibold mb-6">
Atendimento Recentes
</h3>

@if($recentes->isEmpty())

<p>Nenhum atendimento recente</p>

@else

<ul class="space-y-3">

@foreach($recentes as $agendamento)

<li>

{{ $agendamento->data }} - {{ $agendamento->hora }}

@if($agendamento->descricao)
<br>
<span class="text-sm">
{{ $agendamento->descricao }}
</span>
@endif

</li>

@endforeach

</ul>

@endif

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