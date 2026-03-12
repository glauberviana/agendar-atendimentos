<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Painel Admin</title>

@vite(['resources/css/app.css','resources/js/app.js'])

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>

body{
font-family:'Inter',sans-serif;
}

</style>

</head>



<body class="bg-[#F3F4F6]">


<div class="flex min-h-screen">


{{-- SIDEBAR --}}
<div class="w-64 bg-gradient-to-b from-[#269C73] to-[#1A6B41] text-white">


<div class="px-6 py-6 text-lg font-semibold">

INSTITUIÇÃO

</div>



<nav class="px-3 space-y-2">


<a href="{{ route('admin.dashboard') }}"
class="flex items-center gap-3 px-4 py-3 rounded-lg bg-[#1F7F5C]">

<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
fill="none" viewBox="0 0 24 24" stroke="currentColor">

<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-4a2 2 0 01-2-2V12H9v8a2 2 0 01-2 2H3z"/>

</svg>

Início

</a>



<a href="{{ route('admin.atendimentos') }}"
class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#1F7F5C]">

<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
fill="none" viewBox="0 0 24 24" stroke="currentColor">

<path stroke-linecap="round" stroke-linejoin="round"
stroke-width="2"
d="M8 7V3m8 4V3m-9 8h10m-11
8h12a2 2 0 002-2V7a2 2 0
00-2-2H6a2 2 0 00-2
2v10a2 2 0 002 2z"/>

</svg>

Gerenciar Atendimentos

</a>



<a href="#"
class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#1F7F5C]">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-5 h-5" fill="none"
viewBox="0 0 24 24" stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M9 12h6m-6 4h6M7
3h10a2 2 0 012 2v14a2
2 0 01-2 2H7a2 2 0
01-2-2V5a2 2 0 012-2z"/>

</svg>

Histórico Global

</a>


</nav>


</div>



{{-- CONTEUDO --}}
<div class="flex-1">



{{-- TOPBAR --}}
<div class="flex justify-between items-center px-8 py-4 border-b bg-white">


<h2 class="font-medium text-gray-700">

Olá, {{ Auth::user()->name }}

</h2>



{{-- PERFIL --}}
<div class="relative">


<button onclick="togglePerfil()"
class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center font-semibold">

{{ strtoupper(substr(Auth::user()->name,0,1)) }}

</button>



{{-- MENU PERFIL --}}
<div id="menuPerfil"
class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-md">


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



{{-- PAGINA --}}
<div class="p-8">

@yield('content')

</div>



</div>


</div>



<script>

function togglePerfil(){

let menu = document.getElementById("menuPerfil");

menu.classList.toggle("hidden");

}

</script>


</body>
</html>