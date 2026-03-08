<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Painel Admin</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

{{-- MENU LATERAL --}}
<div class="w-64 bg-green-700 text-white p-6">

<h2 class="text-xl font-bold mb-8">
INSTITUIÇÃO
</h2>

<ul class="space-y-3">

<li>
<a href="{{ route('admin.dashboard') }}" class="block hover:bg-green-600 p-2 rounded">
Início
</a>
</li>

<li>
<a href="{{ route('admin.horarios') }}" class="block hover:bg-green-600 p-2 rounded">
Gerenciar Horários
</a>
</li>

<li>
<a href="#" class="block hover:bg-green-600 p-2 rounded">
Todos Agendamentos
</a>
</li>

<li>
<a href="#" class="block hover:bg-green-600 p-2 rounded">
Histórico Global
</a>
</li>

<li>
<a href="#" class="block hover:bg-green-600 p-2 rounded">
Usuários
</a>
</li>

</ul>

</div>

{{-- CONTEÚDO --}}
<div class="flex-1">

{{-- TOPO --}}
<div class="bg-white shadow p-4 flex justify-between items-center">

<h1 class="font-semibold">
Painel Administrativo
</h1>

<div class="flex items-center gap-4">


<div class="relative">

<button onclick="toggleMenu()" class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded hover:bg-gray-200">

<img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
class="w-8 h-8 rounded-full">

<span class="font-medium text-sm">
{{ auth()->user()->name }}
</span>

</button>


<div id="menuUsuario"
class="hidden absolute right-0 mt-2 w-40 bg-white shadow rounded">

<a href="{{ route('profile.edit') }}"
class="block px-4 py-2 hover:bg-gray-100">
Perfil
</a>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button
class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-500">
Logout
</button>
</form>

</div>

</div>

</div>

</div>

{{-- CONTEÚDO DAS PÁGINAS --}}
<div class="p-6">

@yield('content')

</div>

</div>
<script>

function toggleMenu(){

let menu = document.getElementById("menuUsuario")

menu.classList.toggle("hidden")

}

</script>
</div>

</body>
</html>