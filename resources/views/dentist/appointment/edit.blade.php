<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
            <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
                <div class="w-2/4 rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <h2 class="mb-6 text-2xl font-inter-bold text-gray-900 dark:text-white">Детальна інформація прийому №{{ $appointment->id }}</h2>
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
                                    <input type="text" name="reason" id="reason" value="{{ old('reason') ?? $appointment->reason }}" class="@error('reason') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" maxlength="300">
                                    @error('reason')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="appointment_status_id" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Статус</label>
                                    <select id="appointment_status_id" name="appointment_status_id" class="@error('appointment_status_id') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        @foreach ($appointmentStatuses as $appointmentStatus)
                                            <option {{ $appointment->appointment_status_id === $appointmentStatus->id ? ' selected' : '' }} value="{{ $appointmentStatus->id }}">{{ $appointmentStatus->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="font-inter-medium mt-6 inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Змінити
                            </button>
                        </form>
                        <form class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto"
                              action="{{ route('dentist.generate_pdf_information_about_appointment', $appointment->id) }}" method="GET">
                            <button type="submit" class="font-inter-medium mt-6 inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Сформувати звіт
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
