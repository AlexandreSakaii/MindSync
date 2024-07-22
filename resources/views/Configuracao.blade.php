<!doctype html>
<html>

<x-Heading></x-Heading>

<body>
<x-nav-menager></x-nav-menager>
<x-wpp></x-wpp>


<section class="bg-gray-50 ">
    <div class="flex flex-col items-center justify-center px-6 py-4 mx-auto lg:py-2">
        <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 sm:p-4">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                    Configurações da conta: {{ Auth::user()->email }}
                </h1>
                <form class="space-y-4" action="{{ route('config.update.email') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alterar email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="email_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repita o novo email</label>
                        <input type="email" name="email_confirmation" id="email_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                    </div>
                    <button type="submit" class="w-full custom-bg-orange hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-primary-300 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">Alterar email</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="bg-gray-50 ">
    <div class="flex flex-col items-center justify-center px-6 py-4 mx-auto lg:py-2">
        <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 sm:p-4">
                <form class="space-y-4" action="{{ route('config.update.password') }}" method="POST">
                    @csrf
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alterar senha</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repita a nova senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <button type="submit" class="w-full custom-bg-orange hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-primary-300 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">Alterar senha</button>
                </form>
            </div>
        </div>
    </div>
</section>


@php
    function getCardBrand($cardNumber) {
        $firstDigit = substr($cardNumber, 0, 1);
        $firstTwoDigits = substr($cardNumber, 0, 2);

        switch ($firstDigit) {
            case '3':
                return in_array($firstTwoDigits, ['34', '37']) ? 'American Express' : 'Diners Club';
            case '4':
                return 'Visa';
            case '5':
                return 'Mastercard';
            case '6':
                return 'Discover';
            default:
                return 'Desconhecido';
        }
    }
@endphp

<section class="bg-white py-4 antialiased md:py-8">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">

            <div class="mt-4 sm:mt-6 lg:flex lg:items-start lg:gap-6">
                <!-- Formulário para adicionar novo método de pagamento -->
                <form action="{{ route('config.add.payment_method') }}" method="POST" class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-4 lg:max-w-xl lg:p-6">
                    @csrf
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div class="col-span-2 sm:col-span-1">
                            <label for="card_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Nome completo </label>
                            <input type="text" id="card_name" name="card_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Bonnie Green" required />
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="card_number" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Número do cartão </label>
                            <input type="text" id="card_number" name="card_number" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="xxxx-xxxx-xxxx-xxxx" required />
                        </div>

                        <div>
                            <label for="card_expiration" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Validade do cartão </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            fill-rule="evenodd"
                                            d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                                <input id="card_expiration" name="card_expiration" type="text" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-9 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" placeholder="12/23" required />
                            </div>
                        </div>
                        <div>
                            <label for="cvv" class="mb-2 flex items-center gap-1 text-sm font-medium text-gray-900 dark:text-white">
                                CVV*
                                <button data-tooltip-target="cvv-desc" data-tooltip-trigger="hover" class="text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-white">
                                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10-10-4.477-10-10Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div id="cvv-desc" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                    últimos 3 digitos atrás do cartão
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </label>
                            <input type="number" id="cvv" name="cvv" aria-describedby="helper-text-explanation" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="•••" required />
                        </div>
                    </div>

                    <button type="submit" class="flex w-full items-center justify-center rounded-lg custom-bg-orange px-4 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">Registrar novo cartão de crédito</button>
                </form>

                <!-- Exibir métodos de pagamento existentes -->
                <div class="block max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Cartões de crédito</h5>
                    @foreach($paymentMethods as $method)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Cartão com final {{ substr($method['card_number'], -4) }} - {{ getCardBrand($method['card_number']) }}
                            </label>
                        </div>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Validade do cartão: {{ $method['card_expiration'] }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<form action="{{ route('config.update.clinic_data') }}" method="POST" class="w-full rounded-lg border ml-6 mr-6 border-gray-200 bg-white items-center justify-center p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
    @csrf
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div class="col-span-2 sm:col-span-1">
            <label for="clinic_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar nome da clínica</label>
            <input type="text" id="clinic_name" name="clinic_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Nome da clínica atual: {{ Auth::user()->clinic_name }}" />
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="cnpj" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar cnpj</label>
            <input type="text" id="cnpj" name="cnpj" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Cnpj atual: {{ Auth::user()->cnpj }}" />
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="phone" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar telefone</label>
            <input type="text" id="phone" name="phone" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Número do telefone atual: {{ Auth::user()->phone }}" />
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="responsible_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar nome do responsável</label>
            <input type="text" id="responsible_name" name="responsible_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Nome do responsável atual: {{ Auth::user()->responsible_name }}" />
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="responsible_cpf" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar CPF do responsável</label>
            <input type="text" id="responsible_cpf" name="responsible_cpf" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="CPF do responsável atual: {{ Auth::user()->responsible_cpf }}" />
        </div>
    </div>

    <button type="submit" class="flex w-full items-center justify-center rounded-lg custom-bg-orange px-4 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">Alterar dados da clínica</button>
</form>



<form action="{{ route('config.update.clinic_address') }}" method="POST" class="w-full mt-6 rounded-lg border ml-6 mr-6 border-gray-200 bg-white items-center justify-center p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
    @csrf
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div class="col-span-2 sm:col-span-1">
            <label for="cep" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar cep</label>
            <input type="text" id="cep" name="cep" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Cep da clínica atual: {{ Auth::user()->cep }}" />
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="street" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar rua</label>
            <input type="text" id="street" name="street" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Rua atual: {{ Auth::user()->street }}" />
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="number" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar número rua</label>
            <input type="text" id="number" name="number" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Número da rua atual: {{ Auth::user()->number }}" />
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="complement" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar complemento (opcional)</label>
            <input type="text" id="complement" name="complement" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Complemento atual: {{ Auth::user()->complement }}" />
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="city" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar cidade</label>
            <input type="text" id="city" name="city" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Cidade atual: {{ Auth::user()->city }}" />
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="state" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar estado</label>
            <input type="text" id="state" name="state" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Estado atual: {{ Auth::user()->state }}" />
        </div>

        <div class="col-span-2 sm:col-span-1">
            <label for="country" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alterar país</label>
            <input type="text" id="country" name="country" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Pais atual: {{ Auth::user()->country }}" />
        </div>
    </div>

    <button type="submit" class="flex w-full items-center justify-center rounded-lg custom-bg-orange px-4 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">Alterar dados de endereço da clínica</button>
</form>







<x-Footer></x-Footer>
</body>
</html>



