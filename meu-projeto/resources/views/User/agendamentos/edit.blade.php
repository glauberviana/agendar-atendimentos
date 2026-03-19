<x-app-layout>

    <div class="flex min-h-screen bg-[#F6F6F6]">

        <div class="w-72 bg-gradient-to-b from-[#28A279] to-[#18663C] text-white flex flex-col p-6">
            <h1 class="text-xl font-bold mb-10 text-center uppercase tracking-wider">
                INSTITUIÇÃO
            </h1>

            <nav class="space-y-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg transition">
                    <img src="{{ asset('icons/inicio.svg') }}" class="w-5 h-5">
                    Início
                </a>

                <a href="{{ route('agendamentos.create') }}" class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg transition">
                    <img src="{{ asset('icons/agendamento.svg') }}" class="w-5 h-5">
                    Novo Agendamento
                </a>

                <a href="{{ route('agendamentos.index') }}" class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg transition">
                    <img src="{{ asset('icons/meusagendamentos.svg') }}" class="w-5 h-5">
                    Meus Agendamentos
                </a>
            </nav>
        </div>

        <div class="flex-1 flex flex-col">

            <div class="flex justify-between items-center bg-white border-b border-gray-200 px-8 h-[70px]">
                <h2 class="text-[#28A279] font-semibold text-lg">
                    Olá, {{ Auth::user()->name }}
                </h2>
                
                <button class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center font-semibold">
                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                </button>
            </div>

            <div class="flex flex-1 items-center justify-center p-6">

                <div class="bg-[#269C73] text-white p-10 rounded-xl shadow-2xl w-full max-w-[800px]">

                    <h2 class="text-2xl font-semibold mb-6 text-center">
                        Reagendar Atendimento
                    </h2>

                    {{-- EXIBIÇÃO DE ERROS (Importante para o usuário saber se o horário está ocupado) --}}
                    @if ($errors->any())
                        <div class="mb-5 bg-red-500 text-white p-4 rounded-lg shadow">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('agendamentos.update', $agendamento->id) }}" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block mb-1 font-medium">Data</label>
                            <input
                                type="date"
                                name="data"
                                {{-- Impede o reagendamento para datas que já passaram --}}
                                min="{{ \Carbon\Carbon::now('America/Sao_Paulo')->toDateString() }}"
                                value="{{ old('data', $agendamento->data) }}"
                                required
                                class="w-full border rounded-lg px-3 py-2 text-black focus:ring-2 focus:ring-white outline-none">
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Hora</label>
                            <input
                                type="time"
                                name="hora"
                                value="{{ old('hora', $agendamento->hora) }}"
                                required
                                class="w-full border rounded-lg px-3 py-2 text-black focus:ring-2 focus:ring-white outline-none">
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Descrição / Motivo da alteração</label>
                            <textarea
                                name="descricao"
                                rows="3"
                                class="w-full border rounded-lg px-3 py-2 text-black focus:ring-2 focus:ring-white outline-none"
                                placeholder="Descreva o motivo do reagendamento">{{ old('descricao', $agendamento->descricao) }}</textarea>
                        </div>

                        <div class="pt-2">
                            <button
                                type="submit"
                                class="w-full bg-[#1E7F5A] text-white py-3 rounded-lg hover:bg-[#16694a] transition font-bold uppercase tracking-wider shadow-md">
                                Salvar Alterações
                            </button>
                            
                            <a href="{{ route('agendamentos.index') }}" class="block text-center mt-4 text-sm opacity-80 hover:opacity-100 transition">
                                Cancelar e voltar
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>