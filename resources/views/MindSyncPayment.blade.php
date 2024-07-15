<!doctype html>
<html>

<x-Heading></x-Heading>

<body>
<x-navbar></x-navbar>
<x-wpp></x-wpp>


<div class="grid grid-cols-1 md:grid-cols-2 gap-6 ml-48 justify-center">
    <section class="bg-white md:col-span-1 ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full  bg-gray-800 rounded-lg shadow-md md:p-0 border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Crie sua conta
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="#">
                        <form class="space-y-4 md:space-y-6" action="#">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                                </div>
                                <div>
                                    <label for="clinic-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome da clínica</label>
                                    <input type="text" name="clinic-name" id="clinic-name" placeholder="Nome da clínica" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="cnpj" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CNPJ</label>
                                    <input type="text" name="cnpj" id="cnpj" placeholder="00.000.000/0000-00" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                                    <input type="tel" name="phone" id="phone" placeholder="(99) 99999-9999" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="responsible-cpf" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPF do responsável</label>
                                    <input type="text" name="responsible-cpf" id="responsible-cpf" placeholder="000.000.000-00" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repita sua senha</label>
                                    <input type="password" name="repeat-password" id="repeat-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="responsible-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do responsável</label>
                                    <input type="text" name="responsible-name" id="responsible-name" placeholder="Nome do responsável" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                                    <input type="text" name="city" id="city" placeholder="Cidade" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                                    <input type="text" name="state" id="state" placeholder="Estado" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
                                    <input type="text" name="country" id="country" placeholder="País" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="cep" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cep</label>
                                    <input type="text" name="cep" id="cep" placeholder="00000-000" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="street" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                                    <input type="text" name="street" id="street" placeholder="Rua" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                                    <input type="text" name="number" id="number" placeholder="Número" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div>
                                    <label for="complement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento</label>
                                    <input type="text" name="complement" id="complement" placeholder="Complemento (opcional)" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white  md:col-span-1 mt-10 w-2/3">
        <div class="mx-auto ">
            <div class="mt-6 sm:mt-8 ">
                <div class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 ">
                    <div class="space-y-2">
                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Plano escolhido</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{plano}</dd>
                        </dl>

                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Subtotal</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{subtotal}</dd>
                        </dl>

                    </div>

                    <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                        <dd class="text-base font-bold text-gray-900 dark:text-white">$7,191.00</dd>
                    </dl>
                </div>
            </div>

            <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">
                <form action="#" class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8">
                    <form action="#" class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8">
                        <div class="mb-6 grid grid-cols-2 gap-4">
                            <div class="col-span-2 sm:col-span-1">
                                <label for="full_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Nome completo </label>
                                <input type="text" id="full_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Bonnie Green" required />
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="card-number-input" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Número do cartão* </label>
                                <input type="text" id="card-number-input" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500  dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="xxxx-xxxx-xxxx-xxxx" pattern="^4[0-9]{12}(?:[0-9]{3})?$" required />
                            </div>

                            <div>
                                <label for="card-expiration-input" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Validade do cartão* </label>
                                <div class="relative">
                                    <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                fill-rule="evenodd"
                                                d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </div>
                                    <input datepicker datepicker-format="mm/yy" id="card-expiration-input" type="text" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 ps-9 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" placeholder="12/23" required />
                                </div>
                            </div>
                            <div>
                                <label for="cvv-input" class="mb-2 flex items-center gap-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Código de segurança*
                                    <button data-tooltip-target="cvv-desc" data-tooltip-trigger="hover" class="text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-white">
                                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <div id="cvv-desc" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                        Os últimos 3 dígitos no verso do cartão
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </label>
                                <input type="number" id="cvv-input" aria-describedby="helper-text-explanation" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="•••" required />
                            </div>
                        </div>

                        <button type="submit" class="w-full text-white custom-bg-orange focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cadastrar e pagar agora</button>
                    </form>
                </form>
            </div>

            <p class="mt-6 text-center text-gray-700 sm:mt-8 lg:text-left">
                Pagamento processado por <a href="#" title="" class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">Paddle</a> para <a href="#" title="" class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">MindSyncERP</a>
                - Brasil
            </p>
        </div>
    </section>
</div>







<x-Footer></x-Footer>
</body>
</html>
