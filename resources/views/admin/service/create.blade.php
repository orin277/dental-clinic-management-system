@php
    $typeOfServices = $typeOfServices->pluck('name', 'id')->toArray();
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <x-admin-panel.h2>Додавання послуги</x-admin-panel.h2>
                    <form action="{{ route('admin.services.store') }}" method="post">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div>
                                <x-form.label for="type_of_service_id">Тип послуги</x-form.label>
                                <x-form.select id="type_of_service_id" name="type_of_service_id" :options="$typeOfServices" />
                                <x-form.input-error :messages="$errors->get('type_of_service_id')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="name">Назва послуги</x-form.label>
                                <x-form.text-input name="name" id="name" minlength="5" maxlength="50" required />
                                <x-form.input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-form.label for="price">Ціна</x-form.label>
                                <x-form.number-input name="price" id="price" min="1" max="1000000" required />
                                <x-form.input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                        </div>
                        <x-form.button>Додати</x-form.button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
