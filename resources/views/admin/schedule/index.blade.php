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
                        <x-admin-panel.h1>Графік</x-admin-panel.h1>
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
                                        required
                                    />
                                </div>
                                <x-form.search-button>Пошук</x-form.search-button>
                            </form>
                        </div>
                        <x-form.add-link :href='route("$role.schedules.create")' id="createButton">
                            Додати
                        </x-form.add-link>
                    </div>
                </div>
            </div>
            <div class="rounded-b-lg shadow relative h-full overflow-y-auto bg-gray-50 dark:bg-gray-900 mx-10 mb-8">
                <div class="flex flex-col">
                    <x-admin-panel.table>
                        <x-slot:header>
                            <x-admin-panel.table.th>Стоматолог</x-admin-panel.table.th>
                            <x-admin-panel.table.th>День тижня</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Початок</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Кінець</x-admin-panel.table.th>
                            <x-admin-panel.table.th></x-admin-panel.table.th>
                        </x-slot:header>
                        @foreach($schedules as $schedule)
                            <x-admin-panel.table.tr>
                                <x-admin-panel.table.td>{{ $schedule->dentist_name . ' ' . $schedule->dentist_surname . ' ' . $schedule->dentist_patronymic }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $schedule->day_of_week_name }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ substr($schedule->start_time, 0, 5) }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ substr($schedule->end_time, 0, 5) }}</x-admin-panel.table.td>
                                <x-admin-panel.table.edit-td
                                    :href='route("$role.schedules.edit", ["schedule" => $schedule->id])'
                                    :action='route("$role.schedules.destroy", $schedule->id)'
                                >
                                </x-admin-panel.table.edit-td>
                            </x-admin-panel.table.tr>
                        @endforeach
                    </x-admin-panel.table>
                    <div class="p-4">
                        {{ $schedules->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
