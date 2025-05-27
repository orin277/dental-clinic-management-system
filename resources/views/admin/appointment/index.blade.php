@php
    use Illuminate\Support\Facades\Auth;

    if (Auth::user()->hasRole('admin')) {
        $role = 'admin';
    }
    else {
        $role = 'receptionist';
    }
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <div
                class="rounded-t-lg shadow p-6 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 mx-10 mt-8">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <h1 class="text-2xl font-inter-bold text-gray-900 sm:text-2xl dark:text-white">Прийоми</h1>
                    </div>
                    <div
                        class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto" action="#" method="GET">
                                <div>
                                    <label for="search" class="sr-only">Пошук</label>
                                    <input type="text" name="filter[search]" id="input-search"
                                           class="w-64 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Пошук"
                                           value="{{ request('filter') ? request('filter')['search'] : '' }}"
                                    >
                                </div>
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
                                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="sr-only">Пошук</span>
                                </button>
                            </form>
                        </div>
                        <a href="{{ route("{$role}.appointments.create") }}" id="createButton"
                           class="font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                           type="button" data-drawer-target="drawer-create-product-default"
                           data-drawer-show="drawer-create-product-default"
                           aria-controls="drawer-create-product-default" data-drawer-placement="right">
                            Додати
                        </a>
                    </div>
                </div>
            </div>
            <div class="rounded-b-lg shadow relative h-full overflow-y-auto bg-gray-50 dark:bg-gray-900 mx-10 mb-8">
                <div class="flex flex-col">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead
                            class="bg-blue-700 text-left text-xs font-inter-medium uppercase tracking-widest text-white">
                        <tr>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                №
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Стоматолог
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Кабінет
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Пацієнт
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Статус
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Дата
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Початок
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Кінець
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach ($appointments as $appointment)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $appointment->id }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $appointment->dentist_name . ' ' . $appointment->dentist_surname . ' ' . $appointment->dentist_patronymic }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $appointment->cabinet }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $appointment->patient_name . ' ' . $appointment->patient_surname . ' ' . $appointment->patient_patronymic }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $appointment->appointment_status_name }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ date('d-m-Y', strtotime($appointment->date)) }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ substr($appointment->start_time, 0, 5) }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ substr($appointment->end_time, 0, 5) }}</td>

                                <td class="p-4 space-x-2 whitespace-nowrap">
                                    <a href="{{ route("{$role}.appointments.edit", ['appointment' => $appointment->id]) }}"
                                       class="font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                            <path fill-rule="evenodd"
                                                  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </a>

                                    <form action="{{ route("{$role}.appointments.destroy", $appointment->id) }}"
                                          method="post" class="inline-flex ">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" id="deleteButton"
                                                class="font-inter-medium inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-full hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="p-4">
                        {{ $appointments->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
