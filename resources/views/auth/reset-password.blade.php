<x-guest-layout>
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto pt:mt-0 dark:bg-gray-900">
        <div class="mt-24 w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Відновіть пароль
            </h2>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div>
                    <x-form.label for="email">Email</x-form.label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" maxlength="255" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="user@gmail.com" required autofocus autocomplete="username">
                    <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <x-form.label for="password">Пароль</x-form.label>
                    <input type="password" name="password" id="password" maxlength="30" minlength="8" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <x-form.label for="password_confirmation">Пароль</x-form.label>
                    <input type="password" name="password_confirmation" id="password_confirmation" maxlength="30" minlength="8" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    <x-form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <x-primary-button>Відновити пароль</x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>
