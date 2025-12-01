<a href="{{ $href }}" {{ $attributes->merge(['class' => 'px-4 py-2 text-sm font-inter-medium rounded-md text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800']) }}>
    {{ $slot }}
</a>
