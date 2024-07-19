<!doctype html>
<html>

<x-Heading></x-Heading>

<body>
<x-navbar></x-navbar>

<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="flex flex-wrap justify-center w-full space-x-4">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:max-w-lg p-6 md:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Formulário de criação de planos
                </h1>
                <form class="space-y-4 mt-2 md:space-y-6" action="{{ route('planos.create') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nome" class="block mb-2 text-sm font-medium text-gray-900">Nome do plano</label>
                        <input type="text" name="nome" id="nome" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="máx 30 caracteres (recomendado)" required>
                    </div>
                    <div class="mb-6">
                        <label for="descricao" class="block mb-2 text-sm font-medium text-gray-900">Descrição do plano</label>
                        <input type="text" name="descricao" id="descricao" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500" placeholder="máx 200 caracteres (recomendado)" required>
                    </div>
                    <div>
                        <label for="quantidadePsicologos" class="block mb-2 text-sm font-medium text-gray-900">Quantidade de psicólogos do plano</label>
                        <input type="number" name="quantidadePsicologos" id="quantidadePsicologos" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="1 2 3 4 5..." required>
                    </div>
                    <div>
                        <label for="valor" class="block mb-2 text-sm font-medium text-gray-900">Valor do plano</label>
                        <input type="number" step="0.01" name="valor" id="valor" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Ex: 99.99" required>
                    </div>
                    <button type="submit" class="w-full text-black custom-bg-orange hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Criar Plano</button>
                </form>
            </div>

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:max-w-lg p-6 md:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Formulário de criação de cards
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('cards.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Título</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="máx 45 caracteres (recomendado)" required="">
                    </div>
                    <div class="mb-6">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descrição</label>
                        <input type="text" name="description" id="description" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500" placeholder="máx 110 caracteres (recomendado)" required="">
                    </div>
                    <div>
                        <label for="link" class="block mb-2 text-sm font-medium text-gray-900">Link</label>
                        <input type="url" name="link" id="link" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="www.materia.com" required="">
                    </div>

                    <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Apenas imagens 380px(w) / 200px(h) .Webp</label>
                    <input class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" type="file" name="image" required>

                    <button type="submit" class="w-full text-black custom-bg-orange hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Criar card</button>
                </form>
            </div>
        </div>
    </div>
</section>





<x-Footer></x-Footer>
</body>
</html>
