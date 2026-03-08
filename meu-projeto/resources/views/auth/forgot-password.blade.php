<x-guest-layout>
    <div class="w-screen h-screen flex bg-[#F6F6F6]">

        <!-- Lado Esquerdo -->
        <div
            class="w-1/2 h-full p-16 flex flex-col justify-center text-white
                   bg-gradient-to-br from-[#18663C] to-[#28A279]   
                   clip-path-left">

            <h1 class="text-4xl font-bold mb-6">RECUPERAR SENHA</h1>
            <p class="text-white/80 text-lg leading-relaxed max-w-md">
                Informe seu e-mail e enviaremos um link para redefinir sua senha com segurança.
            </p>
        </div>

        <!-- Lado Direito -->
        <div class="w-1/2 h-full bg-[#F6F6F6] p-14 flex flex-col justify-center text-[#269C73]">

            <h2 class="text-2xl font-semibold mb-6 text-center">
                Esqueceu sua senha?
            </h2>

            <!-- Status -->
            <x-auth-session-status 
                class="mb-4 text-green-400 text-sm text-center" 
                :status="session('status')" 
            />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5 max-w-md mx-auto w-full">
                @csrf

                <!-- Email -->
                <div>
                    <label class="text-sm text-[#269C73]">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full bg-transparent border-b border-[#269C73]/30
                               py-2 focus:outline-none focus:border-[#269C73] transition">
                    <x-input-error 
                        :messages="$errors->get('email')" 
                        class="mt-1 text-red-400 text-sm" 
                    />
                </div>

                <!-- Botão -->
                <button
                    type="submit"
                    class="w-full py-3 mt-4 rounded-full font-semibold text-lg text-white
                           bg-gradient-to-r from-[#18663C] to-[#28A279]
                           hover:opacity-90 transition">
                    Enviar link de redefinição
                </button>
            </form>

            <!-- Voltar -->
            <p class="text-center text-sm text-[#269C73]/70 mt-6">
                Lembrou sua senha?
                <a href="{{ route('login') }}" class="text-[#269C73] hover:underline">
                    Voltar para Login
                </a>
            </p>
        </div>

    </div>

    <!-- Corte diagonal -->
    <style>
        .clip-path-left {
            clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);
        }
    </style>
</x-guest-layout>