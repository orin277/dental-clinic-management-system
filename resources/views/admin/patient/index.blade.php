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
                        <x-admin-panel.h1>Пацієнти</x-admin-panel.h1>
                    </div>
                    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto" action="{{ route("$role.patients.index") }}" method="GET">
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
                        <x-form.add-link :href='route("$role.patients.create")' id="createButton">
                            Додати
                        </x-form.add-link>
                    </div>
                </div>
            </div>
            <div class="rounded-b-lg shadow relative h-full overflow-y-auto bg-gray-50 dark:bg-gray-900 mx-10 mb-8">
                <div class="flex flex-col">
                    <x-admin-panel.table>
                        <x-slot:header>
                            <x-admin-panel.table.th>ПІБ</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Email</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Номер телефону</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Дата народження</x-admin-panel.table.th>
                            <x-admin-panel.table.th>Стать</x-admin-panel.table.th>
                            <x-admin-panel.table.th></x-admin-panel.table.th>
                        </x-slot:header>
                        @foreach($patients as $patient)
                            <x-admin-panel.table.tr>
                                <x-admin-panel.table.td>{{ $patient->name . ' ' . $patient->surname . ' ' . $patient->patronymic }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $patient->email }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $patient->phone }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ date('d-m-Y', strtotime($patient->date_of_birth)) }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $patient->sex === 1 ? 'Ч' : 'Ж' }}</x-admin-panel.table.td>
                                <x-admin-panel.table.edit-td
                                    :href='route("$role.patients.edit", ["patient" => $patient->id])'
                                    :action='route("$role.patients.destroy", $patient->id)'
                                >
                                </x-admin-panel.table.edit-td>
                            </x-admin-panel.table.tr>
                        @endforeach
                    </x-admin-panel.table>
                    <div class="p-4">
                        {{ $patients->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>
    @if (session('error'))
        <div id="toast-danger" class="opacity-100 transition-opacity ease-in duration-700 fixed top-1/4 left-1/2 flex items-center w-full max-w-sm p-4 mb-4 text-gray-500 bg-white rounded-lg border shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-m font-inter-medium">{{ session('error') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        setTimeout(() => {
            const errorMessage = document.getElementById('toast-danger');
            if (errorMessage) {
                errorMessage.style.transition = 'opacity 1s';
                errorMessage.style.opacity = '0';
                setTimeout(() => errorMessage.remove(), 1000);
            }
        }, 5000);
    });
</script>

