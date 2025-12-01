@props(['name', 'id', 'maxlength' => 255, 'minlength' => 5, 'value' => '', 'placeholder' => '',
    'pattern' => '[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,4}$',
    'title' => 'Enter a valid email address'])

@php
    $hasError = $errors->has($name);

    $baseClasses = 'border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500';
    $errorClasses = 'bg-red-50 border-red-500 text-red-900 placeholder-red-700';
    $defaultClasses = 'bg-gray-50 border-gray-300 text-gray-900';
@endphp

<input
    type="email"
    name="{{ $name }}"
    id="{{ $id }}"
    value="{{ old($name, $value) }}"
    maxlength="{{ $maxlength }}"
    minlength="{{ $minlength }}"
    placeholder="{{ $placeholder }}"
    pattern="{{ $pattern }}"
    title="{{ $title }}"
    {{ $attributes->class([
        $baseClasses,
        $errorClasses => $hasError,
        $defaultClasses => !$hasError
    ]) }}
>
