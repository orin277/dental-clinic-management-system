<x-app-layout>
    <div class="flex overflow-hidden dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto lg:ml-64 dark:bg-gray-900">
            <div class="rounded-lg shadow p-6 mx-10 my-8 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <x-admin-panel.h1>Платежі</x-admin-panel.h1>
                    </div>
                    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form class="sm:pr-3" action="{{ route("patient.payments.index") }}" method="GET">
                                <div class="flex items-center w-full space-x-3 md:w-auto">
                                    <label class="">Від</label>
                                    <x-form.date-input
                                        name="filter[from]"
                                        id="from-filter"
                                        :value="request('filter') ? request('filter')['from'] : ''"
                                        placeholder="Від"
                                        required>
                                    </x-form.date-input>
                                    <label class="">До</label>
                                    <x-form.date-input
                                        name="filter[to]"
                                        id="to-filter"
                                        :value="request('filter') ? request('filter')['to'] : ''"
                                        placeholder="До"
                                        required>
                                    </x-form.date-input>
                                    <x-form.search-button>Пошук</x-form.search-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900">
                <div class="flex flex-col">
                    @foreach($payments as $payment)
                        <div class="max-w-md mx-auto bg-white rounded-xl shadow overflow-hidden md:max-w-2xl m-3 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <div class="md:flex">
                                <div class="p-8">
                                    <div class="flex justify-between items-center w-96">
                                        <div class="uppercase tracking-wide text-sm text-blue-500 font-inter-semi-bold">
                                            Платіж №{{ $payment->id }}</div>
                                    </div>

                                    <p class="mt-2 text-gray-500 font-inter-regular">Номер рахунку: {{ $payment->bill_id }}</p>
                                    <p class="mt-2 text-gray-500 font-inter-regular">Вартість: {{ $payment->amount }}</p>
                                    <p class="mt-2 text-gray-500 font-inter-regular">Дата: {{ date('d-m-Y', strtotime($payment->date)) }}</p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                        <div class="p-4">
                            {{ $payments->withQueryString()->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
