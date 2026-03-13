<x-app-layout>

<div class="flex min-h-screen bg-[#F6F6F6]">

<!-- SIDEBAR -->

<div class="w-80 bg-gradient-to-b from-[#28A279] to-[#18663C] text-white flex flex-col p-6">

<h1 class="text-xl font-bold mb-10">
INSTITUIÇÃO
</h1>

<nav class="space-y-4">

<a href="{{ route('dashboard') }}"
class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg transition duration-200">

<img src="{{ asset('icons/inicio.svg') }}" class="w-5 h-5">
Início

</a>

<a href="{{ route('agendamentos.create') }}"
class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg transition duration-200">

<img src="{{ asset('icons/agendamento.svg') }}" class="w-5 h-5">
Novo Agendamento

</a>

<a href="#"
class="flex items-center gap-3 bg-[#1E7F5A] p-3 rounded-lg transition duration-200">

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

<div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold">
{{ strtoupper(substr(Auth::user()->name,0,1)) }}
</div>

</div>


<!-- LINHA -->

<div class="w-full h-[4px] bg-[#D9D9D9] mt-6"></div>



<!-- CONTEÚDO CENTRAL -->

<div class="flex flex-col items-center p-10 space-y-10">


<!-- CARD AGENDAMENTO -->

<div class="bg-[#269C73] text-white w-[900px] p-6 rounded-[20px] flex justify-between items-center shadow">

<div>

<h3 class="text-lg font-semibold">
Atendimento Acadêmico
</h3>

<p class="mt-2">
21 Ago, 18:30
</p>

<p class="mt-2">
Status: Confirmado
</p>

<div class="flex gap-4 mt-4">

<button class="bg-[#1E7F5A] px-4 py-1 rounded hover:bg-[#14543A]">
Reagendar
</button>

<button class="border border-red-500 text-red-500 px-4 py-1 rounded hover:bg-red-500 hover:text-white">
Cancelar
</button>

</div>

</div>


<div class="px-4 py-2 rounded font-semibold text-green-400 bg-[#00FF0052]">
Confirmado
</div>

</div>



<!-- CARD AGENDAMENTO 2 -->

<div class="bg-[#269C73] text-white w-[900px] p-6 rounded-[20px] flex justify-between items-center shadow">

<div>

<h3 class="text-lg font-semibold">
Atendimento Acadêmico
</h3>

<p class="mt-2">
21 Ago, 18:30
</p>

<p class="mt-2">
Status: Pendente
</p>

<div class="flex gap-4 mt-4">

<button class="border border-white px-4 py-1 rounded text-white hover:bg-white hover:text-[#269C73] transition">
Ver Detalhes
</button>

<button class="border border-red-500 text-red-500 px-4 py-1 rounded hover:bg-red-500 hover:text-white">
Cancelar
</button>

</div>

</div>


<div class="px-4 py-2 rounded font-semibold text-yellow-300 bg-[#FFCC0052]">
Pendente
</div>

</div>



</div>

</div>

</div>

</div>

</x-app-layout>