<x-guest-layout>
    <div class="flex flex-col items-center justify-center px-6 pt-8 dark:bg-gray-900">
        <div class="mb-8 w-full max-w-2xl p-6 space-y-8 sm:p-8 bg-white border-b rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                Зареєструйтеся
            </h2>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="grid gap-3 md:grid-cols-3">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ім'я</label>
                        <input type="text" name="name" id="name" maxlength="30" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div>
                        <label for="surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Прізвище</label>
                        <input type="text" name="surname" id="surname" maxlength="40" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div>
                        <label for="patronymic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">По батькові</label>
                        <input type="text" name="patronymic" id="patronymic" maxlength="30" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                </div>
                <div class="grid gap-3 md:grid-cols-2">
                    <div>
                        <label for="date_of_birth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дата народження</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div>
                        <label for="sex" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Стать</label>
                        <select id="sex" name="sex" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="1" selected="">Чоловік</option>
                            <option value="2">Жінка</option>
                        </select>
                    </div>
                </div>
                <div class="grid gap-3 md:grid-cols-2">
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Номер телефону</label>
                        <input type="tel" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="+380*********" required="">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="user@gmail.com" required="">
                    </div>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пароль</label>
                    <input type="password" name="password" id="password" maxlength="30" minlength="8" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Підтвердити пароль</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" maxlength="30" minlength="8" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required="">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-900 dark:text-white">Я приймаю <a href="#" class="text-primary-700 hover:underline dark:text-primary-500">Загальні положення та умови</a></label>
                    </div>
                </div>
                <button type="submit" class="px-6 py-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Зареєструватися</button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Вже зареєстровані? <a href="{{ route('login') }}" class="text-primary-700 hover:underline dark:text-primary-500">Увійдіть</a>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>


{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}

{{--        <!-- Name -->--}}
{{--        <div>--}}
{{--            <x-input-label for="name" :value="__('Name')" />--}}
{{--            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}

{{--            <x-primary-button class="ms-4">--}}
{{--                {{ __('Register') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
