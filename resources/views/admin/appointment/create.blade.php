@php
    use Illuminate\Support\Facades\Auth;

    if (Auth::user()->hasRole('admin')) {
        $role = 'admin';
    }
    else {
        $role = 'receptionist';
    }

    $appointmentStatuses = $appointmentStatuses->pluck('name', 'id')->toArray();
    $patients = $patients->mapWithKeys(function ($patient) {
        return [
            $patient->id => $patient->name . ' ' . $patient->surname . ' ' . $patient->patronymic
        ];
    })->toArray();
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
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200 ">
                <div class="flex flex-col">
                    <x-admin-panel.h2>Додавання прийому</x-admin-panel.h2>
                    <form action="{{ route("{$role}.appointments.store") }}" method="post">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <x-form.label for="date">Дата</x-form.label>
                                <x-form.date-input name="date" id="date" required />
                                <x-form.input-error :messages="$errors->get('date')" class="mt-2" />
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
                            <div>
                                <x-form.label for="dentist_id">Стоматолог</x-form.label>
                                <x-form.select id="dentist_id" name="dentist_id" :options="$dentists" />
                                <x-form.input-error :messages="$errors->get('dentist_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-form.label for="patient_id">Пацієнт</x-form.label>
                                <x-form.select id="patient_id" name="patient_id" :options="$patients" />
                                <x-form.input-error :messages="$errors->get('patient_id')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="cabinet">Кабінет</x-form.label>
                                <x-form.number-input name="cabinet" id="cabinet" required />
                                <x-form.input-error :messages="$errors->get('cabinet')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="reason">Причина звернення</x-form.label>
                                <x-form.text-input name="reason" id="reason" minlength="1" maxlength="300" required />
                                <x-form.input-error :messages="$errors->get('reason')" class="mt-2" />
                            </div>
                            <div>
                                <x-form.label for="appointment_status_id">Статус</x-form.label>
                                <x-form.select id="appointment_status_id" name="appointment_status_id" :options="$appointmentStatuses" />
                                <x-form.input-error :messages="$errors->get('appointment_status_id')" class="mt-2" />
                            </div>
                        </div>
                        <x-form.button>Додати</x-form.button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
