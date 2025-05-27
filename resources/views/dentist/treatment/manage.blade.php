<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="w-1/2 rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <h2 class="mb-4 text-2xl font-inter-bold text-gray-900 dark:text-white">Додати запис лікування до прийому №{{ $appointmentId }}</h2>
                    <form id="form-treatment" action="{{ route('dentist.treatments.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="appointment_id" value="{{ $appointmentId }}">
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <label for="diagnosis" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Діагноз</label>
                                <input type="text" name="diagnosis" id="diagnosis" class="@error('date') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="" minlength="3" maxlength="100">
                                @error('diagnosis')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="tooth_id" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Зуб</label>
                                <select id="tooth" name="tooth_id" class="@error('date') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($teeth as $tooth)
                                        <option value="{{ $tooth->id }}" {{ old('tooth_id') == $tooth->id ? 'selected' : '' }}>{{ $tooth->number }}</option>
                                    @endforeach
                                </select>
                                @error('tooth_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="w-full mt-4">
                            <label for="treatment_description" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Опис лікування</label>
                            <textarea id="treatment-description" name="treatment_description" rows="4" class="@error('date') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border block p-2.5 w-full text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="300">{{ old('treatment_description') }}</textarea>
                            @error('treatment_description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="font-inter-medium mt-6 inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Додати
                        </button>
                    </form>
                    <form class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto"
                          action="{{ route('dentist.generate_pdf_information_about_treatment', $appointmentId) }}" method="GET">
                        <button type="submit" class="font-inter-medium mt-6 inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Сформувати звіт
                        </button>
                    </form>
                </div>
            </div>


            <div id="treatments" class="mx-10 mt-8 mb-8">
                @foreach ($treatments as $treatment)
                    <div class="mb-4 w-4/5 max-w-md bg-white rounded-xl shadow overflow-hidden md:max-w-2xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <div class="md:flex">
                            <div class="px-8 pb-4 pt-8">
                                <div class="flex justify-between items-center w-96">
                                    <div class="uppercase tracking-wide text-sm text-blue-500 font-inter-semi-bold">Лікування зуба №{{ $treatment->tooth_number }}</div>
                                </div>
                                <p class="mt-2 text-gray-900 font-inter-regular">Діагноз: {{ $treatment->diagnosis }}</p>
                                <p class="mt-2 text-gray-900 font-inter-regular">Опис лікування: {{ $treatment->treatment_description }}</p>
                            </div>
                        </div>
                        <div class="px-8 pb-8 space-x-4 whitespace-nowrap flex">
                            <a href="{{ route('dentist.treatments.edit', $treatment->id) }}" class="px-4 py-2 border border-transparent text-sm font-inter-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Змінити
                            </a>
                            <form action="{{ route('dentist.treatments.destroy', $treatment->id) }}" method="POST" class="">
                                @csrf
                                @method('destroy')
                                <button type="submit" class="px-4 py-2 border border-transparent text-sm font-inter-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Видалити
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-treatment');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const form = event.target;
            sendFormTreatment(form);
        });

        function sendFormTreatment(form) {
            axios.post(form.action, new FormData(form))
                .then(response => {
                    // const toastElement = document.getElementById('toast-success');
                    // setTimeout(() => {
                    //     toastElement.classList.remove('opacity-0');
                    //     toastElement.classList.add('opacity-100');
                    //     setTimeout(() => {
                    //         toastElement.classList.remove('opacity-100');
                    //         toastElement.classList.add('opacity-0');
                    //         setTimeout(() => {
                    //             toastElement.remove();
                    //         }, 2000)
                    //     }, 5000)
                    // }, 500);
                    let treatmentsElement = document.getElementById('treatments');
                    treatmentsElement.innerHTML += `<div class="mb-4 w-4/5 max-w-md bg-white rounded-xl shadow overflow-hidden md:max-w-2xl m-3 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <div class="md:flex">
                                <div class="p-8">
                                    <div class="flex justify-between items-center w-96">
                                        <div class="uppercase tracking-wide text-sm text-blue-500 font-inter-semi-bold">Лікування зуба № ${response.data['tooth_number']}</div>
                                    </div>
                                    <p class="mt-2 text-gray-900 font-inter-regular">Діагноз: ${response.data['diagnosis']}</p>
                                    <p class="mt-2 text-gray-900 font-inter-regular">Опис лікування: ${response.data['treatment_description']}</p>
                                </div>
                            </div>
                        </div>`

                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>
