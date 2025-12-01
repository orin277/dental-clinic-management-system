<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Будь ласка, підтвердьте свій пароль, перш ніж продовжити.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-form.label for="password">Пароль</x-form.label>
            <x-form.password-input id="password" class="block mt-1 w-full" name="password" required/>
            <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Підтвердити') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
