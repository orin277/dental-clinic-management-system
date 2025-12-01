@props(['name', 'id', 'maxlength' => 30, 'minlength' => 8, 'value' => '', 'placeholder' => '',
    'pattern' => '(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}',
    'title' => 'At least 8 characters, must include a number, uppercase and lowercase letters'])

@php
    $hasError = $errors->has($name);

    $baseClasses = 'border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500';
    $errorClasses = 'bg-red-50 border-red-500 text-red-900 placeholder-red-700';
    $defaultClasses = 'bg-gray-50 border-gray-300 text-gray-900';
@endphp

<input
    type="password"
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
