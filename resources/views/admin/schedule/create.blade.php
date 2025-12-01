@php
    $dentists = $dentists->mapWithKeys(function ($dentist) {
        return [
            $dentist->id => $dentist->name . ' ' . $dentist->surname . ' ' . $dentist->patronymic
        ];
    })->toArray();
    $dayOfWeeks = $dayOfWeeks->pluck('name', 'id')->toArray();
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <x-admin-panel.h2>Додавання графіку</x-admin-panel.h2>
                    <form action="{{ route('admin.schedules.store') }}" method="post">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div>
                                <x-form.label for="dentist_id">Стоматолог</x-form.label>
                                <x-form.select id="dentist_id" name="dentist_id" :options="$dentists" />
                                <x-form.input-error :messages="$errors->get('dentist_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-form.label for="day_of_week_id">День тижня</x-form.label>
                                <x-form.select id="day_of_week_id" name="day_of_week_id" :options="$dayOfWeeks" />
                                <x-form.input-error :messages="$errors->get('day_of_week_id')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="start_time">Початок</x-form.label>
                                <x-form.time-input name="start_time" id="start_time" required />
                                <x-form.input-error :messages="$errors->get('start_time')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="end_time">Кінець</x-form.label>
                                <x-form.time-input name="end_time" id="end_time" required />
                                <x-form.input-error :messages="$errors->get('end_time')" class="mt-2" />
                            </div>
                        </div>
                        <x-form.button>Додати</x-form.button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
