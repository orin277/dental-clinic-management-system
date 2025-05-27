<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="w-2/5 rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <h2 class="mb-4 text-2xl font-inter-bold text-gray-900 dark:text-white">Додати рахунок до прийому №{{ $appointmentId }}</h2>
                    <form id="form-bill" action="{{ route('dentist.bills.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="appointment_id" value="{{ $appointmentId }}">
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <label for="amount" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Вартість</label>
                                <input type="number" name="amount" id="amount" value="{{ old('amount') }}" min="1" max="1000000" class="@error('amount') bg-red-50 border-red-500 text-red-900 placeholder-red-700 @else bg-gray-50 border-gray-300 text-gray-900 @enderror border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                                @error('amount')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="font-inter-medium mt-6 inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Додати
                        </button>
                    </form>
                    <form class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto"
                          action="{{ route('dentist.generate_pdf_information_about_bills', $appointmentId) }}" method="GET">
                        <button type="submit" class="font-inter-medium mt-6 inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Сформувати звіт
                        </button>
                    </form>
                </div>
            </div>


            <div id="bills" class="mx-10 mt-8 mb-8">
                @foreach ($bills as $bill)
                    <div class="mb-4 w-1/4 max-w-md bg-white rounded-xl shadow overflow-hidden md:max-w-2xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <div class="md:flex">
                            <div class="px-8 pb-4 pt-8">
                                <div class="flex justify-between items-center w-96">
                                    <div class="uppercase tracking-wide text-sm text-blue-500 font-inter-semi-bold">Рахунок №{{ $bill->id }}</div>
                                </div>
                                <p class="mt-2 text-gray-900 font-inter-regular">Вартість: {{ $bill->amount }}</p>
                                <p class="mt-2 text-gray-900 font-inter-regular">Дата: {{ date('d-m-Y', strtotime($bill->date)) }}</p>
                            </div>
                        </div>
                        <div class="px-8 pb-8 space-x-4 whitespace-nowrap flex">
                            <form action="{{ route('dentist.bills.destroy', $bill->id) }}" method="POST" class="">
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

    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-bill');

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
                    let treatmentsElement = document.getElementById('bills');
                    treatmentsElement.innerHTML += `<div class="mb-4 w-4/5 max-w-md bg-white rounded-xl shadow overflow-hidden md:max-w-2xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <div class="md:flex">
                            <div class="p-8">
                                <div class="flex justify-between items-center w-96">
                                    <div class="uppercase tracking-wide text-sm text-blue-500 font-inter-semi-bold">Рахунок № ${response.data['id']}</div>
                                </div>
                                <p class="mt-2 text-gray-900 font-inter-regular">Вартість: ${response.data['amount']}</p>
                                <p class="mt-2 text-gray-900 font-inter-regular">Дата: ${response.data['date']}</p>
                            </div>
                        </div>
                    </div>`
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>
