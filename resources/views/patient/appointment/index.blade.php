@php
    $appointmentStatuses = $appointmentStatuses->pluck('name', 'id')->toArray();
@endphp
<x-app-layout>
    <div class="flex overflow-hidden dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto lg:ml-64 dark:bg-gray-900">
            <div class="rounded-lg shadow p-6 mx-10 my-8 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <x-admin-panel.h1>Прийоми</x-admin-panel.h1>
                    </div>
                    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form class="sm:pr-3" action="{{ route("patient.appointments.index") }}" method="GET">
                                <div class="flex items-center w-full space-x-3 md:w-auto">
                                    <label class="">Від</label>
                                    <x-form.date-input
                                        name="filter[from]"
                                        id="from-filter"
                                        :value="request('filter') ? request('filter')['from'] : ''"
                                        placeholder="Від"
                                        required
                                    />
                                    <label class="">До</label>
                                    <x-form.date-input
                                        name="filter[to]"
                                        id="to-filter"
                                        :value="request('filter') ? request('filter')['to'] : ''"
                                        placeholder="До"
                                        required
                                    />
                                    <x-form.select
                                        id="appointment_status_filter"
                                        name="filter[appointment_status_id]"
                                        class="w-64"
                                        :options="$appointmentStatuses"
                                        :value="request('filter') && request('filter')['appointment_status_id']"
                                        first_item="Статус прийому"
                                    />
                                    <x-form.search-button>Пошук</x-form.search-button>
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
                                            <x-primary-button-link :href="route('patient.appointments.show', $appointment->id)">
                                                Переглянути деталі
                                            </x-primary-button-link>
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
