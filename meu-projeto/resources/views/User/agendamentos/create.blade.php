<x-app-layout>

<div class="flex min-h-screen bg-gray-300">

<!-- SIDEBAR -->
<div class="w-72 bg-gradient-to-b from-[#28A279] to-[#18663C] text-white flex flex-col p-6">

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
class="flex items-center gap-3 bg-[#1E7F5A] p-3 rounded-lg">

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
<div class="flex flex-1 items-center justify-center">

<!-- CARD CENTRAL -->
<div class="bg-[#269C73] text-white p-10 rounded-xl shadow w-[1000px]">

<h2 class="text-2xl font-semibold mb-6 text-center">
Novo Agendamento
</h2>

<form method="POST" action="{{ route('agendamentos.store') }}" class="space-y-5">

@csrf

<!-- DATA -->
<div>
<label class="block mb-1">
Data
</label>

<input
type="date"
name="data"
required
class="w-full border rounded-lg px-3 py-2 text-black focus:outline-none focus:ring-2 focus:ring-white"
>
</div>

<!-- HORA -->
<div>
<label class="block mb-1">
Hora
</label>

<input
type="time"
name="hora"
required
class="w-full border rounded-lg px-3 py-2 text-black focus:outline-none focus:ring-2 focus:ring-white"
>
</div>

<!-- DESCRIÇÃO -->
<div>
<label class="block mb-1">
Descrição
</label>

<textarea
name="descricao"
rows="3"
class="w-full border rounded-lg px-3 py-2 text-black focus:outline-none focus:ring-2 focus:ring-white"
placeholder="Descreva o motivo do atendimento"
></textarea>
</div>

<!-- BOTÃO -->
<button
type="submit"
class="w-full bg-[#1E7F5A] text-white py-2 rounded-lg hover:bg-[#16694a] transition font-medium"
>
Agendar
</button>

</form>

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