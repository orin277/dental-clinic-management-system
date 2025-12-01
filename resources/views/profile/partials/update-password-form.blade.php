<section>
    <header>
        <h2 class="text-lg font-inter-medium text-gray-900">
            {{ __('Зміна паролю') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Переконайтеся, що ваш обліковий запис використовує довгий довільний пароль, щоб залишатися в безпеці.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-form.label for="update_password_current_password">Поточний пароль</x-form.label>
            <x-form.password-input id="update_password_current_password" name="current_password" class="mt-1 block w-full" />
            <x-form.input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-form.label for="update_password_password">Новий пароль</x-form.label>
            <x-form.password-input id="update_password_password" name="password" class="mt-1 block w-full" />
            <x-form.input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-form.label for="update_password_password_confirmation">Підтвердження паролю</x-form.label>
            <x-form.password-input id="update_password_password_confirmation" name="password_confirmation" class="mt-1 block w-full" />
            <x-form.input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Змінити') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Оновлено.') }}</p>
            @endif
        </div>
    </form>
</section>
