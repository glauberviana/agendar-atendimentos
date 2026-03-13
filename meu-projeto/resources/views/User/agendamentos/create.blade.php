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
class="flex items-center gap-3 bg-[#1E7F5A] p-3 rounded-lg transition duration-200">

<img src="{{ asset('icons/agendamento.svg') }}" class="w-5 h-5">

Novo Agendamento

</a>

<a href="{{ route('agendamentos.index') }}"
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

<div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold">
{{ strtoupper(substr(Auth::user()->name,0,1)) }}
</div>

</div>


<!-- LINHA -->

<div class="w-full h-[4px] bg-[#D9D9D9] mt-6"></div>



<!-- CONTEÚDO CENTRAL -->

<div class="flex flex-col items-center p-10">

<h2 class="text-2xl font-semibold text-[#28A279] mb-10">
Selecionar Data e Horário
</h2>



<div class="flex gap-12">

<!-- CALENDÁRIO (FAKE) -->

<div class="bg-[#269C73] w-[500px] h-[350px] rounded-[20px] flex items-center justify-center text-white text-xl font-semibold">

Calendário

</div>



<!-- HORÁRIOS -->

<div class="bg-[#269C73] w-[300px] rounded-[20px] p-6 text-white">

<h3 class="text-lg font-semibold mb-6">
Horário
</h3>


<div class="grid grid-cols-2 gap-4">

<button class="bg-[#1E7F5A] p-3 rounded-lg">
08:00
<br>
<span class="text-xs">Disponível</span>
</button>

<button class="bg-[#1E7F5A] p-3 rounded-lg">
09:00
<br>
<span class="text-xs">Disponível</span>
</button>

<button class="bg-[#14543A] p-3 rounded-lg">
10:00
<br>
<span class="text-xs">Selecionado</span>
</button>

<button class="bg-gray-500 p-3 rounded-lg">
11:00
<br>
<span class="text-xs">Ocupado</span>
</button>

<button class="bg-[#1E7F5A] p-3 rounded-lg col-span-2">
14:00
<br>
<span class="text-xs">Disponível</span>
</button>

</div>

</div>

</div>



<!-- BOTÃO CONFIRMAR -->

<div class="flex justify-end w-[850px] mt-12">

<button class="bg-[#1E7F5A] text-white px-8 py-3 rounded-lg hover:bg-[#14543A] transition">

Confirmar

</button>

</div>


</div>

</div>

</div>

</x-app-layout>