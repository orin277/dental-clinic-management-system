@php
    $appointmentStatuses = $appointmentStatuses->pluck('name', 'id')->toArray();
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <div class="rounded-t-lg shadow p-6 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 mx-10 mt-8">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <x-admin-panel.h1>Прийоми</x-admin-panel.h1>
                    </div>
                    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form id="form-appointment" class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto" action="{{ route('dentist.appointments.index') }}" method="GET">
                                <div class="w-full">
                                    <x-form.date-input
                                        name="filter[date]"
                                        id="date-filter"
                                        :value="request('filter') ? request('filter')['date'] : date('Y-m-d', time())"
                                        placeholder=""
                                        required
                                    />
                                </div>
                                <x-form.select
                                    id="appointment_status_filter"
                                    name="filter[appointment_status_id]"
                                    class="w-64"
                                    :options="$appointmentStatuses"
                                    :value="request('filter') && request('filter')['appointment_status_id']"
                                    first_item="Статус прийому"
                                />
                                <x-form.search-button>Пошук</x-form.search-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-b-lg shadow relative h-full overflow-y-auto bg-white dark:bg-gray-900 mx-10 mb-8">
                <div class="flex flex-col">
                    <x-admin-panel.table>
                        <x-slot:header>
                            <x-admin-panel.table.th>№</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Пацієнт</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Статус</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Дата</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Початок</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Кінець</x-admin-panel.table.th>
                            <x-admin-panel.table.th></x-admin-panel.table.th>
                        </x-slot:header>
                        @foreach($appointments as $appointment)
                            <x-admin-panel.table.tr>
                                <x-admin-panel.table.td>{{ $appointment->id }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $appointment->patient_name . ' ' . $appointment->patient_surname . ' ' . $appointment->patient_patronymic }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>
                                    @if($appointment->appointment_status_id === 1)
                                        <span class="bg-blue-600 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Заплановано</span>
                                    @elseif($appointment->appointment_status_id === 2)
                                        <span class="bg-red-600 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Скасовано</span>
                                    @elseif($appointment->appointment_status_id === 3)
                                        <span class="bg-gray-500 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Пропущено</span>
                                    @elseif($appointment->appointment_status_id === 4)
                                        <span class="bg-green-500 rounded-full text-white text-sm px-4 py-1 font-inter-medium">Завершено</span>
                                    @endif
                                </x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ date('d-m-Y', strtotime($appointment->date)) }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ substr($appointment->start_time, 0, 5) }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ substr($appointment->end_time, 0, 5) }}</x-admin-panel.table.td>
                                @if($appointment->appointment_status_id === 1 || $appointment->appointment_status_id === 4)
                                    <x-admin-panel.table.manage-appointment-td
                                        :edit_href="route('dentist.appointments.edit', ['appointment' => $appointment->id])"
                                        :manage_treatment="route('dentist.treatments.manage', ['appointment' => $appointment->id])"
                                        :manage_bills="route('dentist.bills.manage', ['appointment' => $appointment->id])"
                                    >
                                    </x-admin-panel.table.manage-appointment-td>
                                @else
                                    <td></td>
                                @endif
                            </x-admin-panel.table.tr>
                        @endforeach
                    </x-admin-panel.table>
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
        document.getElementById("date-filter").min = minDate;

        let maxDate = new Date(currentDate);
        maxDate.setDate(currentDate.getDate() + 30);
        maxDate = maxDate.toISOString().split('T')[0];
        document.getElementById("date-filter").max = maxDate;

        document.getElementById('date-filter').addEventListener('change', loadAppointments);

        //loadAppointments()

        function loadAppointments() {
            const form = document.getElementById('form-appointment');
            form.submit();
        }
    });
</script>
