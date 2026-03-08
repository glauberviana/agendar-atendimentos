<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Admin</title>

@vite(['resources/css/app.css','resources/js/app.js'])

</head>


<body class="flex bg-gray-100">


<!-- SIDEBAR -->

<div class="w-64 bg-[#269C73] min-h-screen text-white p-6">

<h1 class="text-xl font-bold mb-8">
INSTITUIÇÃO
</h1>

<nav class="space-y-4">

<a href="{{ route('admin.dashboard') }}" class="block hover:bg-[#2FA37D] p-2 rounded">
Início
</a>

<a href="{{ route('admin.horarios') }}" class="block hover:bg-[#2FA37D] p-2 rounded">
Gerenciar Horário
</a>

<a href="{{ route('admin.agendamentos') }}" class="block hover:bg-[#2FA37D] p-2 rounded">
Todos Agendamentos
</a>

<a href="{{ route('admin.historico') }}" class="block hover:bg-[#2FA37D] p-2 rounded">
Histórico Global
</a>

<a href="{{ route('admin.usuarios') }}" class="block hover:bg-[#2FA37D] p-2 rounded">
Usuários
</a>

</nav>

</div>



<!-- CONTEÚDO -->

<div class="flex-1">

<!-- HEADER -->

<div class="bg-white shadow px-6 py-3 flex justify-end items-center">

<div x-data="{open:false}" class="relative">

<button 
@click="open = !open"
class="flex items-center gap-2 text-gray-700 font-semibold hover:text-black">

<span>
{{ Auth::user()->name }}
</span>

<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
</svg>

</button>


<div 
x-show="open"
@click.away="open=false"
class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg">

<a 
href="{{ route('profile.edit') }}"
class="block px-4 py-2 hover:bg-gray-100">
Perfil
</a>

<form method="POST" action="{{ route('logout') }}">
@csrf

<button class="w-full text-left px-4 py-2 hover:bg-gray-100">
Logout
</button>

</form>

</div>

</div>

</div>


<!-- PAGE -->

<div class="p-8">

@yield('content')

</div>

</div>


</body>
</html>