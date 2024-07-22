<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <title>MindSync ERP software</title>
    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .custom-bg-orange {
            background-color: #FF9900;
        }

        .custom-bg-orange-claro {
            background-color: #ffb848;
        }

    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-float {
            margin-top: 16px;
        }

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>


</head>


<body>
<x-navbar></x-navbar>
<x-wpp></x-wpp>

<div class="container mt-4 mx-auto px-4">
    <form class="grid grid-cols-1 lg:grid-cols-3 gap-6" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Componente de Planos em Cima -->
        <div class="lg:col-span-3 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
            <div class="space-y-2">
                @if(isset($nome, $valor, $quantidadePsicologos))
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Plano escolhido</dt>
                        <dd class="text-base font-medium text-gray-900 dark:text-white">{{ $nome }}</dd>
                        <input type="hidden" name="plan_name" value="{{ $nome }}">
                    </dl>
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Quantidade de psicólgos</dt>
                        <dd class="text-base font-medium text-gray-900 dark:text-white">{{ $quantidadePsicologos }}</dd>
                        <input type="hidden" name="quantidadePsicologos" value="{{ $quantidadePsicologos }}">
                    </dl>
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Subtotal</dt>
                        <dd class="text-base font-medium text-gray-900 dark:text-white">R${{ $valor }}</dd>
                    </dl>
                @else
                    <p class="text-red-500">Parâmetros não recebidos corretamente.</p>
                @endif
            </div>
            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                <dd class="text-base font-bold text-gray-900 dark:text-white">R${{ $valor }}</dd>
                <input type="hidden" name="plan_value" value="{{ $valor }}">
            </dl>
        </div>

        <!-- Formulário de Dados Pessoais à Esquerda -->
        <div class="lg:col-span-2 bg-gray-800 rounded-lg shadow-md p-6">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Crie sua conta
            </h1>
            <div class="space-y-4 md:space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Campos do Formulário -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="name@company.com" required>
                    </div>
                    <div>
                        <label for="clinic_name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome da clínica</label>
                        <input type="text" name="clinic_name" id="clinic_name" placeholder="Nome da clínica"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="cnpj"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CNPJ</label>
                        <input type="text" name="cnpj" id="cnpj" placeholder="00.000.000/0000-00"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="password"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="password_confirmation"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repita sua senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               placeholder="••••••••"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="phone"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                        <input type="tel" name="phone" id="phone" placeholder="(99) 99999-9999"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="responsible_cpf"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPF do responsável</label>
                        <input type="text" name="responsible_cpf" id="responsible_cpf" placeholder="000.000.000-00"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="responsible_name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do responsável</label>
                        <input type="text" name="responsible_name" id="responsible_name"
                               placeholder="Nome do responsável"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="city"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                        <input type="text" name="city" id="city" placeholder="Cidade"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="state"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                        <input type="text" name="state" id="state" placeholder="Estado"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="country"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
                        <input type="text" name="country" id="country" placeholder="País"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="cep"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cep</label>
                        <input type="text" name="cep" id="cep" placeholder="00000-000"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="street"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                        <input type="text" name="street" id="street" placeholder="Rua"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="number"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                        <input type="text" name="number" id="number" placeholder="Número"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                    </div>
                    <div>
                        <label for="complement"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento</label>
                        <input type="text" name="complement" id="complement" placeholder="Complemento (opcional)"
                               class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <div class="mt-6 ">
                    <img src="BannerPagamento.webp" alt="Banner Pagamento" class="w-full object-cover rounded-lg">
                </div>
            </div>
        </div>


        <!-- Formulário de Pagamento à Direita -->
        <div class="credit-card w-full sm:w-auto shadow-lg mx-auto rounded-xl bg-gray-800 p-6 dark:border-gray-700 dark:bg-gray-800" x-data="creditCard">
            <header class="flex flex-col justify-center items-center">
                <div class="relative" x-show="card === 'front'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-90"
                     x-transition:enter-end="opacity-100 transform scale-100">
                    <img class="w-full h-auto"
                         src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/svg-cards/card-visa-front.png"
                         alt="front credit card">
                    <div
                        class="front bg-transparent text-lg w-full text-white px-12 absolute left-0 bottom-12">
                        <p class="number mb-5 sm:text-xl"
                           x-text="cardNumber !== '' ? cardNumber : '0000 0000 0000 0000'"></p>
                        <div class="flex flex-row justify-between">
                            <p x-text="cardholder !== '' ? cardholder : 'Card holder'"></p>
                            <div class="">
                                <span x-text="expired"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative" x-show="card === 'back'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-90"
                     x-transition:enter-end="opacity-100 transform scale-100">
                    <img class="w-full h-auto"
                         src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/svg-cards/card-visa-back.png"
                         alt="">
                    <div
                        class="bg-transparent text-white text-xl w-full flex justify-end absolute bottom-20 px-8  sm:bottom-24 right-0 sm:px-12">
                        <div class="border border-white w-16 h-9 flex justify-center items-center">
                            <p x-text="securityCode !== '' ? securityCode : 'code'"></p>
                        </div>
                    </div>
                </div>
            </header>
            <main class="">
                <h1 class="text-xl font-semibold text-gray-200 text-center">Dados do pagamento</h1>
                <div class="">
                    <div class="my-3">
                        <input type="text"
                               name="card_name"
                               class="block w-full px-5 py-2 border border-gray-600 rounded-lg bg-gray-900 text-white placeholder-gray-400 shadow-lg focus:ring focus:outline-none"
                               placeholder="Nome escrito no cartão" maxlength="22" x-model="cardholder" />
                    </div>
                    <div class="my-3">
                        <input type="text"
                               name="card_number"
                               class="block w-full px-5 py-2 border border-gray-600 rounded-lg bg-gray-900 text-white placeholder-gray-400 shadow-lg focus:ring focus:outline-none"
                               placeholder="Número do cartão" x-model="cardNumber" x-on:keydown="formatCardNumber()"
                               x-on:keyup="isValid()" maxlength="19" />
                    </div>
                    <div class="my-3 flex flex-col">
                        <div class="mb-2">
                            <label for="card_expiration" class="text-gray-400">Expired</label>
                        </div>
                        <input type="text"
                               name="card_expiration"
                               class="block w-full px-5 py-2 border border-gray-600 rounded-lg bg-gray-900 text-white placeholder-gray-400 shadow-lg focus:ring focus:outline-none"
                               placeholder="MM/YY" maxlength="5" x-model="expired" x-on:keydown="formatExpiration()" />
                    </div>
                    <div class="my-3">
                        <input type="text"
                               name="cvv"
                               class="block w-full px-5 py-2 border border-gray-600 rounded-lg bg-gray-900 text-white placeholder-gray-400 shadow-lg focus:ring focus:outline-none"
                               placeholder="Código de segurança" maxlength="3" x-model="securityCode"
                               x-on:focus="card = 'back'" x-on:blur="card = 'front'" />
                    </div>
                </div>
            </main>
            <footer class="mt-6 p-4">
                <button
                    class="submit-button px-4 py-3 rounded-full custom-bg-orange text-white focus:ring focus:outline-none w-full text-xl font-semibold transition-colors"
                    x-bind:disabled="!isValid" x-on:click="onSubmit()">
                    Pagar agora
                </button>
            </footer>
        </div>
    </form>
