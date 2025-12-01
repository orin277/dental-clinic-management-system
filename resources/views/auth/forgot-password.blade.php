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
                    <x-form.label for="email">Email</x-form.label>
                    <x-form.email-input name="email" id="email" required />
                    <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <x-primary-button>Відновити пароль</x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>
