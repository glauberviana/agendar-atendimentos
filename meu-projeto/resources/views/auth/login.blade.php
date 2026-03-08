<x-guest-layout>
    <div class="w-screen h-screen flex bg-[#F6F6F6]">

        <!-- Lado Esquerdo (Roxo) -->
        <div
            class="w-1/2 h-full p-16 flex flex-col justify-center text-white
                   bg-gradient-to-br from-[#18663C] to-[#28A279]
                   clip-path-left">

            <h1 class="text-5xl font-bold mb-6">SEJAM BEM VINDOS!</h1>
            <p class="text-white/80 text-lg leading-relaxed max-w-md">
                Faça login para acessar sua conta e continuar usando o sistema.
            </p>
        </div>

        <!-- Lado Direito (Formulário) -->
        <div class="w-1/2 h-full bg-[#F6F6F6] p-20 flex flex-col justify-center text-[#269C73]">

            <h2 class="text-3xl font-semibold mb-10 text-center">Login</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-8 max-w-md mx-auto w-full">
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
                               py-3 focus:outline-none focus:border-[#269C73] transition">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400" />
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm text-[#269C73]">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full bg-transparent border-b border-[#269C73]/30
                               py-3 focus:outline-none focus:border-[#269C73] transition">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400" />
                </div>

                <!-- Forgot -->
                @if (Route::has('password.request'))
                    <div class="text-right text-sm">
                        <a href="{{ route('password.request') }}" class="text-[#269C73] hover:underline">
                            Esqueceu sua senha?
                        </a>
                    </div>
                @endif

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full py-4 rounded-full font-semibold text-lg text-white
                           bg-gradient-to-br from-[#18663C] to-[#28A279]
                           hover:opacity-90 transition">
                    Login
                </button>
            </form>

            <!-- Footer -->
            <p class="text-center text-sm text-[#269C73]/70 mt-8">
                Não possui uma conta?
                <a href="{{ route('register') }}" class="text-[#269C73] hover:underline">
                    Sign Up
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