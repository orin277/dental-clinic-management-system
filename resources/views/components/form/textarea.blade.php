@props(['name', 'id', 'maxlength' => 100, 'minlength' => 0, 'value' => '', 'placeholder' => '', 'rows' => 2, 'cols' => 20])

@php
    $hasError = $errors->has($name);

    $baseClasses = 'border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500';
    $errorClasses = 'bg-red-50 border-red-500 text-red-900 placeholder-red-700';
    $defaultClasses = 'bg-gray-50 border-gray-300 text-gray-900';
@endphp

<textarea
    name="{{ $name }}"
    id="{{ $id }}"
    maxlength="{{ $maxlength }}"
    minlength="{{ $minlength }}"
    placeholder="{{ $placeholder }}"
    rows="{{ $rows }}"
    {{ $attributes->class([
        $baseClasses,
        $errorClasses => $hasError,
        $defaultClasses => !$hasError
    ]) }}
>
    {{ old($name, $value) }}
</textarea>
