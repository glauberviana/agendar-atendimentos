@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    {{-- CARDS DE RESUMO --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Total de Usuários --}}
        <div class="bg-[#269C73] text-white p-6 rounded-xl shadow-lg">
            <div class="text-3xl font-bold">
                {{ $totalUsuarios }}
            </div>
            <div class="text-sm opacity-90">
                Alunos Cadastrados
            </div>
        </div>

        {{-- Total de Agendamentos (Geral) --}}
        <div class="bg-[#269C73] text-white p-6 rounded-xl shadow-lg">
            <div class="text-3xl font-bold">
                {{ $totalAgendados }}
            </div>
            <div class="text-sm opacity-90">
                Total de Agendamentos Realizados {{-- Texto corrigido para refletir o total --}}
            </div>
        </div>

        {{-- Atendimentos Concluídos --}}
        <div class="bg-[#269C73] text-white p-6 rounded-xl shadow-lg">
            <div class="text-3xl font-bold">
                {{ $totalConcluidos }}
            </div>
            <div class="text-sm opacity-90">
                Atendimentos Concluídos
            </div>
        </div>

    </div>

    {{-- TABELA DE ATENDIMENTOS DE HOJE --}}
    <div class="bg-[#269C73] p-6 rounded-xl text-white shadow-lg">

        <h3 class="font-semibold mb-4 text-lg">
            Atendimentos de Hoje
        </h3>

        <div class="bg-white rounded-lg overflow-hidden text-black shadow-inner">

            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b text-gray-700 font-semibold">
                    <tr>
                        <th class="text-left px-4 py-3">Aluno</th>
                        <th class="text-left px-4 py-3">Serviço</th>
                        <th class="text-left px-4 py-3">Data</th>
                        <th class="text-left px-4 py-3">Hora</th>
                        <th class="text-center px-4 py-3">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($atendimentosHoje as $atendimento)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium">
                            {{ $atendimento->user->name ?? 'Usuário não encontrado' }}
                        </td>

                        <td class="px-4 py-3 text-gray-600">
                            {{ $atendimento->tipo }}
                        </td>

                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($atendimento->data)->format('d/m/Y') }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $atendimento->hora }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if($atendimento->status == 'confirmado')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Confirmado
                            </span>
                            @elseif($atendimento->status == 'pendente')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Pendente
                            </span>
                            @elseif($atendimento->status == 'cancelado')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Cancelado
                            </span>
                            @else
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                {{ ucfirst($atendimento->status) }}
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500 italic">
                            Nenhum atendimento marcado para hoje.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

</div>

@endsection