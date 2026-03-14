<x-app-layout>

<div class="flex min-h-screen bg-gray-300">

<!-- SIDEBAR -->
<div class="w-72 h-screen fixed bg-gradient-to-b from-[#28A279] to-[#18663C] text-white flex flex-col p-6">

<h1 class="text-xl font-bold mb-10">
INSTITUIÇÃO
</h1>

<nav class="space-y-4">

<a href="{{ route('dashboard') }}"
class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg">

<img src="{{ asset('icons/inicio.svg') }}" class="w-5 h-5">
Início
</a>

<a href="{{ route('agendamentos.create') }}"
class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg">

<img src="{{ asset('icons/agendamento.svg') }}" class="w-5 h-5">
Novo Agendamento
</a>

<a href="{{ route('agendamentos.index') }}"
class="flex items-center gap-3 bg-[#1E7F5A] p-3 rounded-lg">

<img src="{{ asset('icons/meusagendamentos.svg') }}" class="w-5 h-5">
Meus Agendamentos
</a>

</nav>

</div>



<!-- ÁREA PRINCIPAL -->
<div class="flex-1 flex flex-col">

<!-- HEADER -->
<div class="fixed top-0 left-72 right-0 flex justify-between items-center bg-white border-b border-gray-200 px-8 h-[70px] z-10">

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
<div class="flex flex-col items-center px-10 py-10 gap-6 ml-72">

<h2 class="text-2xl font-semibold text-[#28A279]">
Meus Agendamentos
</h2>

@if($agendamentos->isEmpty())

<p class="text-gray-700">
Você ainda não possui agendamentos.
</p>

@else

<div class="flex flex-col gap-6 w-full max-w-5xl">

@foreach($agendamentos as $agendamento)

<div class="bg-[#269C73] text-white p-6 rounded-xl shadow flex justify-between items-center">

<div>

<h3 class="font-semibold text-lg">
Atendimento Acadêmico
</h3>

<p class="mt-1">
{{ $agendamento->data }} às {{ $agendamento->hora }}
</p>

@if($agendamento->descricao)
<p class="text-sm mt-2">
{{ $agendamento->descricao }}
</p>
@endif

<div class="flex gap-4 mt-4">

<button class="bg-[#1E7F5A] px-4 py-1 rounded hover:bg-[#16694a] transition">
Reagendar
</button>

<button class="bg-red-500 px-4 py-1 rounded hover:bg-red-900 transition">
Cancelar
</button>

</div>

</div>


<!-- STATUS -->

<div>

@if($agendamento->status == 'confirmado')

<span class="px-4 py-1 rounded bg-[#00FF0052] text-black font-semibold">
Confirmado
</span>

@else

<span class="px-4 py-1 rounded bg-[#FFCC0052] text-black font-semibold">
Pendente
</span>

@endif

</div>

</div>

@endforeach

</div>

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