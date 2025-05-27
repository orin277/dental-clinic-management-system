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
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <h2 class="mb-4 text-2xl font-inter-bold text-gray-900 dark:text-white">Додавання пацієнта</h2>
                    <form action="{{ route("{$role}.patients.store") }}" method="post">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <label for="name" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Ім'я</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="@error('name') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" minlength="1" maxlength="30">
                                @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="surname" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Прізвище</label>
                                <input type="text" name="surname" id="surname" value="{{ old('surname') }}" class="@error('surname') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" minlength="1" maxlength="40">
                                @error('surname')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="patronymic" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">По батькові</label>
                                <input type="text" name="patronymic" id="patronymic" value="{{ old('patronymic') }}" class="@error('patronymic') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" minlength="1" maxlength="30">
                                @error('patronymic')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="date_of_birth" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Дата народження</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="@error('date_of_birth') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                                @error('date_of_birth')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="sex" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Стать</label>
                                <select id="sex" name="sex" class="@error('sex') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="1" {{ old('sex') == '1' ? 'selected' : '' }}>Чоловік</option>
                                    <option value="2" {{ old('sex') == '2' ? 'selected' : '' }}>Жінка</option>
                                </select>
                                @error('sex')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="phone" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Номер телефону</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="@error('phone') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                                @error('phone')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="email" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="@error('email') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" minlength="5" maxlength="255">
                                @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="address" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Адреса</label>
                                <input type="text" name="address" id="address" value="{{ old('address') }}" class="@error('address') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" maxlength="100">
                                @error('address')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="allergies" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Алергії</label>
                                <input type="text" name="allergies" id="allergies" value="{{ old('allergies') }}" class="@error('allergies') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" maxlength="300">
                                @error('allergies')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="password" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Пароль</label>
                                <input type="password" name="password" id="password" value="{{ old('password') }}" class="@error('password') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" minlength="8" maxlength="30">
                                @error('password')
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
