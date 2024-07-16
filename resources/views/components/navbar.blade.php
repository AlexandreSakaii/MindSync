<nav class="border-gray-200 bg-gray-800">
    <div class=" flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex ml-6 items-center space-x-3 rtl:space-x-reverse">
            <img src="MindSyncLogo.webp" class="h-16 w-35" alt="MindSync Logo" />
        </a>
        <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden mr-6 w-full md:flex md:w-auto md:items-center md:space-x-8" id="navbar-dropdown">
            <ul class="flex flex-col space-x-4 bg-gray-800 font-bold p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:mt-0 md:border-0">
                <li>
                    <a href="/" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Funcionalidades</a>
                </li>
                <li>
                    <a href="Planos" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Planos</a>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Explorar <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar" class="z-10 hidden font-bold bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-100 " aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sobre o MindSync</a>
                            </li>
                            <li>
                                <a href="Blog" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Blog</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Fale Conosco</a>
                            </li>
                            @if(auth()->check())
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Sair
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" id="login-button" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Entrar</a>
                </li>
            </ul>
            <ul class="flex space-x-2 mt-1">
                <li>
                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-bold text-gray-900 rounded-lg group bg-gradient-to-br from-orange-200 via-orange-300 to-orange-400 group-hover:from-orange-200 group-hover:via-orange-300 group-hover:to-orange-400 dark:text-gray-700 dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-orange-100 dark:focus:ring-orange-400">
                        <span class="relative px-5 py-2 transition-all ease-in duration-75 bg-white dark:bg-orange-200 rounded-md group-hover:bg-opacity-0">
                           Experimente grátis
                        </span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div id="login-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 relative z-10 w-96">
        <button id="close-modal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-300">&times;</button>
        <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl">
            Faça Login na sua conta
        </h1>
        <form class="space-y-4 mt-2 md:space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required>
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-white">Senha</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" name="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-white">Remember me</label>
                    </div>
                </div>
                <a href="#" class="text-sm font-medium text-white hover:underline">Esqueceu a Senha?</a>
            </div>
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-primary-300 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('login-button').addEventListener('click', function() {
        document.getElementById('login-modal').classList.remove('hidden');
    });

    document.getElementById('close-modal').addEventListener('click', function() {
        document.getElementById('login-modal').classList.add('hidden');
    });

    document.addEventListener('click', function(event) {
        var isClickInsideModal = document.getElementById('login-modal').contains(event.target);
        var isClickInsideButton = document.getElementById('login-button').contains(event.target);
        if (!isClickInsideModal && !isClickInsideButton) {
            document.getElementById('login-modal').classList.add('hidden');
        }
    });
</script>
