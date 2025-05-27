<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="px-14 py-8 relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="flex flex-col">
                <h2 class="mb-4 text-2xl font-inter-bold text-gray-900 dark:text-white">Детальна інформація прийому</h2>

                <div class="w-4/5 max-w-md bg-white rounded-lg shadow overflow-hidden md:max-w-2xl mb-3 mt-3 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div class="md:flex">
                        <div class="p-8">
                            <div class="flex justify-between items-center w-96">
                                <div class="uppercase tracking-wide text-sm text-blue-500 font-inter-semi-bold">Інформація про прийом</div>
                            </div>
                            <p class="mt-2 text-gray-900 font-inter-regular">Пацієнт: {{ $appointment->patient_surname . ' ' . $appointment->patient_name . ' ' . $appointment->patient_patronymic }}</p>
                            <p class="mt-2 text-gray-900 font-inter-regular">{{ $appointment->dentist_specialization_name . ': ' . $appointment->dentist_surname . ' ' . $appointment->dentist_name . ' ' . $appointment->dentist_patronymic }}</p>
                            <p class="mt-2 text-gray-900 font-inter-regular">Дата: {{ $appointment->date }}</p>
                            <p class="mt-2 text-gray-900 font-inter-regular">Час: {{ substr($appointment->start_time, 0, 5) . ' - ' . substr($appointment->end_time, 0, 5) }}</p>
                            <p class="mt-2 text-gray-900 font-inter-regular">Кабінет: {{ $appointment->cabinet }}</p>
                        </div>
                    </div>
                </div>
                @foreach ($treatments as $treatment)
                <div class="w-4/5 max-w-md bg-white rounded-lg shadow overflow-hidden md:max-w-2xl mb-3 mt-3 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div class="md:flex">
                        <div class="p-8">
                            <div class="flex justify-between items-center w-96">
                                <div class="uppercase tracking-wide text-sm text-blue-500 font-inter-semi-bold">Лікування зуба №{{ $treatment->tooth_number }}</div>
                            </div>
                            <p class="mt-2 text-gray-900 font-inter-regular">Діагноз: {{ $treatment->diagnosis }}</p>
                            <p class="mt-2 text-gray-900 font-inter-regular">Опис лікування: {{ $treatment->treatment_description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>

    </div>
</x-app-layout>
