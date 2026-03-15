@extends('layouts.admin')

@section('content')


<div class="space-y-6">

<!-- CARD CONFIRMADO -->
<div class="bg-[#269C73] text-white p-6 rounded-xl shadow flex justify-between items-center">

<div>

<h2 class="font-semibold text-lg">
Usuário
</h2>

<p class="opacity-90">
Descrição
</p>

<div class="flex items-center gap-2 text-sm text-green-100 mt-1">

<img src="{{ asset('icons/historico.svg') }}" class="w-4 h-4">

<span>
23 de Março às 23:31
</span>

</div>

</div>

<span class="bg-green-200 text-green-800 px-4 py-1 rounded-full font-medium">
Confirmado
</span>

</div>



<!-- CARD PENDENTE -->
<div class="bg-[#269C73] text-white p-6 rounded-xl shadow flex justify-between items-center">

<div>

<h2 class="font-semibold text-lg">
Usuário
</h2>

<p class="opacity-90">
Descrição
</p>

<div class="flex items-center gap-2 text-sm text-green-100 mt-1">

<img src="{{ asset('icons/historico.svg') }}" class="w-4 h-4">

<span>
23 de Março às 23:31
</span>

</div>

</div>

<div class="flex items-center gap-4">

<span class="bg-yellow-200 text-yellow-800 px-4 py-1 rounded-full font-medium">
Pendente
</span>

<button class="bg-green-500 hover:bg-green-600 p-2 rounded-full">

<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M5 13l4 4L19 7"/>
</svg>

</button>

<button class="bg-red-500 hover:bg-red-600 p-2 rounded-full">

<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M6 18L18 6M6 6l12 12"/>
</svg>

</button>

</div>

</div>

</div>

@endsection