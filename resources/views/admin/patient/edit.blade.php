@php
    use Illuminate\Support\Facades\Auth;

    if (Auth::user()->hasRole('admin')) {
        $role = 'admin';
    }
    else {
        $role = 'receptionist';
    }

    $sex = [1 => 'Чоловік', 2 => 'Жінка'];
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <x-admin-panel.h2>Редагування пацієнта</x-admin-panel.h2>
                    <form action="{{ route("{$role}.patients.update", $patient->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <x-form.label for="name">Ім'я</x-form.label>
                                <x-form.text-input name="name" id="name" :value="$patient->name" minlength="1" maxlength="30" required />
                                <x-form.input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="surname">Прізвище</x-form.label>
                                <x-form.text-input name="surname" id="surname" :value="$patient->surname" minlength="1" maxlength="40" required />
                                <x-form.input-error :messages="$errors->get('surname')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="patronymic">По батькові</x-form.label>
                                <x-form.text-input name="patronymic" id="patronymic" :value="$patient->patronymic" minlength="1" maxlength="30" required />
                                <x-form.input-error :messages="$errors->get('patronymic')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="date_of_birth">Дата народження</x-form.label>
                                <x-form.date-input name="date_of_birth" id="date_of_birth" :value="$patient->date_of_birth" required />
                                <x-form.input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="sex">Стать</x-form.label>
                                <x-form.select id="sex" name="sex" :options="$sex" :value="$patient->sex" />
                                <x-form.input-error :messages="$errors->get('sex')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="phone">Номер телефону</x-form.label>
                                <x-form.tel-input name="phone" id="phone" :value="$patient->phone" required />
                                <x-form.input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="email">Email</x-form.label>
                                <x-form.email-input name="email" id="email" :value="$patient->email" required />
                                <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="address">Адреса</x-form.label>
                                <x-form.text-input name="address" id="address" :value="$patient->address" minlength="0" maxlength="100" />
                                <x-form.input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="allergies">Алергії</x-form.label>
                                <x-form.text-input name="allergies" id="allergies" :value="$patient->allergies" minlength="0" maxlength="100" />
                                <x-form.input-error :messages="$errors->get('allergies')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="password">Пароль</x-form.label>
                                <x-form.password-input name="password" id="password" :value="$patient->password" required />
                                <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>
                        <x-form.button>Змінити</x-form.button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
