<x-app-layout>

<div class="flex min-h-screen bg-[#D9D9D9]">

<!-- SIDEBAR -->

<div class="w-64 bg-[#237952] text-white flex flex-col p-6">

<h1 class="text-xl font-bold mb-10">
INSTITUIÇÃO
</h1>

<nav class="space-y-4">

<a href="{{ route('dashboard') }}"
class="flex items-center gap-3 bg-[#269C73] p-3 rounded-lg">

Início

</a>

<a href="{{ route('agendamentos.create') }}"
class="flex items-center gap-3 hover:bg-[#269C73] p-3 rounded-lg">

Novo Agendamento

</a>

<a href="#"
class="flex items-center gap-3 hover:bg-[#269C73] p-3 rounded-lg">

Meus Agendamentos

</a>

<a href="#"
class="flex items-center gap-3 hover:bg-[#269C73] p-3 rounded-lg">

Histórico Global

</a>

</nav>

</div>


<!-- CONTEÚDO -->

<div class="flex-1 flex flex-col items-center p-10">

<!-- TOPO -->

<div class="w-full max-w-5xl flex justify-between items-center mb-6">

<h2 class="text-xl font-semibold text-[#269C73]">
Olá, {{ Auth::user()->name }}
</h2>

<div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold">
{{ strtoupper(substr(Auth::user()->name,0,1)) }}
</div>

</div>

<hr class="w-full max-w-5xl mb-10">

<!-- CARDS CENTRAIS -->

<div class="grid grid-cols-2 gap-8 w-full max-w-5xl">

<!-- PRÓXIMO ATENDIMENTO -->

<div class="bg-[#269C73] text-white p-6 rounded-lg shadow">

<h3 class="font-semibold text-lg mb-4">
Próximo Atendimento
</h3>

@if($agendamentos->first())

<p class="mb-4">
Data: {{ $agendamentos->first()->data }} {{ $agendamentos->first()->hora }}
</p>

@else

<p class="mb-4">
Nenhum agendamento
</p>

@endif

<div class="flex gap-3">

<button class="border border-white px-4 py-1 rounded">
Cancelar
</button>

<button class="border border-white px-4 py-1 rounded">
Reagendar
</button>

</div>

</div>


<!-- AGENDAR NOVO -->

<a href="{{ route('agendamentos.create') }}"
class="bg-[#269C73] text-white p-6 rounded-lg flex flex-col items-center justify-center shadow hover:scale-105 transition">

<div class="text-6xl mb-4">
📅
</div>

<p class="font-semibold text-lg">
Agendar Novo
</p>

</a>

</div>


<!-- ATENDIMENTOS RECENTES -->

<div class="bg-[#269C73] text-white p-6 rounded-lg mt-10 w-full max-w-5xl shadow">

<h3 class="font-semibold text-lg mb-4">
Atendimentos Recentes
</h3>

@if($agendamentos->isEmpty())

<p>Nenhum atendimento recente</p>

@else

<ul>

@foreach($agendamentos as $agendamento)

<li class="mb-2">
{{ $agendamento->data }} - {{ $agendamento->hora }}
</li>

@endforeach

</ul>

@endif

</div>

</div>

</div>

</x-app-layout>