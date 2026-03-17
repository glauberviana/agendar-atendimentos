<x-app-layout>

    <div class="flex min-h-screen bg-gray-300">

        <div class="flex flex-1 items-center justify-center">

            <div class="bg-[#269C73] text-white p-10 rounded-xl shadow w-[1000px]">

                <h2 class="text-2xl font-semibold mb-6 text-center">
                    Reagendar Atendimento
                </h2>

                <form method="POST" action="{{ route('agendamentos.update', $agendamento->id) }}" class="space-y-5">

                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block mb-1">Data</label>

                        <input
                            type="date"
                            name="data"
                            value="{{ $agendamento->data }}"
                            required
                            class="w-full border rounded-lg px-3 py-2 text-black focus:outline-none focus:ring-2 focus:ring-white">
                    </div>

                    <div>
                        <label class="block mb-1">Hora</label>

                        <input
                            type="time"
                            name="hora"
                            value="{{ $agendamento->hora }}"
                            required
                            class="w-full border rounded-lg px-3 py-2 text-black focus:outline-none focus:ring-2 focus:ring-white">
                    </div>

                    <div>
                        <label class="block mb-1">Descrição</label>

                        <textarea
                            name="descricao"
                            rows="3"
                            class="w-full border rounded-lg px-3 py-2 text-black focus:outline-none focus:ring-2 focus:ring-white">{{ $agendamento->descricao }}</textarea>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#1E7F5A] text-white py-2 rounded-lg hover:bg-[#16694a] transition">
                        Salvar Alterações
                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>