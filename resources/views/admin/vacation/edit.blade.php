@php
    $dentists = $dentists->mapWithKeys(function ($dentist) {
        return [
            $dentist->id => $dentist->name . ' ' . $dentist->surname . ' ' . $dentist->patronymic
        ];
    })->toArray();
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <x-admin-panel.h2>Редагування відпустки</x-admin-panel.h2>
                    <form action="{{ route('admin.vacations.update', $vacation->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div>
                                <x-form.label for="dentist_id">Стоматолог</x-form.label>
                                <x-form.select id="dentist_id" name="dentist_id" :options="$dentists" :value="$vacation->dentist_id" />
                                <x-form.input-error :messages="$errors->get('dentist_id')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="start">Початок</x-form.label>
                                <x-form.date-input name="start" id="start" :value="$vacation->start" required />
                                <x-form.input-error :messages="$errors->get('start')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="end">Кінець</x-form.label>
                                <x-form.date-input name="end" id="end" :value="$vacation->end" required />
                                <x-form.input-error :messages="$errors->get('end')" class="mt-2" />
                            </div>
                        </div>
                        <x-form.button>Змінити</x-form.button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
