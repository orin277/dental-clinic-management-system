<x-guest-layout>
    <section class="">
        <div class="flex flex-col lg:flex-row justify-between space-x-20">
            <div class="text-center lg:text-left mt-40">
                <h1 class="font-inter-bold text-gray-900 text-3xl md:text-6xl leading-normal mb-6">
                    Якісна стоматологія за доступними цінами
                </h1>

                <p class="font-light text-gray-600 text-md md:text-lg leading-normal mb-12">
                    Увійдіть на сайт щоб записатися на прийом
                    <br>
                    або зателефонуйте на наш номер телефону
                </p>

                <a href="{{ route('login') }}" class="px-8 py-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-inter-medium rounded-lg text-xl text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Увійти
                </a>
            </div>

            <div class="mt-24 w-11/12 h-11/12">
                <img src="{{ asset('img/home2.svg') }}" alt="Image" class="h-auto max-w-full">
            </div>
        </div>
    </section>

    <section class="pt-10">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-8 lg:mb-16 text-center mx-auto">
                <h2 class="mb-4 text-4xl tracking-tight font-inter-extra-bold text-gray-900 dark:text-white">Наші переваги</h2>
{{--                <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>--}}
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div class="text-center">
                    <div class="mx-auto flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-200 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-blue-700 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Досвід роботи та репутація</h3>
                    <p class="text-gray-500 dark:text-gray-400">Більше 20-ти років роботи клініки. У нашому колективі є лікарі, які отримали професійну освіту за кордоном.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-200 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-blue-700 lg:w-6 lg:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.6 3h.8l7 2.7c.3.2.6.6.6 1a17.7 17.7 0 0 1-7.4 14.1 1 1 0 0 1-1.2 0A17.4 17.4 0 0 1 4 6.7c0-.4.3-.8.6-1l7-2.6Zm4 7.3a1 1 0 0 0-1.3-1.6l-3.3 3-.8-1a1 1 0 0 0-1.4 1.5l1.5 1.5c.4.4 1 .4 1.4 0l4-3.4Z" clip-rule="evenodd"/>
                        </svg>

                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Безпека</h3>
                    <p class="text-gray-500 dark:text-gray-400">Весь інструментарій піддається багатоступеневою стерилізації. Кабінети і апаратура знезаражуються засобами після кожного прийому.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-200 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-blue-700 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Доступні Ціни</h3>
                    <p class="text-gray-500 dark:text-gray-400">Цінова політика нашої клініки: стабільність, доступність та лояльність. Можливість корегування вартості лікування в залежності від запланованих втручань.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-200 lg:h-12 lg:w-12">
{{--                        <svg class="w-5 h-5 text-blue-700 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path></svg>--}}
                        <svg class="w-5 h-5 text-blue-700 lg:w-7 lg:h-7" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" fill="#1A56DB"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;} </style> <g> <path d="M6,19c0.6,0,1-0.4,1-1V8h18v10c0,0.6,0.4,1,1,1s1-0.4,1-1V7c0-0.6-0.4-1-1-1H6C5.4,6,5,6.4,5,7v11C5,18.6,5.4,19,6,19z"></path> <path d="M29.9,24.6l-2-4C27.7,20.2,27.4,20,27,20H5c-0.4,0-0.7,0.2-0.9,0.6l-2,4c-0.2,0.3-0.1,0.7,0,1S2.7,26,3,26h26 c0.3,0,0.7-0.2,0.9-0.5S30,24.9,29.9,24.6z"></path> <path d="M16,18c0.6,0,1-0.4,1-1v-2h2c0.6,0,1-0.4,1-1s-0.4-1-1-1h-2v-2c0-0.6-0.4-1-1-1s-1,0.4-1,1v2h-2c-0.6,0-1,0.4-1,1 s0.4,1,1,1h2v2C15,17.6,15.4,18,16,18z"></path> </g> </g></svg>                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Зручність сервісу</h3>
                    <p class="text-gray-500 dark:text-gray-400">Ви завжди можете записатися на прийом до лікаря на сайті, або по телефону в робочий час з 8:00 до 21:00</p>
                </div>

                <div class="text-center">
                    <div class="mx-auto flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-200 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-blue-700 lg:w-7 lg:h-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.1299 13.8H11.5C11.7357 13.8 11.8536 13.8 11.9268 13.8732C12 13.9464 12 14.0643 12 14.3V18.7299C12 19.6205 12 20.0659 12.1962 20.1091C12.3925 20.1523 12.5795 19.7482 12.9537 18.9399L15.6851 13.0402C16.2768 11.7621 16.5726 11.1231 16.2777 10.6615C15.9828 10.2 15.2786 10.2 13.8701 10.2H12.5C12.2643 10.2 12.1464 10.2 12.0732 10.1268C12 10.0536 12 9.9357 12 9.7V5.27013C12 4.37946 12 3.93413 11.8038 3.89091C11.6075 3.8477 11.4205 4.25182 11.0463 5.06006L8.31493 10.9597C7.72321 12.2379 7.42735 12.8769 7.72228 13.3385C8.01721 13.8 8.72143 13.8 10.1299 13.8Z" fill="#1A56DB"></path> </g></svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Сучасні методи </h3>
                    <p class="text-gray-500 dark:text-gray-400">Діагностика, лікування, профілактика у всіх областях стоматології і при порушеннях опорно-рухового апарату.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-200 lg:h-12 lg:w-12">
                        <svg class="w-5 h-5 text-blue-700 lg:w-6 lg:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 2a3 3 0 0 0-2.1.9l-.9.9a1 1 0 0 1-.7.3H7a3 3 0 0 0-3 3v1.2c0 .3 0 .5-.2.7l-1 .9a3 3 0 0 0 0 4.2l1 .9c.2.2.3.4.3.7V17a3 3 0 0 0 3 3h1.2c.3 0 .5 0 .7.2l.9 1a3 3 0 0 0 4.2 0l.9-1c.2-.2.4-.3.7-.3H17a3 3 0 0 0 3-3v-1.2c0-.3 0-.5.2-.7l1-.9a3 3 0 0 0 0-4.2l-1-.9a1 1 0 0 1-.3-.7V7a3 3 0 0 0-3-3h-1.2a1 1 0 0 1-.7-.2l-.9-1A3 3 0 0 0 12 2Zm3.7 7.7a1 1 0 1 0-1.4-1.4L10 12.6l-1.3-1.3a1 1 0 0 0-1.4 1.4l2 2c.4.4 1 .4 1.4 0l5-5Z" clip-rule="evenodd"/>
                        </svg>
                    </div>

                    <h3 class="mb-2 text-xl font-bold dark:text-white">Гарантія</h3>
                    <p class="text-gray-500 dark:text-gray-400">Наша клініка надає послуги тільки високої якості. «Надійність понад усе» - девіз нашого підприємства з моменту заснування.</p>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
