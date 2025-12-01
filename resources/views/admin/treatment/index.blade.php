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
            <div class="rounded-t-lg shadow p-6 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 mx-10 mt-8">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <x-admin-panel.h1>Лікування</x-admin-panel.h1>
                    </div>
                    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto" action="#" method="GET">
                                <div>
                                    <label for="search" class="sr-only">Пошук</label>
                                    <x-form.text-input
                                        name="filter[search]"
                                        id="search-filter"
                                        class="w-72"
                                        placeholder="Пошук"
                                        :value="request('filter') ? request('filter')['search'] : ''"
                                        required>
                                    </x-form.text-input>
                                </div>
                                <label class="">Від</label>
                                <x-form.date-input
                                    name="filter[from]"
                                    id="from-filter"
                                    :value="request('filter') ? request('filter')['from'] : ''"
                                    placeholder="Від"
                                    required>
                                </x-form.date-input>
                                <label class="">До</label>
                                <x-form.date-input
                                    name="filter[to]"
                                    id="to-filter"
                                    :value="request('filter') ? request('filter')['to'] : ''"
                                    placeholder="До"
                                    required>
                                </x-form.date-input>
                                <x-form.search-button>Пошук</x-form.search-button>
                            </form>
                        </div>
                        <x-form.add-link :href='route("$role.treatments.create")' id="createButton">
                            Додати
                        </x-form.add-link>
                    </div>
                </div>
            </div>
            <div class="rounded-b-lg shadow relative h-full overflow-y-auto bg-white dark:bg-gray-900 mx-10 mb-8">
                <div class="flex flex-col">
                    <x-admin-panel.table>
                        <x-slot:header>
                            <x-admin-panel.table.th>Номер прийому</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Пацієнт</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Стоматолог</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Дата</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Діагноз</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Номер зуба</x-admin-panel.table.th>
                            <x-admin-panel.table.th></x-admin-panel.table.th>
                        </x-slot:header>
                        @foreach($treatments as $treatment)
                            <x-admin-panel.table.tr>
                                <x-admin-panel.table.td>{{ $treatment->appointment_id }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $treatment->patient_name . ' ' . $treatment->patient_surname . ' ' . $treatment->patient_patronymic }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $treatment->dentist_name . ' ' . $treatment->dentist_surname . ' ' . $treatment->dentist_patronymic }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ date('d-m-Y', strtotime($treatment->date)) }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $treatment->diagnosis }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $treatment->tooth_number }}</x-admin-panel.table.td>
                                <x-admin-panel.table.edit-td
                                    :href='route("$role.treatments.edit", ["treatment" => $treatment->id])'
                                    :action='route("$role.treatments.destroy", $treatment->id)'
                                >
                                </x-admin-panel.table.edit-td>
                            </x-admin-panel.table.tr>
                        @endforeach
                    </x-admin-panel.table>
                    <div class="p-4">
                        {{ $treatments->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
