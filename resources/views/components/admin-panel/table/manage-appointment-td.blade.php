@props(['edit_href', 'manage_treatment', 'manage_bills'])

<td {{ $attributes->merge(['class' => 'p-4 space-x-2 whitespace-nowrap flex']) }}>
    <x-admin-panel.edit-link :href="$edit_href"></x-admin-panel.edit-link>
    <a href="{{ $manage_treatment }}" type="button" class="font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        Керувати лікуванням
    </a>
    <a href="{{ $manage_bills }}" type="button" class="font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        Керувати рахунками
    </a>
</td>
