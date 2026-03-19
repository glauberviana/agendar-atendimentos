@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    @foreach($agendamentos as $agendamento)
    <div class="bg-[#269C73] text-white p-6 rounded-xl shadow flex justify-between items-center">
        <div>
            <h2 class="font-semibold text-lg">
                {{ $agendamento->user->name ?? 'Usuário não encontrado' }}
            </h2>

            {{-- Aqui mantemos o 'tipo' para o nome não sumir --}}
            <p class="opacity-90">
                {{ $agendamento->tipo }} {{ $agendamento->descricao ? '- ' . $agendamento->descricao : '' }}
            </p>

            <div class="flex items-center gap-2 text-sm text-green-100 mt-1">
                <img src="{{ asset('icons/historico.svg') }}" class="w-4 h-4">
                <span>
                    {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }} às {{ $agendamento->hora }}
                </span>
            </div>
        </div>

        {{-- Lógica da TAG e dos Botões --}}
        <div class="flex items-center gap-4">
            {{-- MUDANÇA CRUCIAL: Agora verificamos a coluna 'status' --}}
            @if($agendamento->status === 'confirmado')
            <span class="bg-green-400 text-green-900 px-4 py-1 rounded-full font-bold shadow-sm">
                Confirmado
            </span>
            @else
            <span class="bg-yellow-200 text-yellow-800 px-4 py-1 rounded-full font-medium mr-2 shadow-sm border border-yellow-300">
                Pendente
            </span>

            {{-- Botão Aceitar --}}
            <form action="{{ route('admin.atendimentos.confirmar', $agendamento->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-green-500 hover:bg-green-600 p-2 rounded-full transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </form>

            {{-- Botão Recusar --}}
            <form action="{{ route('admin.atendimentos.recusar', $agendamento->id) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 p-2 rounded-full transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </form>
            @endif
        </div>
    </div>
    @endforeach

    @if($agendamentos->isEmpty())
    <p class="text-center text-gray-500 py-10">Nenhum agendamento encontrado.</p>
    @endif
</div>

@endsection