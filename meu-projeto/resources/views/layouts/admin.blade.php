<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Painel Admin</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>

<body>

    <div class="flex min-h-screen bg-[#F6F6F6]">


        <!-- SIDEBAR -->
        <div class="w-72 bg-gradient-to-b from-[#28A279] to-[#18663C] text-white flex flex-col p-6">

            <h1 class="text-xl font-bold mb-10">
                INSTITUIÇÃO
            </h1>

            <nav class="space-y-4">

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
{{ request()->routeIs('admin.dashboard') ? 'bg-[#1E7F5A]' : 'hover:bg-[#1E7F5A]' }}">

                    <img src="{{ asset('icons/inicio.svg') }}" class="w-5 h-5">

                    Início

                </a>

                <a href="{{ route('admin.atendimentos') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
{{ request()->routeIs('admin.atendimentos') ? 'bg-[#1E7F5A]' : 'hover:bg-[#1E7F5A]' }}">

                    <img src="{{ asset('icons/agendamento.svg') }}" class="w-5 h-5">

                    Gerenciar Atendimentos

                </a>


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


                    <div id="menuAdmin"
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
            <div class="p-8 flex-1">

                @yield('content')

            </div>

        </div>

    </div>


    <script>
        function toggleMenu() {

            let menu = document.getElementById('menuAdmin');

            menu.classList.toggle('hidden');

        }
    </script>

</body>

</html>