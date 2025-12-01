@props(['name', 'id', 'value' => '', 'options' => [], 'first_item' => null])

@php
    $hasError = $errors->has($name);

    $baseClasses = 'border text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500';
    $errorClasses = 'bg-red-50 border-red-500 text-red-900 placeholder-red-700';
    $defaultClasses = 'bg-gray-50 border-gray-300 text-gray-900';

    $selectedValue = old($name, $value);
@endphp

<select
    name="{{ $name }}"
    id="{{ $id }}"
    {{ $attributes->class([
        $baseClasses,
        $errorClasses => $hasError,
        $defaultClasses => !$hasError
    ]) }}
>
    @if(isset($first_item))
        <option value="">{{ $first_item }}</option>
    @endif
    @foreach ($options as $key => $label)
        <option value="{{ $key }}" @selected($key == $selectedValue)>
            {{ $label }}
        </option>
    @endforeach
</select>
