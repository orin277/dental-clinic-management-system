<x-app-layout>
    <div class="flex overflow-hidden dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto lg:ml-64 dark:bg-gray-900">
            <div class="rounded-lg shadow p-6 mx-10 my-8 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <h1 class="text-2xl font-inter-bold text-gray-900 sm:text-2xl dark:text-white">Прийоми</h1>
                    </div>
                    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form class="sm:pr-3" action="{{ route("patient.appointments.index") }}" method="GET">
                                <div class="flex items-center w-full space-x-3 md:w-auto">
                                    <label class="">Від</label>
                                    <input type="date" name="filter[from]"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Від"
                                           value="{{ request('filter') ? request('filter')['from'] : '' }}"
                                    >
                                    <label class="">До</label>
                                    <input type="date" name="filter[to]"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="До"
                                           value="{{ request('filter') ? request('filter')['to'] : '' }}"
                                    >
                                    <select id="status" name="filter[appointment_status_id]" class="w-64 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Статус прийому</option>
                                        @foreach($appointmentStatuses as $appointmentStatus)
                                        <option
                                            value="{{ $appointmentStatus->id }}"
                                            {{ request('filter') && request('filter')['appointment_status_id'] == $appointmentStatus->id ? 'selected' : '' }}
                                        >
                                            {{ $appointmentStatus->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                        <span class="sr-only">Пошук</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900">
                <div class="flex flex-col">
                    @foreach($appointments as $appointment)
                        <div class="max-w-md mx-auto bg-white rounded-xl shadow overflow-hidden md:max-w-2xl m-3 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <div class="md:flex">
                                <div class="p-8">
                                    <div class="flex justify-between items-center w-96">
                                        <div class="uppercase tracking-wide text-sm text-blue-500 font-inter-semi-bold">
                                            {{ $appointment->dentist_specialization_name }}</div>
                                        @if($appointment->appointment_status_id === 1)
                                        <span class="bg-blue-600 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Заплановано</span>
                                        @elseif($appointment->appointment_status_id === 2)
                                        <span class="bg-red-600 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Скасовано</span>
                                        @elseif($appointment->appointment_status_id === 3)
                                            <span class="bg-gray-500 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Пропущено</span>
                                        @elseif($appointment->appointment_status_id === 4)
                                            <span class="bg-green-500 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Завершено</span>
                                        @endif
                                    </div>

                                    <p class="block mt-1 text-lg leading-tight font-inter-medium text-black">{{ $appointment->dentist_surname . ' ' . $appointment->dentist_name . ' ' . $appointment->dentist_patronymic }}</p>
                                    <p class="mt-2 text-gray-500 font-inter-regular">Дата: {{ date('d-m-Y', strtotime($appointment->date)) }}</p>
                                    <p class="mt-2 text-gray-500 font-inter-regular">Час: {{ substr($appointment->start_time, 0, 5) . ' - ' . substr($appointment->end_time, 0, 5) }}</p>
                                    <p class="mt-2 text-gray-500 font-inter-regular">Кабінет: {{ $appointment->cabinet }}</p>

                                    @if($appointment->appointment_status_id === 4 or $appointment->appointment_status_id === 1)
                                    <div class="flex mt-5">
                                        @if($appointment->appointment_status_id === 4)
                                        <a href="{{ route('patient.appointments.show', $appointment->id) }}" class="px-4 py-2 border border-transparent text-sm font-inter-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Переглянути деталі
                                        </a>
                                        @endif
                                        @if($appointment->appointment_status_id === 1)
                                            <form action="{{ route('patient.appointments.cancel', $appointment->id) }}" method="POST" class="">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="px-4 py-2 border border-transparent text-sm font-inter-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Відмінити запис
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                        <div class="p-4">
                            {{ $appointments->withQueryString()->links() }}
                        </div>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>
