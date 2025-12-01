@php
    $sex = [1 => 'Чоловік', 2 => 'Жінка'];
@endphp
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
                        <x-form.label for="name">Ім'я</x-form.label>
                        <x-form.text-input name="name" id="name" minlength="1" maxlength="30" required />
                        <x-form.input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-form.label for="surname">Прізвище</x-form.label>
                        <x-form.text-input name="surname" id="surname" minlength="1" maxlength="30" required />
                        <x-form.input-error :messages="$errors->get('surname')" class="mt-2" />
                    </div>
                    <div>
                        <x-form.label for="patronymic">По батькові</x-form.label>
                        <x-form.text-input name="patronymic" id="patronymic" minlength="1" maxlength="30" required />
                        <x-form.input-error :messages="$errors->get('patronymic')" class="mt-2" />
                    </div>
                </div>
                <div class="grid gap-3 md:grid-cols-2">
                    <div>
                        <x-form.label for="date_of_birth">Дата народження</x-form.label>
                        <x-form.date-input name="date_of_birth" id="date_of_birth" required />
                        <x-form.input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                    </div>
                    <div>
                        <x-form.label for="sex">Стать</x-form.label>
                        <x-form.select id="sex" name="sex" :options="$sex" />
                    </div>
                </div>
                <div class="grid gap-3 md:grid-cols-2">
                    <div>
                        <x-form.label for="phone">Номер телефону</x-form.label>
                        <x-form.tel-input name="phone" id="phone" placeholder="+380*********" required />
                        <x-form.input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div>
                        <x-form.label for="email">Email</x-form.label>
                        <x-form.email-input name="email" id="email" minlength="1" maxlength="255" placeholder="user@gmail.com" required />
                        <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-form.label for="password">Пароль</x-form.label>
                    <x-form.password-input name="password" id="password" minlength="8" maxlength="30" placeholder="••••••••" required />
                    <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <x-form.label for="password_confirmation">Підтвердити пароль</x-form.label>
                    <x-form.password-input name="password_confirmation" id="password_confirmation" minlength="8" maxlength="30" placeholder="••••••••" required />
                    <x-form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required="">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-900 dark:text-white">Я приймаю <a href="#" class="text-primary-700 hover:underline dark:text-primary-500">Загальні положення та умови</a></label>
                    </div>
                </div>
                <x-primary-button>Зареєструватися</x-primary-button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Вже зареєстровані? <a href="{{ route('login') }}" class="text-primary-700 hover:underline dark:text-primary-500">Увійдіть</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
