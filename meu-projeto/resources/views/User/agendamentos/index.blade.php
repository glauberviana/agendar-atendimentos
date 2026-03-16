<x-app-layout>

<div class="flex min-h-screen bg-[F6F6F6]">

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
{{ auth()->user()->name }}
</h3>

@if($agendamento->descricao)
<p class="text-sm mt-2">
{{ $agendamento->descricao }}
</p>
@endif

<p class="mt-1">
{{ \Carbon\Carbon::parse($agendamento->data)->translatedFormat('d') }} de {{ ucfirst(\Carbon\Carbon::parse($agendamento->data)->locale('pt_BR')->translatedFormat('F')) }} às {{ \Carbon\Carbon::parse($agendamento->hora)->format('H:i') }}
</p>

<div class="flex gap-4 mt-4">

<button
onclick="abrirModal({{ $agendamento->id }}, '{{ $agendamento->data }}', '{{ $agendamento->hora }}', '{{ $agendamento->descricao }}')"
class="bg-[#1E7F5A] px-4 py-1 rounded hover:bg-[#16694a] transition">
Reagendar
</button>

<form method="POST" action="{{ route('agendamentos.destroy', $agendamento->id) }}">
@csrf
@method('DELETE')

<button class="bg-red-500 px-4 py-1 rounded hover:bg-red-900 transition">
Cancelar
</button>

</form>

</div>

</div>

<div>

@if($agendamento->status == 'confirmado')

<span class="px-4 py-1 rounded bg-[#00FF0052] text-black font-semibold">
Confirmado
</span>

@else

<span class="mr-10 px-7 py-2 rounded bg-[#FEF9C2] text-[#944B00] font-semibold">
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


<!-- MODAL REAGENDAR -->

<div id="modalReagendar"
class="hidden fixed inset-0 bg-black bg-opacity-25 backdrop-blur-sm flex items-center justify-center z-50">

<div class="bg-[#269C73] text-white rounded-xl p-8 w-[480px] shadow-2xl">

<h2 class="text-xl font-semibold mb-6">
Reagendar Atendimento
</h2>

<form id="formReagendar" method="POST">
@csrf
@method('PUT')

<div class="space-y-4">

<div>
<label>Data</label>
<input type="date"
name="data"
min="{{ date('Y-m-d') }}"
class="w-full mt-1 border rounded-lg px-3 py-2 text-black">
</div>

<div>
<label>Hora</label>
<input type="time"
name="hora"
class="w-full mt-1 border rounded-lg px-3 py-2 text-black">
</div>

<div>
<label>Descrição</label>
<textarea
name="descricao"
class="w-full mt-1 border rounded-lg px-3 py-2 text-black"></textarea>
</div>

</div>

<div class="flex justify-end gap-4 mt-6">

<button type="button"
onclick="fecharModal()"
class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">
Cancelar
</button>

<button type="submit"
class="px-4 py-2 bg-[#1E7F5A] rounded hover:bg-[#16694a]">
Salvar
</button>

</div>

</form>

</div>

</div>


<script>

function toggleMenu(){
let menu = document.getElementById('menuUser');
menu.classList.toggle('hidden');
}

function abrirModal(id, data, hora, descricao){

let modal = document.getElementById('modalReagendar');

modal.classList.remove('hidden');

document.querySelector('#formReagendar').action = '/agendamentos/' + id;

document.querySelector('[name=data]').value = data;
document.querySelector('[name=hora]').value = hora;
document.querySelector('[name=descricao]').value = descricao;

}

function fecharModal(){
document.getElementById('modalReagendar').classList.add('hidden');
}

</script>

</x-app-layout>
