@php
    $dentists = $dentists->mapWithKeys(function ($dentist) {
        return [
            $dentist->id => $dentist->name . ' ' . $dentist->surname . ' ' . $dentist->patronymic
        ];
    })->toArray();
    $sex = [1 => 'Чоловік', 2 => 'Жінка'];
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <x-admin-panel.h2>Редагування освіти</x-admin-panel.h2>
                    <form action="{{ route("admin.educations.update", $education->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div>
                                <x-form.label for="dentist_id">Стоматолог</x-form.label>
                                <x-form.select id="dentist_id" name="dentist_id" :options="$dentists" :value="$education->id" />
                                <x-form.input-error :messages="$errors->get('dentist_id')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="name_of_institution">Назва закладу</x-form.label>
                                <x-form.text-input name="name_of_institution" id="name_of_institution" :value="$education->name_of_institution" minlength="3" maxlength="100" required />
                                <x-form.input-error :messages="$errors->get('name_of_institution')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="graduation_year">Рік випуску</x-form.label>
                                <x-form.number-input name="graduation_year" id="graduation_year" :value="$education->graduation_year" required />
                                <x-form.input-error :messages="$errors->get('graduation_year')" class="mt-2" />
                            </div>
                        </div>
                        <x-form.button>Змінити</x-form.button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
