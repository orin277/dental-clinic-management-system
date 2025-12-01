<a href="{{ $href }}" {{ $attributes->merge(['class' => 'font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800', 'data-drawer-target' => 'drawer-create-product-default', 'data-drawer-show' => 'drawer-create-product-default', 'aria-controls' => 'drawer-create-product-default', 'data-drawer-placement' => 'right']) }}>
    {{ $slot }}
</a>
