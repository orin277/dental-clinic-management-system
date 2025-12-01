@props(['name', 'id', 'max' => 999999999999, 'min' => 0, 'value' => ''])

@php
    $hasError = $errors->has($name);

    $baseClasses = 'border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500';
    $errorClasses = 'bg-red-50 border-red-500 text-red-900 placeholder-red-700';
    $defaultClasses = 'bg-gray-50 border-gray-300 text-gray-900';
@endphp

<input
    type="number"
    name="{{ $name }}"
    id="{{ $id }}"
    value="{{ old($name, $value) }}"
    max="{{ $max }}"
    min="{{ $min }}"
    {{ $attributes->class([
        $baseClasses,
        $errorClasses => $hasError,
        $defaultClasses => !$hasError
    ]) }}
>
