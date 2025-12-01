<section>
    <header>
        <h2 class="text-lg font-inter-medium text-gray-900">
            {{ __('Особисті дані') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Оновіть дані свого профілю.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="w-full grid grid-cols-2 gap-4" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="mt-6 grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div>
                <x-form.label for="name">Ім'я</x-form.label>
                <x-form.text-input id="name" name="name" :value="$user->name" class="mt-1" minlength="1" maxlength="30" required />
                <x-form.input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-form.label for="surname">Прізвище</x-form.label>
                <x-form.text-input id="surname" name="surname" :value="$user->surname" class="mt-1" minlength="1" maxlength="40" required />
                <x-form.input-error class="mt-2" :messages="$errors->get('surname')" />
            </div>

            <div>
                <x-form.label for="patronymic">По батькові</x-form.label>
                <x-form.text-input id="patronymic" name="patronymic" :value="$user->patronymic" class="mt-1" minlength="1" maxlength="40" required />
                <x-form.input-error class="mt-2" :messages="$errors->get('patronymic')" />
            </div>

            <div>
                <x-form.label for="phone">Номер телефону</x-form.label>
                <x-form.text-input id="phone" name="phone" :value="$user->phone" class="mt-1" minlength="1" maxlength="30" required />
                <x-form.input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div>
                <x-form.label for="date_of_birth">Дата народження</x-form.label>
                <x-form.date-input name="date_of_birth" id="date_of_birth" :value="$user->date_of_birth" class="mt-1" required />
                <x-form.input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
            </div>

            <div>
                <x-form.label for="email">Email</x-form.label>
                <x-form.email-input id="email" name="email" class="mt-1 block w-full" :value="$user->email" />
                <x-form.input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Ваш email не підтверджено.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Відправити знову підтвердження на email') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('Нове підтвердження було відправлено на ваш email') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="ml-20 mt-6 w-96">
            <x-input-label for="avatar" :value="__('Фото профілю')" class="mb-1"/>
            <label class="input-file">
                <input type="file" name="avatar" value="{{ old('avatar') }}" autocomplete="avatar">
                <span class="flex">
                    <span class=" cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-inter-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Оберіть файл</span>
                    <span class="input-file-text" type="text"></span>
                </span>
            </label>
            <img src="{{ asset("storage/avatars/" . Auth::user()->avatar) }}" class="w-44 mt-4">
            <x-form.input-error class="mt-2" :messages="$errors->get('avatar')" />
{{--            <x-input-label for="avatar" :value="__('Фото профілю')" />--}}
{{--            <div class="">--}}
{{--                <input id="avatar" type="file" class="block w-full mt-1 mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="avatar" value="{{ old('avatar') }}" autocomplete="avatar">--}}
{{--                <img src="{{ asset("storage/avatars/" . Auth::user()->avatar) }}" class="w-44 mt-8">--}}
{{--                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />--}}
{{--            </div>--}}
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Змінити') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Збережено.') }}</p>
            @endif
        </div>
    </form>
</section>
<script>
    document.querySelectorAll('.input-file input[type=file]').forEach(function(input) {
        input.addEventListener('change', function() {
            let file = this.files[0];
            this.closest('.input-file').querySelector('.input-file-text').innerHTML = file.name;
        });
    });
</script>
<style>
    .input-file {
        position: relative;
        display: inline-block;
    }
    .input-file-text {
        padding: 0 10px;
        line-height: 40px;
        text-align: left;
        height: 40px;
        display: block;
        float: left;
        box-sizing: border-box;
        width: 200px;
        border-radius: 6px 0px 0 6px;
        border: 1px solid #ddd;
    }

    .input-file input[type=file] {
        position: absolute;
        z-index: -1;
        opacity: 0;
        display: block;
        width: 0;
        height: 0;
    }

    /* Focus */
    .input-file input[type=file]:focus + .input-file-btn {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    /* Hover/Active */
    .input-file:hover .input-file-btn {
        background-color: #59be6e;
    }
    .input-file:active .input-file-btn {
        background-color: #2E703A;
    }

    /* Disabled */
    .input-file input[type=file]:disabled + .input-file-btn {
        background-color: #eee;
    }
</style>
