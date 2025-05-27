<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto pt:mt-0 dark:bg-gray-900">
        <div class="mt-24 w-full max-w-xl p-6 space-y-4 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Відновіть пароль
            </h2>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Забули свій пароль? Без проблем. Просто вкажіть свою адресу електронної пошти, і ми надішлемо вам посилання для скидання пароля, за яким ви зможете створити новий.') }}
            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" maxlength="255" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <button type="submit" class="px-6 py-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Відновити пароль</button>
            </form>
        </div>
    </div>
</x-guest-layout>
