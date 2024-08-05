<!doctype html>
<html>

<x-Heading></x-Heading>

<body class="bg-gray-200">
<x-nav-psicologo></x-nav-psicologo>
<x-wpp></x-wpp>


<div class="ml-56">
    <h2 class="text-3xl mt-6 ml-[370px] font-extrabold text-gray-800 ">Configuração de sessões</h2>

    <h5 class="mb-2  font-bold tracking-tight mt-4 text-gray-900 ">Configurar tipo de sessão</h5>
    <form class="w-5/6 mt-2 mb-4" action="{{ route('sessionTypes.store') }}" method="POST">
        @csrf
        <div class="relative flex items-center">
            <input name="name" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-500 dark:border-gray-800 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Novo tipo de sessão" required />
            <input id="nativeColorPicker1" name="color" type="color" value="#4a5568" class="ml-2 w-10 h-14 border rounded-lg p-0 border-none bg-transparent cursor-pointer" />
            <button type="submit" class="ml-2 text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Cadastrar novo tipo de sessão</button>
        </div>
    </form>

    <div class="relative w-5/6 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full justify-center text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-800 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Tipos de sessões</th>
                <th scope="col" class="px-6 py-3">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sessionTypes as $sessionType)
                <tr class="bg-gray-700 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $sessionType->name }}
                    </th>
                    <td class="px-6 py-4">
                        <form action="{{ route('sessionTypes.destroy', $sessionType->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este tipo de sessão?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-orange-500 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Formulário para adicionar tempo médio de sessão -->
    <h5 class="mb-2 font-bold mt-6 tracking-tight text-gray-900">Configurar tempo médio de sessão</h5>
    <form class="w-5/6 mt-2 mb-4" action="{{ route('sessionTimes.store') }}" method="POST">
        @csrf
        <label class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Tempo médio de sessão</label>
        <div class="relative">
            <input name="time_in_minutes" type="number" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-500 dark:border-gray-800 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Adicione um tempo médio da sua sessão em minutos ex: ('45')" required />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Cadastrar novo tempo médio de sessão</button>
        </div>
    </form>

    <div class="relative w-5/6 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full justify-center text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-800 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Tempo médio de sessões</th>
                <th scope="col" class="px-6 py-3">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sessionTimes as $sessionTime)
                <tr class="bg-gray-700 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $sessionTime->time_in_minutes }} minutos
                    </th>
                    <td class="px-6 py-4">
                        <form action="{{ route('sessionTimes.destroy', $sessionTime->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este tempo médio de sessão?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-orange-500 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

<x-Footer></x-Footer>

<script>
    const colorPicker = document.getElementById("nativeColorPicker1");
    const changeColorBtn = document.getElementById("burronNativeColor");

    changeColorBtn.style.backgroundColor = colorPicker.value;
    colorPicker.addEventListener("input", () => {
        changeColorBtn.style.backgroundColor = colorPicker.value;
    });
</script>
</body>
</html>
