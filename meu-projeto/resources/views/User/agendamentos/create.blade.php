<x-app-layout>

    <div class="flex min-h-screen bg-[#F6F6F6]">

        <div class="w-72 bg-gradient-to-b from-[#28A279] to-[#18663C] text-white flex flex-col p-6">
            <h1 class="text-xl font-bold mb-10">INSTITUIÇÃO</h1>

            <nav class="space-y-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg transition">
                    <img src="{{ asset('icons/inicio.svg') }}" class="w-5 h-5"> Início
                </a>

                <a href="{{ route('agendamentos.create') }}" class="flex items-center gap-3 bg-[#1E7F5A] p-3 rounded-lg transition">
                    <img src="{{ asset('icons/agendamento.svg') }}" class="w-5 h-5"> Novo Agendamento
                </a>

                <a href="{{ route('agendamentos.index') }}" class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg transition">
                    <img src="{{ asset('icons/meusagendamentos.svg') }}" class="w-5 h-5"> Meus Agendamentos
                </a>
            </nav>
        </div>

        <div class="flex-1 flex flex-col">

            <div class="flex justify-between items-center bg-white border-b border-gray-200 px-8 h-[70px]">
                <h2 class="text-[#28A279] font-semibold text-lg">Olá, {{ Auth::user()->name }}</h2>
                <div class="relative">
                    <button onclick="toggleMenu()" class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center font-semibold z-20 relative">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </button>
                    <div id="menuUser" class="hidden absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow z-30">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Sair</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex flex-1 items-center justify-center p-4">
                <div class="bg-[#269C73] text-white p-10 rounded-xl shadow w-full max-w-[1000px]">
                    <h2 class="text-2xl font-semibold mb-6 text-center">Novo Agendamento</h2>

                    <form method="POST" action="{{ route('agendamentos.store') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block mb-1">Data</label>
                            <input
                                type="date"
                                name="data"
                                id="inputData"
                                min="{{ \Carbon\Carbon::now('America/Sao_Paulo')->format('Y-m-d') }}"
                                value="{{ old('data', \Carbon\Carbon::now('America/Sao_Paulo')->format('Y-m-d')) }}"
                                required
                                class="w-full border rounded-lg px-3 py-2 text-[#1E7F5A] focus:outline-none focus:ring-2 focus:ring-white">
                        </div>

                        <div>
                            <label class="block mb-1">Hora</label>
                            <input
                                type="time"
                                name="hora"
                                id="inputHora"
                                value="{{ old('hora') }}"
                                required
                                class="w-full border rounded-lg px-3 py-2 text-[#1E7F5A] focus:outline-none focus:ring-2 focus:ring-white">
                        </div>

                        <div>
                            <label class="block mb-1">Tipo de Atendimento</label>
                            <select name="tipo" id="tipo" onchange="toggleDescricao()" required class="w-full border rounded-lg px-3 py-2 text-[#1E7F5A] focus:outline-none focus:ring-2 focus:ring-white">
                                <option value="" disabled selected hidden>Selecione</option>
                                <option value="Matrícula inicial">Matrícula inicial</option>
                                <option value="Rematrícula">Rematrícula</option>
                                <option value="Trancamento de matrícula">Trancamento de matrícula</option>
                                <option value="Ajuste de grade curricular">Ajuste de grade curricular</option>
                                <option value="Solicitação de histórico escolar">Solicitação de histórico escolar</option>
                                <option value="Declaração de matrícula">Declaração de matrícula</option>
                                <option value="Colação de grau">Colação de grau</option>
                                <option value="Outros">Outros</option> {{-- Adicionado aqui --}}
                            </select>
                        </div>

                        <div id="campoDescricao" class="hidden">
                            <label class="block mb-1">Descrição</label>
                            <textarea name="descricao" rows="3" class="w-full border rounded-lg px-3 py-2 text-black focus:outline-none focus:ring-2 focus:ring-white" placeholder="Descreva o motivo do atendimento">{{ old('descricao') }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-[#1E7F5A] text-white py-2 rounded-lg hover:bg-[#16694a] transition font-medium">
                            Agendar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            document.getElementById('menuUser').classList.toggle('hidden');
        }

        function toggleDescricao() {
            const tipo = document.getElementById('tipo').value;
            const campo = document.getElementById('campoDescricao');
            campo.classList.toggle('hidden', tipo !== 'Outros');
        }

        // --- LÓGICA DE HORA DINÂMICA ---
        const inputData = document.getElementById('inputData');
        const inputHora = document.getElementById('inputHora');

        function atualizarMinimoHora() {
            const agora = new Date();
            // Formata data atual do PC (YYYY-MM-DD)
            const hojeNoPC = agora.getFullYear() + '-' + 
                           String(agora.getMonth() + 1).padStart(2, '0') + '-' + 
                           String(agora.getDate()).padStart(2, '0');
            
            if (inputData.value === hojeNoPC) {
                // Se for hoje, a hora mínima é AGORA (HH:MM)
                const horas = String(agora.getHours()).padStart(2, '0');
                const minutos = String(agora.getMinutes()).padStart(2, '0');
                inputHora.min = `${horas}:${minutos}`;
            } else {
                // Se for outra data, libera qualquer horário
                inputHora.min = "00:00";
            }
        }

        // Monitora mudanças na data e roda ao carregar
        inputData.addEventListener('change', atualizarMinimoHora);
        window.addEventListener('load', atualizarMinimoHora);
    </script>

    <style>
        select { background-color: white; color: black; }
        option:checked { background-color: #269C73; color: white; }
    </style>

</x-app-layout>