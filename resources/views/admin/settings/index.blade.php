@php
    $backupFiles = [];
    foreach ($paginator as $backupFile) {
        $file_base_name = basename($backupFile);
        $backupFiles[$file_base_name] = $file_base_name;
    }
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <div class="w-1/2 rounded-lg shadow p-8 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 mx-10 mt-8">
                <div class="w-full">
                    <div class="mb-6">
                        <x-admin-panel.h1>Налаштування</x-admin-panel.h1>
                    </div>
                    <div class="items-center justify-between block md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="mb-6 sm:mb-0">
                            <form class="flex items-center w-full md:w-auto" action="{{ route('admin.settings.create_backup_database') }}" method="POST">
                                @csrf
                                @method('post')
                                <x-primary-button class="w-48">Створити бекап БД</x-primary-button>
                            </form>
                            <form class="mt-6 flex items-center w-full md:w-auto" action="{{ route('admin.settings.restore_database') }}" method="POST">
                                @csrf
                                @method('post')
                                <x-primary-button class="w-48">Відновити БД</x-primary-button>
                                <x-form.select name="backup_file" id="backup_file" :options="$backupFiles" class="ml-3 p-2.5" />
                            </form>
                            <div class="">
                                {{ $paginator->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