</div>

<x-Footer></x-Footer>

<script defer src="https://unpkg.com/alpinejs@3.2.2/dist/cdn.min.js"></script>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("creditCard", () => ({
            init() {
                console.log('Component mounted');
            },
            formatCardNumber() {
                this.cardNumber = this.cardNumber.replace(/\D/g, '').substring(0, 16);
                if (this.cardNumber.length > 0) {
                    this.cardNumber = this.cardNumber.match(/.{1,4}/g).join(' ');
                }
            },
            formatExpiration() {
                this.expired = this.expired.replace(/\D/g, '').substring(0, 4);
                if (this.expired.length > 2) {
                    this.expired = this.expired.substring(0, 2) + '/' + this.expired.substring(2);
                }
            },
            get isValid() {
                if (this.cardholder.length < 5) {
                    return false;
                }
                if (this.cardNumber.length !== 19) { // 16 digits + 3 spaces
                    return false;
                }
                if (this.expired.length !== 5) { // MM/YY
                    return false;
                }
                if (this.securityCode.length !== 3) {
                    return false;
                }
                return true;
            },
            onSubmit() {
                alert(`You did it ${this.cardholder}.`);
            },
            cardholder: '',
            cardNumber: '',
            expired: '',
            securityCode: '',
            card: 'front',
        }));
    });
</script>
</body>

</html>
