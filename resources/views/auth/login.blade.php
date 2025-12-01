<x-guest-layout>
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto pt:mt-0 dark:bg-gray-900">
        <div class="mt-24 w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Увійдіть в систему
            </h2>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-form.label for="email">Email</x-form.label>
                    <x-form.email-input name="email" id="email" minlength="1" maxlength="255" placeholder="user@gmail.com" required />
                    <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <x-form.label for="password">Пароль</x-form.label>
                    <x-form.password-input name="password" id="password" minlength="8" maxlength="30" placeholder="••••••••" required />
                    <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-900 dark:text-white">Запам'ятати</label>
                    </div>
                    <a href="{{ route("password.request") }}" class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">Забули пароль?</a>
                </div>
                <x-primary-button>Увійти</x-primary-button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Не зареєстровані? <a href="{{ route('register') }}" class="text-primary-700 hover:underline dark:text-primary-500">Створіть акаунт</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
