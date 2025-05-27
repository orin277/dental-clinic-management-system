<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <h2 class="mb-4 text-2xl font-inter-bold text-gray-900 dark:text-white">Додавання освіти</h2>
                    <form action="{{ route('admin.educations.store') }}" method="post">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div>
                                <label for="dentist_id" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Стоматолог</label>
                                <select id="dentist_id" name="dentist_id" class="@error('dentist_id') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($dentists as $dentist)
                                        <option value="{{ $dentist->id }}" {{ old('dentist_id') == $dentist->id ? 'selected' : '' }}>{{ $dentist->name . ' ' . $dentist->surname . ' ' . $dentist->patronymic }}</option>
                                    @endforeach
                                </select>
                                @error('dentist_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="name_of_institution" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Назва закладу</label>
                                <input type="text" name="name_of_institution" id="name_of_institution" value="{{ old('name_of_institution') }}" class="@error('name_of_institution') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" minlength="3" maxlength="100">
                                @error('name_of_institution')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="graduation_year" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Рік випуску</label>
                                <input type="number" name="graduation_year" id="graduation_year" value="{{ old('graduation_year') }}" class="@error('graduation_year') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                                @error('graduation_year')
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
