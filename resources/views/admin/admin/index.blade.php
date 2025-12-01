<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <div class="rounded-t-lg shadow p-6 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 mx-10 mt-8">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <x-admin-panel.h1>Адміністратори</x-admin-panel.h1>
                    </div>
                    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto" action="{{ route("admin.admins.index") }}" method="GET">
                                <div>
                                    <label for="search" class="sr-only">Пошук</label>
                                    <x-form.text-input
                                        name="filter[search]"
                                        id="search-filter"
                                        placeholder="Пошук"
                                        :value="request('filter') ? request('filter')['search'] : ''"
                                        required
                                    />
                                </div>
                                <x-form.search-button>Пошук</x-form.search-button>
                            </form>
                        </div>
                        <x-form.add-link :href='route("admin.admins.create")' id="createButton">
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
                            <x-admin-panel.table.th></x-admin-panel.table.th>
                        </x-slot:header>
                        @foreach($admins as $admin)
                            <x-admin-panel.table.tr>
                                <x-admin-panel.table.td>{{ $admin->name . ' ' . $admin->surname . ' ' . $admin->patronymic }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $admin->email }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ $admin->phone }}</x-admin-panel.table.td>
                                <x-admin-panel.table.td>{{ date('d-m-Y', strtotime($admin->date_of_birth)) }}</x-admin-panel.table.td>
                                <x-admin-panel.table.edit-td
                                    :href='route("admin.admins.edit", ["admin" => $admin->id])'
                                    :action='route("admin.admins.destroy", $admin->id)'
                                >
                                </x-admin-panel.table.edit-td>
                            </x-admin-panel.table.tr>
                        @endforeach
                    </x-admin-panel.table>
                    <div class="p-4">
                        {{ $admins->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


