<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-inter-medium">
            @if (Auth::user()->hasRole('dentist'))
                <li>
                    <a href="{{ route('dentist.dashboard.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.3 3.3a1 1 0 0 1 1.4 0l6 6 2 2a1 1 0 0 1-1.4 1.4l-.3-.3V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3c0 .6-.4 1-1 1H7a2 2 0 0 1-2-2v-6.6l-.3.3a1 1 0 0 1-1.4-1.4l2-2 6-6Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="ml-3">Головна</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dentist.appointments.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5 5c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1h1c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1h1c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1a2 2 0 0 1 2 2v1c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1V7c0-1.1.9-2 2-2ZM3 19v-7c0-.6.4-1 1-1h16c.6 0 1 .4 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6-6c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1Zm2 0a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Zm6 0c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1ZM7 17a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Zm6 0c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1Zm2 0a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-3">Прийоми</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dentist.schedules.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7c0-1.1.9-2 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="ml-3">Графік роботи</span>
                    </a>
                </li>
            @elseif(Auth::user()->hasRole('patient'))
                <li>
                    <a href="{{ route('patient.dashboard.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.3 3.3a1 1 0 0 1 1.4 0l6 6 2 2a1 1 0 0 1-1.4 1.4l-.3-.3V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3c0 .6-.4 1-1 1H7a2 2 0 0 1-2-2v-6.6l-.3.3a1 1 0 0 1-1.4-1.4l2-2 6-6Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="ml-3">Головна</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('patient.appointments.create') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12.5 8.7a2.5 2.5 0 0 1 3.5 0 2.5 2.5 0 0 1 0 3.5l-1.1 1a1 1 0 0 0-.2-.2l-3-3-.3-.2 1.1-1Zm-2.4 2.5L7.3 14a1 1 0 0 0-.3.7v2c0 .6.4 1 1 1h2c.3 0 .5 0 .7-.3l2.8-2.8-.2-.2-3-3-.2-.2Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M7 3c.6 0 1 .4 1 1v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2h1V4c0-.6.4-1 1-1Zm10.7 8H19v8H5v-8h3.9l.5-.5c.2-.3.5-.4.9-.3 0 0 .2.1.2 0V10a1 1 0 0 1 .2-.9l1.1-1a3.5 3.5 0 0 1 4.9 0 3.5 3.5 0 0 1 1 2.9Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-3">Записатися на прийом</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('patient.appointments.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5 5c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1h1c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1h1c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1a2 2 0 0 1 2 2v1c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1V7c0-1.1.9-2 2-2ZM3 19v-7c0-.6.4-1 1-1h16c.6 0 1 .4 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6-6c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1Zm2 0a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Zm6 0c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1ZM7 17a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Zm6 0c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1Zm2 0a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-3">Прийоми</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('patient.bills.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4 5a2 2 0 0 0-2 2v10c0 1.1.9 2 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H4Zm0 6h16v6H4v-6Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M5 14c0-.6.4-1 1-1h2a1 1 0 1 1 0 2H6a1 1 0 0 1-1-1Zm5 0c0-.6.4-1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-3">Рахунки</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('patient.payments.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 14a3 3 0 0 1 3-3h4a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-4a3 3 0 0 1-3-3Zm3-1a1 1 0 1 0 0 2h4v-2h-4Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M12.3 3.3a1 1 0 0 1 1.4 0L16.4 6h-2.8l-1.3-1.3a1 1 0 0 1 0-1.4Zm.1 2.7L9.7 3.3a1 1 0 0 0-1.4 0L5.6 6h6.8ZM4.6 7A2 2 0 0 0 3 9v10c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2h-4a5 5 0 0 1 0-10h4a2 2 0 0 0-1.5-2h-13Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-3">Платежі</span>
                    </a>
                </li>
            @elseif(Auth::user()->hasRole('receptionist'))
                <li>
                    <a href="{{ route('receptionist.dashboard.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.3 3.3a1 1 0 0 1 1.4 0l6 6 2 2a1 1 0 0 1-1.4 1.4l-.3-.3V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3c0 .6-.4 1-1 1H7a2 2 0 0 1-2-2v-6.6l-.3.3a1 1 0 0 1-1.4-1.4l2-2 6-6Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="ml-3">Головна</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('receptionist.appointments.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5 5c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1h1c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1h1c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1a2 2 0 0 1 2 2v1c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1V7c0-1.1.9-2 2-2ZM3 19v-7c0-.6.4-1 1-1h16c.6 0 1 .4 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6-6c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1Zm2 0a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Zm6 0c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1ZM7 17a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Zm6 0c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1Zm2 0a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-3">Прийоми</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('receptionist.patients.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.3-2a6 6 0 0 0 0-6A4 4 0 0 1 20 8a4 4 0 0 1-6.7 3Zm2.2 9a4 4 0 0 0 .5-2v-1a6 6 0 0 0-1.5-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.5Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="ml-3">Пацієнти</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('receptionist.bills.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4 5a2 2 0 0 0-2 2v10c0 1.1.9 2 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H4Zm0 6h16v6H4v-6Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M5 14c0-.6.4-1 1-1h2a1 1 0 1 1 0 2H6a1 1 0 0 1-1-1Zm5 0c0-.6.4-1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-3">Рахунки</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('receptionist.payments.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 14a3 3 0 0 1 3-3h4a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-4a3 3 0 0 1-3-3Zm3-1a1 1 0 1 0 0 2h4v-2h-4Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M12.3 3.3a1 1 0 0 1 1.4 0L16.4 6h-2.8l-1.3-1.3a1 1 0 0 1 0-1.4Zm.1 2.7L9.7 3.3a1 1 0 0 0-1.4 0L5.6 6h6.8ZM4.6 7A2 2 0 0 0 3 9v10c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2h-4a5 5 0 0 1 0-10h4a2 2 0 0 0-1.5-2h-13Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-3">Платежі</span>
                    </a>
                </li>
            @elseif(Auth::user()->hasRole('admin'))
                <li>
                    <a href="{{ route('admin.dashboard.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.3 3.3a1 1 0 0 1 1.4 0l6 6 2 2a1 1 0 0 1-1.4 1.4l-.3-.3V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3c0 .6-.4 1-1 1H7a2 2 0 0 1-2-2v-6.6l-.3.3a1 1 0 0 1-1.4-1.4l2-2 6-6Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="ml-3">Головна</span>
                    </a>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 6c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Zm2 8v-2h7v2H4Zm0 2v2h7v-2H4Zm9 2h7v-2h-7v2Zm7-4v-2h-7v2h7Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Таблиці</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.patients.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Пацієнти</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dentists.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Стоматологи</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.receptionists.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Реєстратори</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.admins.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Адміністратори</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.educations.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Освіта стоматологів</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.vacations.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Відпустки</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.weekends.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Вихідні дні</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.schedules.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Графіки роботи</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.appointments.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Прийоми</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.treatments.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Лікування</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.bills.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Рахунки</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.payments.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Платежі</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.services.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <span class="ml-3">Послуги</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M9.586 2.586A2 2 0 0 1 11 2h2a2 2 0 0 1 2 2v.089l.473.196.063-.063a2.002 2.002 0 0 1 2.828 0l1.414 1.414a2 2 0 0 1 0 2.827l-.063.064.196.473H20a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-.089l-.196.473.063.063a2.002 2.002 0 0 1 0 2.828l-1.414 1.414a2 2 0 0 1-2.828 0l-.063-.063-.473.196V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.089l-.473-.196-.063.063a2.002 2.002 0 0 1-2.828 0l-1.414-1.414a2 2 0 0 1 0-2.827l.063-.064L4.089 15H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h.09l.195-.473-.063-.063a2 2 0 0 1 0-2.828l1.414-1.414a2 2 0 0 1 2.827 0l.064.063L9 4.089V4a2 2 0 0 1 .586-1.414ZM8 12a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z" clip-rule="evenodd"/>
                        </svg>

                        <span class="ml-3">Налаштування</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>

