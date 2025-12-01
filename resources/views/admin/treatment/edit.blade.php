@php
    $teeth = $teeth->pluck('number', 'id')->toArray();
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <x-admin-panel.h2>Редагування запису лікування</x-admin-panel.h2>
                    <form action="{{ route('admin.treatments.update', $treatment->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <x-form.label for="appointment_id">Номер прийому</x-form.label>
                                <x-form.number-input name="appointment_id" id="appointment_id" :value="$treatment->appointment_id" required />
                                <x-form.input-error :messages="$errors->get('appointment_id')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="diagnosis">Діагноз</x-form.label>
                                <x-form.text-input name="diagnosis" id="diagnosis" :value="$treatment->diagnosis" minlength="3" maxlength="100" required />
                                <x-form.input-error :messages="$errors->get('diagnosis')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="treatment_description">Опис лікування</x-form.label>
                                <x-form.text-input name="treatment_description" id="treatment_description" :value="$treatment->treatment_description" minlength="1" maxlength="300" required />
                                <x-form.input-error :messages="$errors->get('treatment_description')" class="mt-2" />
                            </div>
                            <div>
                                <x-form.label for="tooth_id">Зуб</x-form.label>
                                <x-form.select id="tooth_id" name="tooth_id" :options="$teeth" :value="$treatment->tooth_id" />
                                <x-form.input-error :messages="$errors->get('tooth_id')" class="mt-2" />
                            </div>
                        </div>
                        <x-form.button>Змінити</x-form.button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
