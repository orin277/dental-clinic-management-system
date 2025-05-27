@php
    use Illuminate\Support\Facades\Auth;

    if (Auth::user()) {
        if (Auth::user()->hasRole('admin')) {
            $role = 'admin';
        }
        else if (Auth::user()->hasRole('receptionist')) {
            $role = 'receptionist';
        }
        else if (Auth::user()->hasRole('dentist')) {
            $role = 'dentist';
        }
        else if (Auth::user()->hasRole('patient')) {
            $role = 'patient';
        }
    }

@endphp
<header>
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <x-application-logo class="max-h-20 max-w-24 mr-2 block w-auto fill-current text-gray-800" />
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                @if(Auth::check())
                    <div class="items-center justify-between md:flex w-auto " id="navbar-cta">
                        <div class="flex items-center ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-inter-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content" >
                                    <x-dropdown-link class="font-inter-medium" :href='route("{$role}.dashboard.index")'>
                                        {{ __('Особистий кабінет') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link class="font-inter-medium" :href="route('profile.edit')">
                                        {{ __('Профіль') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link class="font-inter-medium" :href="route('logout')"
                                                         onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                            {{ __('Вийти') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                @else
                <a href="{{ route('login') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Увійти</a>
                <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-cta" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
                @endif
            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="{{ route('home') }}" class="{{ Request::routeIs('home') ? 'text-blue-600' : 'text-gray-900 ' }} block py-2 px-3 md:p-0 bg-blue-700 rounded md:bg-transparent" aria-current="page">Головна</a>
                    </li>
                    <li>
                        <a href="{{ route('public.team.index') }}" class="{{ Request::routeIs('public.team.index') ? 'text-blue-600' : 'text-gray-900 ' }} block py-2 px-3 md:p-0 rounded hover:bg-gray-100 md:hover:bg-transparent dark:hover:bg-gray-700 md:dark:hover:bg-transparent dark:border-gray-700">Команда</a>
                    </li>
                    <li>
                        <a href="{{ route('public.services') }}" class="{{ Request::routeIs('public.services') ? 'text-blue-600' : 'text-gray-900 ' }} block py-2 px-3 md:p-0 rounded hover:bg-gray-100 md:hover:bg-transparent dark:hover:bg-gray-700 md:dark:hover:bg-transparent dark:border-gray-700">Послуги</a>
                    </li>
                    <li>
                        <a href="{{ route('public.about') }}" class="{{ Request::routeIs('public.about') ? 'text-blue-600' : 'text-gray-900 ' }} block py-2 px-3 md:p-0  rounded hover:bg-gray-100 md:hover:bg-transparent dark:hover:bg-gray-700 md:dark:hover:bg-transparent dark:border-gray-700">Про нас</a>
                    </li>
                    <li>
                        <a href="{{ route('public.contacts') }}" class="{{ Request::routeIs('public.contacts') ? 'text-blue-600' : 'text-gray-900 ' }} block py-2 px-3 md:p-0 rounded hover:bg-gray-100 md:hover:bg-transparent dark:hover:bg-gray-700 md:dark:hover:bg-transparent dark:border-gray-700">Контакти</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
