<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <div class="w-1/2 rounded-lg shadow p-8 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 mx-10 mt-8">
                <div class="w-full">
                    <div class="mb-6">
                        <h1 class="text-2xl font-inter-bold text-gray-900 sm:text-2xl dark:text-white">Налаштування</h1>
                    </div>
                    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="mb-6 sm:mb-0">
                            <form class="sm:pr-3 flex items-center w-full md:w-auto" action="{{ route('admin.settings.create_backup_database') }}" method="POST">
                                @csrf
                                @method('post')
                                <button type="submit" class="font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Створити бекап БД
                                </button>
                            </form>
                            <form class="mt-6 flex items-center w-full md:w-auto" action="{{ route('admin.settings.restore_database') }}" method="POST">
                                @csrf
                                @method('post')
                                <button type="submit" class="font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Відновити БД
                                </button>
                                <select name="backup_file" class="ml-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($paginator as $backupFile)
                                        <option value="{{ basename($backupFile) }}">{{ basename($backupFile) }}</option>
                                    @endforeach
                                </select>

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
