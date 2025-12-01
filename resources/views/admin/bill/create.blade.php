@php
    use Illuminate\Support\Facades\Auth;

    if (Auth::user()->hasRole('admin')) {
        $role = 'admin';
    }
    else {
        $role = 'receptionist';
    }
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <x-admin-panel.h2>Додавання рахунку</x-admin-panel.h2>
                    <form action="{{ route("{$role}.bills.store") }}" method="post">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <x-form.label for="appointment_id">Номер прийому</x-form.label>
                                <x-form.number-input name="appointment_id" id="appointment_id" required />
                                <x-form.input-error :messages="$errors->get('appointment_id')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="amount">Сума</x-form.label>
                                <x-form.number-input name="amount" id="amount" min="1" max="1000000" required />
                                <x-form.input-error :messages="$errors->get('amount')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="date">Дата</x-form.label>
                                <x-form.date-input name="date" id="date" required />
                                <x-form.input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>
                        </div>
                        <x-form.button>Додати</x-form.button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
