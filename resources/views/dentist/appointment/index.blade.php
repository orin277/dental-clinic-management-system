<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <div class="rounded-t-lg shadow p-6 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 mx-10 mt-8">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <h1 class="text-2xl font-inter-bold text-gray-900 sm:text-2xl dark:text-white">Прийоми</h1>
                    </div>
                    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form id="form-appointment" class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto" action="{{ route('dentist.appointments.index') }}" method="GET">
                                <div class="w-full">
{{--                                    <label for="date" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Дата</label>--}}
                                    <input type="date" name="filter[date]" id="date"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder=""
                                           required=""
                                           value="{{ request('filter') ? request('filter')['date'] : date('Y-m-d', time()) }}"
                                    >
                                </div>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-b-lg shadow relative h-full overflow-y-auto bg-white dark:bg-gray-900 mx-10 mb-8">
                <div class="flex flex-col">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-blue-700 text-left text-xs font-inter-medium uppercase tracking-widest text-white">
                        <tr>
                            <th scope="col" class="p-4 text-xs text-left uppercase dark:text-gray-400">
                                №
                            </th>
                            <th scope="col" class="p-4 text-xs text-left uppercase dark:text-gray-400">
                                Пацієнт
                            </th>
                            <th scope="col" class="p-4 text-xs text-left uppercase dark:text-gray-400">
                                Статус
                            </th>
                            <th scope="col" class="p-4 text-xs text-left uppercase dark:text-gray-400">
                                Дата
                            </th>
                            <th scope="col" class="p-4 text-xs text-left uppercase dark:text-gray-400">
                                Початок
                            </th>
                            <th scope="col" class="p-4 text-xs text-left uppercase dark:text-gray-400">
                                Кінець
                            </th>
                            <th scope="col" class="p-4 text-xs text-left uppercase dark:text-gray-400">
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach ($appointments as $appointment)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $appointment->id }}</td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $appointment->patient_name . ' ' . $appointment->patient_surname . ' ' . $appointment->patient_patronymic }}</td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if($appointment->appointment_status_id === 1)
                                        <span class="bg-blue-600 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Заплановано</span>
                                    @elseif($appointment->appointment_status_id === 2)
                                        <span class="bg-red-600 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Скасовано</span>
                                    @elseif($appointment->appointment_status_id === 3)
                                        <span class="bg-gray-500 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Пропущено</span>
                                    @elseif($appointment->appointment_status_id === 4)
                                        <span class="bg-green-500 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Завершено</span>
                                    @endif
                                </td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ date('d-m-Y', strtotime($appointment->date)) }}</td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ substr($appointment->start_time, 0, 5) }}</td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ substr($appointment->end_time, 0, 5) }}</td>

                                <td class="p-4 space-x-2 whitespace-nowrap flex">
                                    @if($appointment->appointment_status_id === 1 || $appointment->appointment_status_id === 4)
                                        <a href="{{ route('dentist.appointments.edit', ['appointment' => $appointment->id]) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('dentist.treatments.manage', ['appointment' => $appointment->id]) }}" type="button" class="font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Керувати лікуванням
                                        </a>
                                        <a href="{{ route('dentist.bills.manage', ['appointment' => $appointment->id]) }}" type="button" class="font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Керувати рахунками
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="p-4">
                        {{ $appointments->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentDate = new Date();

        let minDate = currentDate.toISOString().split('T')[0];
        document.getElementById("date").min = minDate;

        let maxDate = new Date(currentDate);
        maxDate.setDate(currentDate.getDate() + 30);
        maxDate = maxDate.toISOString().split('T')[0];
        document.getElementById("date").max = maxDate;

        document.getElementById('date').addEventListener('change', loadAppointments);

        //loadAppointments()

        function loadAppointments() {
            const form = document.getElementById('form-appointment');
            form.submit();
        }
    });
</script>
