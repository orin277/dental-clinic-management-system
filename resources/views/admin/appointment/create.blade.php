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
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200 ">
                <div class="flex flex-col">
                    <h2 class="mb-4 text-2xl font-inter-bold text-gray-900 dark:text-white">Додавання прийому</h2>
                    <form action="{{ route("{$role}.appointments.store") }}" method="post">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <label for="date" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Дата</label>
                                <input type="date" name="date" id="date" value="{{ old('date') }}" class="@error('date') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                                @error('date')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="start_time" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Початок</label>
                                <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" class="@error('start_time') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                                @error('start_time')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="end_time" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Кінець</label>
                                <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" class="@error('end_time') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                                @error('end_time')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="dentist_id" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Стоматолог</label>
                                <select id="dentist" name="dentist_id" class="@error('dentist_id') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($dentists as $dentist)
                                        <option value="{{ $dentist->id }}" {{ old('dentist_id') == $dentist->id ? 'selected' : '' }}>{{ $dentist->name . ' ' . $dentist->surname . ' ' . $dentist->patronymic }}</option>
                                    @endforeach
                                </select>
                                @error('dentist_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="patient_id" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Пацієнт</label>
                                <select id="patient" name="patient_id" class="@error('patient_id') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->name . ' ' . $patient->surname . ' ' . $patient->patronymic }}</option>
                                    @endforeach
                                </select>
                                @error('patient_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="cabinet" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Кабінет</label>
                                <input type="number" name="cabinet" id="cabinet" value="{{ old('cabinet') }}" class="@error('cabinet') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                                @error('cabinet')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="reason" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Причина звернення</label>
                                <input type="text" name="reason" id="reason" value="{{ old('reason') }}" class="@error('reason') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" maxlength="300">
                                @error('reason')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="appointment_status_id" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Статус</label>
                                <select id="appointment_status_id" name="appointment_status_id" class="@error('appointment_status_id') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($appointmentStatuses as $appointmentStatus)
                                        <option value="{{ $appointmentStatus->id }}" {{ old('appointment_status_id') == $appointmentStatus->id ? 'selected' : '' }}>{{ $appointmentStatus->name }}</option>
                                    @endforeach
                                </select>
                                @error('appointment_status_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="font-inter-medium mt-6 inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Додати
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
