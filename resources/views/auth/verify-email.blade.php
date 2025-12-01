<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Дякуємо за реєстрацію! Перш ніж розпочати, чи не могли б ви підтвердити свою адресу електронної пошти, натиснувши на посилання, яке ми щойно надіслали вам електронною поштою? Якщо ви не отримали електронного листа, ми з радістю надішлемо вам інший.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Нове посилання для підтвердження було надіслано на адресу електронної пошти, яку ви вказали під час реєстрації.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-primary-button>
                    {{ __('Надіслати повторне підтвердження') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-primary-button>Вийти</x-primary-button>
        </form>
    </div>
</x-guest-layout>
