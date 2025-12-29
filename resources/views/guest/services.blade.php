<x-guest-layout>
    <div class="mt-6 mb-8">
        <h1 class="text-5xl font-inter-bold text-black">Послуги</h1>
    </div>
    <div id="accordion-color" data-accordion="collapse" data-inactive-classes="bg-white text-gray-500" data-active-classes="bg-blue-600 dark:bg-gray-800 text-white dark:text-white">
        @php($count = 1)
        @foreach($typeOfServices as $typeOfService)
        <h2 id="accordion-color-heading-{{ $count++ }}">
            <button type="button" class="flex items-center justify-between w-full p-5 font-inter-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:text-white hover:bg-blue-600 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-color-body-{{ $count }}" aria-expanded="true" aria-controls="accordion-color-body-{{ $count }}">
                <span>{{ $typeOfService->name }}</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="accordion-color-body-{{ $count }}" class="hidden bg-white" aria-labelledby="accordion-color-heading-{{ $count }}">
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                @foreach($typeOfService->services as $service)
                    <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $service->name . ' від ' . $service->price . ' грн' }}</p>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

</x-guest-layout>
