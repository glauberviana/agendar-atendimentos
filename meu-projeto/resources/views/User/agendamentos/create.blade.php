<x-app-layout>

<div class="flex min-h-screen bg-[#D9D9D9]">

<!-- SIDEBAR -->

<div class="w-64 bg-[#237952] text-white flex flex-col p-6">

<h1 class="text-xl font-bold mb-10">
INSTITUIÇÃO
</h1>

<nav class="space-y-4">

<a href="{{ route('dashboard') }}"
class="flex items-center gap-3 hover:bg-[#269C73] p-3 rounded-lg">

Início

</a>

<a href="{{ route('agendamentos.create') }}"
class="flex items-center gap-3 bg-[#269C73] p-3 rounded-lg">

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

<div class="flex-1 p-10">

<h2 class="text-2xl font-semibold text-[#269C73] mb-8">
Novo Agendamento
</h2>

<form method="POST" action="{{ route('agendamentos.store') }}"
class="bg-[#269C73] text-white p-8 rounded-lg w-96">

@csrf

<div class="mb-4">

<label class="block mb-2">
Data
</label>

<input type="date"
name="data"
class="w-full p-2 rounded text-black"
required>

</div>

<div class="mb-4">

<label class="block mb-2">
Hora
</label>

<input type="time"
name="hora"
class="w-full p-2 rounded text-black"
required>

</div>

<div class="mb-6">

<label class="block mb-2">
Descrição
</label>

<textarea
name="descricao"
class="w-full p-2 rounded text-black"></textarea>

</div>

<button class="bg-white text-[#269C73] px-4 py-2 rounded font-semibold hover:bg-gray-200">

Agendar

</button>

</form>

</div>

</div>

</x-app-layout>