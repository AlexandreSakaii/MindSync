<!doctype html>
<html>
<x-Heading></x-Heading>

<body>
<x-nav-psicologo></x-nav-psicologo>
<x-wpp></x-wpp>

<div class="grid grid-cols-1 md:grid-cols-2 md:ml-44">
    <div class="flex items-center">
        <div class="w-full mx-auto p-4">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="flex items-center justify-between px-6 py-3 bg-gray-700">
                    <button id="prevMonth" class="text-white">Anterior</button>
                    <h2 id="currentMonth" class="text-white"></h2>
                    <button id="nextMonth" class="text-white">Próximo</button>
                </div>
                <div class="grid grid-cols-7 gap-2 p-4" id="calendar">
                    <!-- Calendar Days Go Here -->
                </div>
                <div id="myModal" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
                    <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>
                    <div class="modal-container bg-white w-1/2 mx-auto rounded shadow-lg z-50 overflow-y-auto">
                        <div class="modal-content  py-4 text-left px-6">

                            <div class="flex justify-between items-center pb-3">
                                <p class="text-2xl font-bold">Agenda</p>
                                <div id="modalDate" class="text-xl font-semibold"></div>
                                <button id="closeModal" class="modal-close px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">✕</button>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <!-- Dropdown para tipos de sessão -->
                                    <button id="dropdownSessionTypeButton" data-dropdown-toggle="dropdownSessionType" class="text-white w-full mt-4 justify-center h-12 bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800" type="button">Tipo de sessão
                                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg>
                                    </button>
                                    <!-- Dropdown menu para tipos de sessão -->
                                    <div id="dropdownSessionType" class="z-10 hidden w-80 bg-gray-600 divide-y divide-gray-100 rounded-lg shadow absolute mt-2">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSessionTypeButton">
                                            @foreach ($sessionTypes as $sessionType)
                                                <li class="flex items-center p-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg">
                                                    <input type="checkbox" class="w-4 h-4 text-orange-600 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 me-2 checkbox-item session-type-item">
                                                    <span class="text-white dark:text-white">{{ $sessionType->name }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <form class="mt-4 mx-auto">
                                        <label for="default-search" class=" text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </div>
                                            <input type="search" id="patient-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nome do paciente" required />
                                        </div>
                                        <div id="search-results" class="mt-2 hidden w-80 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600 absolute z-10"></div>
                                    </form>

                                    <div class="relative mt-4">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                                                <path fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400" d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z"/>
                                                <path fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400" d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1"/>
                                            </svg>
                                        </div>
                                        <input id="start_time" name="start_time" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Horário da consulta" required />
                                    </div>

                                    <button id="dropdownSessionTimeButton" data-dropdown-toggle="dropdownSessionTime" class="text-white w-full mt-4 justify-center h-12 bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800" type="button">Tempo da sessão
                                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownSessionTime" class="z-10 hidden w-80 bg-gray-600 divide-y divide-gray-100 rounded-lg shadow absolute mt-2 top-0 translate-y-full">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSessionTimeButton">
                                            @foreach ($sessionTimes as $sessionTime)
                                                <li class="flex items-center p-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg">
                                                    <input type="checkbox" class="w-4 h-4 text-orange-600 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 me-2 checkbox-item session-time-item">
                                                    <span class="text-white dark:text-white">{{ $sessionTime->time_in_minutes }} minutos</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="#" class="block h-[251px] p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                        <h5 class="mb-2 mt-4 ml-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Horários com sessões marcadas</h5>
                                        <div id="scheduled-sessions" class="grid grid-cols-2 ml-4 gap-4">
                                            <!-- Horários das sessões marcadas vão aqui -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <a href="#" id="summary-container" class="hidden block w-full mt-4 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">Resumo do agendamento</h5>
                                <p id="summary" class="font-normal text-gray-700 dark:text-gray-400">Tipo de atendimento: {tipo de sessão}, pacientes: {nome dos pacientes}, dia: {data}, horário: {horário}</p>
                            </a>
                            <form action="{{ route('sessions.store') }}" method="POST" id="sessionForm">
                                @csrf
                                <input type="hidden" id="patient_ids" name="patient_ids">
                                <input type="hidden" id="session_type" name="session_type">
                                <input type="hidden" id="session_time" name="session_time">
                                <input type="hidden" id="date" name="date">
                                <input type="hidden" id="start_time" name="start_time">
                                <button type="submit" class="w-full mt-2 bg-orange-600 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cadastrar sessão</button>
                            </form>


                            <div class="relative  w-full mt-4 overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Sessões de hoje
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Horário
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Telefone do paciente
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Configurar
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {nome do paciente}
                                        </th>
                                        <td class="px-6 py-4">
                                            {Horário da consulta}
                                        </td>
                                        <td class="px-6 py-4">
                                            {número do telefone do apciente}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col space-y-4 mt-4">
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="flex items-center text-white w-full md:w-56 h-16 bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill-add mr-2" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                </svg>
                Novo paciente
            </button>

            <button type="button" class="flex items-center text-white bg-orange-500 w-full md:w-56 h-16 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-calendar-x mr-2" viewBox="0 0 16 16">
                    <path d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708"/>
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
                Nova sessão fora do calendário
            </button>
        </div>
        <!-- Gráfico Responsivo -->

        <div class="w-full md:w-[463px] h-[265px] bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <div class="flex h-2 justify-between">
                <div>
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">32.4k</h5>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Faturamento semanal</p>
                </div>
            </div>
            <div id="area-chart"></div>
        </div>
    </div>
</div>

<div class="relative ml-48 w-[1128px] overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Sessões de hoje
            </th>
            <th scope="col" class="px-6 py-3">
                Horário
            </th>
            <th scope="col" class="px-6 py-3">
                Telefone do paciente
            </th>
            <th scope="col" class="px-6 py-3">
                Atendimento
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {nome do paciente}
            </th>
            <td class="px-6 py-4">
                {Horário da consulta}
            </td>
            <td class="px-6 py-4">
                {número do telefone do apciente}
            </td>
            <td class="px-6 py-4 text-left">
                <a href="#" class="font-medium text-orange-500 hover:underline">Iniciar sessão</a>
            </td>
            <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 overflow-y-auto overflow-x-hidden flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Criar novo paciente
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Nome do paciente" required="">
                    </div>

                    <div class="col-span-2">
                        <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de contato</label>
                        <input type="text" name="number" id="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Número de celular" required="">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de nascimento</label>
                        <input type="date" name="birthdate" id="birthdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" required="">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="cpf" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPF do paciente</label>
                        <input type="text" name="cpf" id="cpf" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="000.000.000-00" required="">
                    </div>

                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição (opcional)</label>
                        <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Descrição do paciente"></textarea>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Adicionar novo paciente
                </button>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>

<script>
    function generateCalendar(year, month) {
        const calendarElement = document.getElementById('calendar');
        const currentMonthElement = document.getElementById('currentMonth');

        const firstDayOfMonth = new Date(year, month, 1);
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        calendarElement.innerHTML = '';

        const monthNames = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        currentMonthElement.innerText = `${monthNames[month]} ${year}`;

        const firstDayOfWeek = firstDayOfMonth.getDay();

        const daysOfWeek = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
        daysOfWeek.forEach(day => {
            const dayElement = document.createElement('div');
            dayElement.className = 'text-center font-semibold';
            dayElement.innerText = day;
            calendarElement.appendChild(dayElement);
        });

        for (let i = 0; i < firstDayOfWeek; i++) {
            const emptyDayElement = document.createElement('div');
            calendarElement.appendChild(emptyDayElement);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'text-center py-2 border cursor-pointer';
            dayElement.innerText = day;

            const currentDate = new Date();
            if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
                dayElement.classList.add('custom-bg-orange', 'text-white');
            }

            dayElement.addEventListener('click', () => {
                const selectedDate = new Date(year, month, day);
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const formattedDate = selectedDate.toLocaleDateString(undefined, options);
                showModal(formattedDate, selectedDate);
                updateScheduledSessions(selectedDate);
            });

            calendarElement.appendChild(dayElement);
        }
    }

    const currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();
    generateCalendar(currentYear, currentMonth);

    document.getElementById('prevMonth').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentYear, currentMonth);
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentYear, currentMonth);
    });

    function showModal(formattedDate, selectedDate) {
        const modal = document.getElementById('myModal');
        const modalDateElement = document.getElementById('modalDate');
        modalDateElement.innerText = formattedDate;

        document.getElementById('date').value = selectedDate.toISOString().split('T')[0];

        modal.classList.remove('hidden');
    }

    function hideModal() {
        const modal = document.getElementById('myModal');
        modal.classList.add('hidden');
    }

    document.getElementById('closeModal').addEventListener('click', () => {
        hideModal();
    });

    document.getElementById('patient-search').addEventListener('input', function() {
        const query = this.value;
        const resultsDiv = document.getElementById('search-results');

        if (query.length > 0) {
            fetch(`/patients/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    resultsDiv.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(patient => {
                            const div = document.createElement('div');
                            div.classList.add('flex', 'items-center', 'p-2', 'cursor-pointer', 'hover:bg-gray-200', 'dark:hover:bg-gray-600', 'rounded-lg');

                            const checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.value = patient.id;
                            checkbox.classList.add('w-4', 'h-4', 'text-blue-600', 'bg-gray-100', 'border-gray-300', 'rounded', 'focus:ring-blue-500', 'dark:focus:ring-blue-600', 'dark:ring-offset-gray-700', 'dark:focus:ring-offset-gray-700', 'focus:ring-2', 'dark:bg-gray-600', 'dark:border-gray-500', 'me-2', 'patient-item');
                            checkbox.dataset.name = patient.name; // Adicionando o nome do paciente ao dataset
                            checkbox.addEventListener('change', function() {
                                updateSummary();
                            });

                            const span = document.createElement('span');
                            span.classList.add('text-gray-900', 'dark:text-white');
                            span.textContent = patient.name;

                            div.appendChild(checkbox);
                            div.appendChild(span);

                            resultsDiv.appendChild(div);
                        });
                        resultsDiv.classList.remove('hidden');
                    } else {
                        resultsDiv.innerHTML = '<div class="p-2 text-gray-500">Nenhum paciente encontrado</div>';
                        resultsDiv.classList.remove('hidden');
                    }
                });
        } else {
            resultsDiv.classList.add('hidden');
        }
    });

    function updateSummary() {
        const sessionType = document.querySelector('.session-type-item:checked');
        const sessionTime = document.querySelector('.session-time-item:checked');
        const patients = Array.from(document.querySelectorAll('#search-results .patient-item:checked')).map(checkbox => ({
            id: checkbox.value,
            name: checkbox.dataset.name
        }));
        const date = document.getElementById('date').value;
        const startTime = document.getElementById('start_time').value;

        if (sessionType || sessionTime || patients.length > 0 || date || startTime) {
            document.getElementById('summary-container').classList.remove('hidden');
        } else {
            document.getElementById('summary-container').classList.add('hidden');
        }

        const patientIds = patients.map(patient => patient.id).join(',');
        const patientNames = patients.map(patient => patient.name).join(', ');

        document.getElementById('session_type').value = sessionType ? sessionType.nextElementSibling.textContent.trim() : '';
        document.getElementById('session_time').value = sessionTime ? sessionTime.nextElementSibling.textContent.trim().split(' ')[0] : '';
        document.getElementById('patient_ids').value = patientIds;

        document.getElementById('summary').textContent = `Tipo de atendimento: ${sessionType ? sessionType.nextElementSibling.textContent.trim() : ''}, pacientes: ${patientNames}, dia: ${date}, horário: ${startTime}`;
    }

    document.addEventListener('DOMContentLoaded', function() {
        new Cleave('#start_time', {
            time: true,
            timePattern: ['h', 'm']
        });

        document.getElementById('start_time').addEventListener('input', function() {
            updateSummary();
        });

        document.getElementById('sessionForm').addEventListener('submit', function(event) {
            event.preventDefault();

            console.log('Submitting form...');

            const startTimeInput = document.getElementById('start_time').value;
            const sessionTimeInput = document.querySelector('.session-time-item:checked');
            const sessionTime = sessionTimeInput ? sessionTimeInput.nextElementSibling.textContent.trim().split(' ')[0] : '';

            const endTime = calculateEndTime(startTimeInput, sessionTime);

            console.log('Start time:', startTimeInput);
            console.log('Session time:', sessionTime);
            console.log('End time:', endTime);

            const patientIds = document.getElementById('patient_ids').value;
            console.log('Patient IDs:', patientIds);

            if (!startTimeInput || !sessionTime || isNaN(Date.parse(`01/01/1970 ${endTime}`)) || !patientIds) {
                console.error('Invalid data:', { startTime: startTimeInput, sessionTime, endTime, patientIds });
                return;
            }

            const formData = new FormData(this);
            formData.set('start_time', startTimeInput);
            formData.set('session_time', sessionTime);
            formData.set('end_time', endTime);
            formData.set('patient_id', patientIds);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Submission failed');
                    });
                }
                return response.json();
            }).then(data => {
                if (data.success) {
                    updateScheduledSessions(new Date(document.getElementById('date').value));
                    hideModal();
                } else {
                    console.log('Submission failed:', data);
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });

        function calculateEndTime(startTime, sessionTime) {
            if (!startTime || !sessionTime) return NaN;
            const [hours, minutes] = startTime.split(':').map(Number);
            const sessionMinutes = Number(sessionTime);

            const endMinutes = minutes + sessionMinutes;
            const endHours = hours + Math.floor(endMinutes / 60);

            return `${String(endHours).padStart(2, '0')}:${String(endMinutes % 60).padStart(2, '0')}`;
        }

        function updateSummary() {
            const sessionType = document.querySelector('.session-type-item:checked');
            const sessionTime = document.querySelector('.session-time-item:checked');
            const patients = Array.from(document.querySelectorAll('#search-results .patient-item:checked')).map(checkbox => ({
                id: checkbox.value,
                name: checkbox.dataset.name
            }));
            const date = document.getElementById('date').value;
            const startTime = document.getElementById('start_time').value;

            if (sessionType || sessionTime || patients.length > 0 || date || startTime) {
                document.getElementById('summary-container').classList.remove('hidden');
            } else {
                document.getElementById('summary-container').classList.add('hidden');
            }

            const patientIds = patients.map(patient => patient.id).join(',');
            const patientNames = patients.map(patient => patient.name).join(', ');

            document.getElementById('session_type').value = sessionType ? sessionType.nextElementSibling.textContent.trim() : '';
            document.getElementById('session_time').value = sessionTime ? sessionTime.nextElementSibling.textContent.trim().split(' ')[0] : '';
            document.getElementById('patient_ids').value = patientIds;

            console.log('Patient IDs updated:', patientIds);
            document.getElementById('summary').textContent = `Tipo de atendimento: ${sessionType ? sessionType.nextElementSibling.textContent.trim() : ''}, pacientes: ${patientNames}, dia: ${date}, horário: ${startTime}`;
        }

        document.querySelectorAll('.checkbox-item').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSummary();
            });
        });

        document.getElementById('patient-search').addEventListener('input', function() {
            const query = this.value;
            const resultsDiv = document.getElementById('search-results');

            if (query.length > 0) {
                fetch(`/patients/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        resultsDiv.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(patient => {
                                const div = document.createElement('div');
                                div.classList.add('flex', 'items-center', 'p-2', 'cursor-pointer', 'hover:bg-gray-200', 'dark:hover:bg-gray-600', 'rounded-lg');

                                const checkbox = document.createElement('input');
                                checkbox.type = 'checkbox';
                                checkbox.value = patient.id;
                                checkbox.classList.add('w-4', 'h-4', 'text-blue-600', 'bg-gray-100', 'border-gray-300', 'rounded', 'focus:ring-blue-500', 'dark:focus:ring-blue-600', 'dark:ring-offset-gray-700', 'dark:focus:ring-offset-gray-700', 'focus:ring-2', 'dark:bg-gray-600', 'dark:border-gray-500', 'me-2', 'patient-item');
                                checkbox.dataset.name = patient.name;
                                checkbox.addEventListener('change', function() {
                                    updateSummary();
                                });

                                const span = document.createElement('span');
                                span.classList.add('text-gray-900', 'dark:text-white');
                                span.textContent = patient.name;

                                div.appendChild(checkbox);
                                div.appendChild(span);

                                resultsDiv.appendChild(div);
                            });
                            resultsDiv.classList.remove('hidden');
                        } else {
                            resultsDiv.innerHTML = '<div class="p-2 text-gray-500">Nenhum paciente encontrado</div>';
                            resultsDiv.classList.remove('hidden');
                        }
                    });
            } else {
                resultsDiv.classList.add('hidden');
            }
        });

        document.getElementById('dropdownSessionTypeButton').addEventListener('click', function() {
            document.getElementById('dropdownSessionType').classList.toggle('hidden');
        });

        document.getElementById('dropdownSessionTimeButton').addEventListener('click', function() {
            document.getElementById('dropdownSessionTime').classList.toggle('hidden');
        });
    });

    function updateScheduledSessions(selectedDate) {
        const date = selectedDate.toISOString().split('T')[0];
        fetch(`/sessions/by-date?date=${date}`)
            .then(response => response.json())
            .then(data => {
                const scheduledSessionsDiv = document.getElementById('scheduled-sessions');
                scheduledSessionsDiv.innerHTML = '';

                const uniqueSessions = new Set();

                if (data.length > 0) {
                    data.forEach(session => {
                        const sessionString = `${session.start_time} a ${session.end_time}`;
                        if (!uniqueSessions.has(sessionString)) {
                            uniqueSessions.add(sessionString);
                            const div = document.createElement('div');
                            div.classList.add('font-normal', 'text-gray-700', 'dark:text-gray-400');
                            div.textContent = sessionString;
                            scheduledSessionsDiv.appendChild(div);
                        }
                    });
                } else {
                    scheduledSessionsDiv.innerHTML = '<div class="text-gray-500">Nenhuma sessão marcada</div>';
                }
            })
            .catch(error => {
                console.error('Error fetching sessions:', error);
                scheduledSessionsDiv.innerHTML = '<div class="text-gray-500">Erro ao carregar as sessões</div>';
            });
    }







    const options = {
        chart: {
            height: "100%",
            maxWidth: "100%",
            type: "area",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 6,
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: 0
            },
        },
        series: [
            {
                name: "New users",
                data: [6500, 6418, 6456, 6526, 6356, 6456],
                color: "#1A56DB",
            },
        ],
        xaxis: {
            categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
        },
    };

    if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("area-chart"), options);
        chart.render();
    }
</script>






<x-Footer></x-Footer>
</body>
</html>
