<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <h2 class="mb-4 text-2xl font-inter-bold text-gray-900 dark:text-white">Додавання послуги</h2>
                    <form action="{{ route('admin.services.store') }}" method="post">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div>
                                <label for="type_of_service_id" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Тип послуги</label>
                                <select id="type_of_service_id" name="type_of_service_id" class="@error('type_of_service_id') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($typeOfServices as $typeOfService)
                                        <option value="{{ $typeOfService->id }}" {{ old('type_of_service_id') == $typeOfService->id ? 'selected' : '' }}>{{ $typeOfService->name }}</option>
                                    @endforeach
                                </select>
                                @error('type_of_service_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="name" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Сума</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="@error('name') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" minlength="5" maxlength="50">
                                @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="price" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Ціна</label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" min="1" max="1000000" class="@error('price') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                                @error('price')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="font-inter-medium mt-6 inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Додати
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
