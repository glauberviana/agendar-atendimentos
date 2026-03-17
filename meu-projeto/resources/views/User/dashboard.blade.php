<x-app-layout>

    <div class="flex min-h-screen bg-[F6F6F6]">

        <!-- SIDEBAR -->
        <div class="w-72 bg-gradient-to-b from-[#28A279] to-[#18663C] text-white flex flex-col p-6">

            <h1 class="text-xl font-bold mb-10">
                INSTITUIÇÃO
            </h1>

            <nav class="space-y-4">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 bg-[#1E7F5A] p-3 rounded-lg">
                    <img src="{{ asset('icons/inicio.svg') }}" class="w-5 h-5">
                    Início
                </a>

                <a href="{{ route('agendamentos.create') }}"
                    class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg">
                    <img src="{{ asset('icons/agendamento.svg') }}" class="w-5 h-5">
                    Novo Agendamento
                </a>

                <a href="{{ route('agendamentos.index') }}"
                    class="flex items-center gap-3 hover:bg-[#1E7F5A] p-3 rounded-lg">
                    <img src="{{ asset('icons/meusagendamentos.svg') }}" class="w-5 h-5">
                    Meus Agendamentos
                </a>

            </nav>

        </div>



        <!-- ÁREA PRINCIPAL -->
        <div class="flex-1 flex flex-col">

            <!-- HEADER -->
            <div class="flex justify-between items-center bg-white border-b border-gray-200 px-8 h-[70px]">

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
            <div class="flex flex-col items-center px-10 py-10 gap-10">

                <div class="grid grid-cols-2 gap-8 w-full max-w-6xl">
                    <div class="bg-[#269C73] text-white p-6 rounded-xl shadow flex flex-col justify-between min-h-[200px]">

                        <h3 class="text-lg font-semibold mb-2">
                            Próximo Atendimento
                        </h3>

                        @if($proximoAgendamento)

                        <h4 class="text-xl font-semibold">
                            @if($proximoAgendamento->tipo == 'Outros' && $proximoAgendamento->descricao)
                            {{ $proximoAgendamento->descricao }}
                            @else
                            {{ $proximoAgendamento->tipo }}
                            @endif
                        </h4>


                        @if($proximoAgendamento->tipo != 'Outros' && $proximoAgendamento->descricao)
                        <p class="text-sm mt-2">
                            {{ $proximoAgendamento->descricao }}
                        </p>
                        @endif

                        <p class="mt-2">
                            {{ \Carbon\Carbon::parse($proximoAgendamento->data)->translatedFormat('d') }} de
                            {{ ucfirst(\Carbon\Carbon::parse($proximoAgendamento->data)->locale('pt_BR')->translatedFormat('F')) }}
                            às {{ \Carbon\Carbon::parse($proximoAgendamento->hora)->format('H:i') }}
                        </p>

                        <div class="flex gap-4 mt-4">

                            <form method="POST" action="{{ route('agendamentos.destroy', $proximoAgendamento->id) }}">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 px-4 py-1 rounded hover:bg-red-900 transition">
                                    Cancelar
                                </button>
                            </form>


                            <button
                                onclick="abrirModal(
                                    {{ $proximoAgendamento->id }},
                                    '{{ $proximoAgendamento->data }}',
                                    '{{ $proximoAgendamento->hora }}',
                                    '{{ $proximoAgendamento->descricao }}',
                                    '{{ $proximoAgendamento->tipo }}'
                                )"
                                class="bg-[#1E7F5A] px-4 py-1 rounded hover:bg-[#16694a] transition">
                                Reagendar
                            </button>

                        </div>

                        @else

                        <p>Nenhum atendimento</p>

                        @endif

                    </div>



                    <!-- AGENDAR NOVO -->
                    <a href="{{ route('agendamentos.create') }}"
                        class="bg-[#269C73] text-white p-6 rounded-xl shadow flex flex-col items-center justify-center hover:scale-105 transition min-h-[200px]">

                        <img src="{{ asset('icons/calendario.svg') }}" class="w-20 mb-4">

                        <p class="text-lg font-semibold">
                            Agendar Novo
                        </p>

                    </a>

                </div>



                <div class="bg-[#269C73] text-white p-6 rounded-xl shadow w-full max-w-6xl">

                    <h3 class="text-lg font-semibold mb-6">
                        Atendimentos Recentes
                    </h3>

                    @if($recentes->isEmpty())

                    <p>Nenhum atendimento recente</p>

                    @else

                    <table class="w-full bg-white text-black rounded-xl overflow-hidden">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 text-center">Data</th>
                                <th class="p-3 text-center">Hora</th>
                                <th class="p-3 text-center">Tipo</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($recentes as $agendamento)

                            <tr class="border-t">

                                <td class="p-3 text-center">
                                    {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}
                                </td>

                                <td class="p-3 text-center">
                                    {{ \Carbon\Carbon::parse($agendamento->hora)->format('H:i') }}
                                </td>

                                <td class="p-3 text-center">

                                    @if($agendamento->tipo == 'Outros' && $agendamento->descricao)
                                    {{ $agendamento->descricao }}
                                    @else
                                    {{ $agendamento->tipo }}
                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                    @endif

                </div>

            </div>

        </div>

    </div>


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
                        <input type="date" name="data"
                            min="{{ date('Y-m-d') }}"
                            class="w-full mt-1 border rounded-lg px-3 py-2 text-black">
                    </div>

                    <div>
                        <label>Hora</label>
                        <input type="time" name="hora"
                            class="w-full mt-1 border rounded-lg px-3 py-2 text-black">
                    </div>

                    <div>
                        <label>Tipo</label>
                        <select name="tipo"
                            class="w-full mt-1 border rounded-lg px-3 py-2 text-black">
                            <option value="Matrícula inicial">Matrícula inicial</option>
                            <option value="Rematrícula">Rematrícula</option>
                            <option value="Trancamento de matrícula">Trancamento de matrícula</option>
                            <option value="Cancelamento de curso">Cancelamento de curso</option>
                            <option value="Reabertura de matrícula">Reabertura de matrícula</option>
                            <option value="Transferência interna">Transferência interna</option>
                            <option value="Transferência externa">Transferência externa</option>
                            <option value="Aproveitamento de disciplinas">Aproveitamento de disciplinas</option>
                            <option value="Dispensa de disciplinas">Dispensa de disciplinas</option>
                            <option value="Ajuste de grade curricular">Ajuste de grade curricular</option>
                            <option value="Inclusão/Exclusão de disciplinas">Inclusão/Exclusão de disciplinas</option>
                            <option value="Revisão de notas">Revisão de notas</option>
                            <option value="Revisão de frequência">Revisão de frequência</option>
                            <option value="Solicitação de histórico escolar">Solicitação de histórico escolar</option>
                            <option value="Declaração de matrícula">Declaração de matrícula</option>
                            <option value="Declaração de vínculo">Declaração de vínculo</option>
                            <option value="Plano de ensino">Plano de ensino</option>
                            <option value="Calendário acadêmico">Calendário acadêmico</option>
                            <option value="Colação de grau">Colação de grau</option>
                        </select>
                    </div>

                    <div>
                        <label>Descrição</label>
                        <textarea name="descricao"
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
        function toggleMenu() {
            let menu = document.getElementById('menuUser');
            menu.classList.toggle('hidden');
        }

        function abrirModal(id, data, hora, descricao, tipo) {

            let modal = document.getElementById('modalReagendar');

            modal.classList.remove('hidden');

            document.querySelector('#formReagendar').action = '/agendamentos/' + id;

            document.querySelector('[name=data]').value = data;
            document.querySelector('[name=hora]').value = hora;
            document.querySelector('[name=descricao]').value = descricao;
            document.querySelector('[name=tipo]').value = tipo;

        }

        function fecharModal() {
            document.getElementById('modalReagendar').classList.add('hidden');
        }
    </script>

</x-app-layout>