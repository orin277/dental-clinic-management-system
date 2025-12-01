@php
    $appointmentStatuses = $appointmentStatuses->pluck('name', 'id')->toArray();
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
            <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
                <div class="w-2/4 rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <x-admin-panel.h2>Детальна інформація прийому №{{ $appointment->id }}</x-admin-panel.h2>
                        <form id="form-appointment" action="{{ route('dentist.appointments.update', $appointment->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                                <div class="grid gap-4 sm:grid-cols-4 sm:gap-6 mt-2">
                                    <div class="relative z-0">
                                        <input type="date" id="date" value="{{ $appointment->date }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                        <label for="disabled_standard" class="font-inter-medium absolute text-sm text-gray-900 dark:text-white duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Дата</label>
                                    </div>
                                    <div class="relative z-0">
                                        <input type="time" id="start_time" value="{{ substr($appointment->start_time, 0, 5) }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                        <label for="disabled_standard" class="font-inter-medium absolute text-sm text-gray-900 dark:text-white duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Початок</label>
                                    </div>
                                    <div class="relative z-0">
                                        <input type="time" id="end_time" value="{{ substr($appointment->end_time, 0, 5) }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                        <label for="disabled_standard" class="font-inter-medium absolute text-sm text-gray-900 dark:text-white duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Кінець</label>
                                    </div>
                                    <div class="relative z-0">
                                        <input type="number" id="cabinet" value="{{ $appointment->cabinet }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                        <label for="cabinet" class="font-inter-medium absolute text-sm text-gray-900 dark:text-white duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Кабінет</label>
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mt-2">
                                    <div class="relative z-0">
                                        <input type="text" id="dentist" value="{{ $appointment->dentist_surname . ' ' . $appointment->dentist_name . ' ' . $appointment->dentist_patronymic }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                        <label for="dentist" class="font-inter-medium absolute text-sm text-gray-900 dark:text-white duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Стоматолог</label>
                                    </div>
                                    <div class="relative z-0">
                                        <input type="text" id="patient" value="{{ $appointment->patient_surname . ' ' . $appointment->patient_name . ' ' . $appointment->patient_patronymic }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " disabled />
                                        <label for="patient" class="font-inter-medium absolute text-sm text-gray-900 dark:text-white duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Пацієнт</label>
                                    </div>
                                </div>

                                <div class="w-full">
                                    <label for="reason" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Причина звернення</label>
                                    <x-form.text-input name="reason" id="reason" :value="$appointment->reason" minlength="0" maxlength="300" required />
                                    <x-form.input-error :messages="$errors->get('reason')" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <label for="appointment_status_id" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Статус</label>
                                    <x-form.select id="appointment_status_id" name="appointment_status_id" :options="$appointmentStatuses" :value="$appointment->appointment_status_id" />
                                </div>
                            </div>
                            <x-form.button>Змінити</x-form.button>
                        </form>
                        <form class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto"
                              action="{{ route('dentist.generate_pdf_information_about_appointment', $appointment->id) }}" method="GET">
                            <x-form.button>Сформувати звіт</x-form.button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
