<x-guest-layout>
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Зареєструйтеся
            </h2>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ім'я</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                </div>
                <div>
                    <label for="surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Прізвище</label>
                    <input type="text" name="surname" id="surname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                </div>
                <div>
                    <label for="patronymic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">По батькові</label>
                    <input type="text" name="patronymic" id="patronymic" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                </div>
                <div>
                    <label for="date_of_birth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дата народження</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Номер телефону</label>
                    <input type="tel" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@company.com" required="">
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пароль</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Підтвердити пароль</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required="">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-900 dark:text-white">Я приймаю <a href="#" class="text-primary-700 hover:underline dark:text-primary-500">Загальні положення та умови</a></label>
                    </div>
                </div>
                <button type="submit" class="px-6 py-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Зареєструватися</button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Вже зареєстровані? <a href="{{ route('sign-in') }}" class="text-primary-700 hover:underline dark:text-primary-500">Увійдіть</a>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
