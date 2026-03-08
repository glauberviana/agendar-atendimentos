@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">
Dashboard
</h2>

<div class="grid grid-cols-3 gap-6">

<div class="bg-white shadow rounded p-6">
<h3 class="text-gray-500">Horários</h3>
<p class="text-3xl font-bold">
{{ \App\Models\Horario::count() }}
</p>
</div>

<div class="bg-white shadow rounded p-6">
<h3 class="text-gray-500">Usuários</h3>
<p class="text-3xl font-bold">
{{ \App\Models\User::count() }}
</p>
</div>

<div class="bg-white shadow rounded p-6">
<h3 class="text-gray-500">Agendamentos</h3>
<p class="text-3xl font-bold">
0
</p>
</div>

</div>

@endsection