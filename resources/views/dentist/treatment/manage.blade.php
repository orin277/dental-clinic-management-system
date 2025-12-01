@php
    $teeth = $teeth->pluck('number', 'id')->toArray();
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="w-1/2 rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <x-admin-panel.h2>Додати запис лікування до прийому №{{ $appointmentId }}</x-admin-panel.h2>
                    <form id="form-treatment" action="{{ route('dentist.treatments.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="appointment_id" value="{{ $appointmentId }}">
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <x-form.label for="diagnosis">Діагноз</x-form.label>
                                <x-form.text-input name="diagnosis" id="diagnosis" minlength="3" maxlength="100" required />
                                <x-form.input-error :messages="$errors->get('diagnosis')" class="mt-2" />
                            </div>
                            <div>
                                <x-form.label for="tooth_id">Зуб</x-form.label>
                                <x-form.select id="tooth_id" name="tooth_id" :options="$teeth" />
                                <x-form.input-error :messages="$errors->get('tooth_id')" class="mt-2" />
                            </div>

                        </div>
                        <div class="w-full mt-4">
                            <x-form.label for="treatment_description">Опис лікування</x-form.label>
                            <x-form.textarea id="treatment_description" name="treatment_description" rows="4" maxlength="300" minlength="1" required></x-form.textarea>
                            <x-form.input-error :messages="$errors->get('treatment_description')" class="mt-2" />
                        </div>
                        <x-form.button>Додати</x-form.button>
                    </form>
                    <form class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto"
                          action="{{ route('dentist.generate_pdf_information_about_treatment', $appointmentId) }}" method="GET">
                        <x-form.button>Сформувати звіт</x-form.button>
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
                            <x-primary-button-link :href="route('dentist.treatments.edit', $treatment->id)" class="rounded-md">
                                Змінити
                            </x-primary-button-link>
                            <form action="{{ route('dentist.treatments.destroy', $treatment->id) }}" method="POST" class="">
                                @csrf
                                @method('destroy')
                                <x-form.button>Видалити</x-form.button>
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
