@php
    use Illuminate\Support\Facades\Auth;

    if (Auth::user()->hasRole('admin')) {
        $role = 'admin';
    }
    else {
        $role = 'receptionist';
    }
@endphp
<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">

            <div class="rounded-t-lg shadow p-6 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 mx-10 mt-8">
                <div class="w-full mb-1">
                    <div class="mb-4">
                        <h1 class="text-2xl font-inter-bold text-gray-900 sm:text-2xl dark:text-white">Пацієнти</h1>
                    </div>
                    <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <form class="sm:pr-3 flex items-center w-full space-x-3 md:w-auto" action="{{ route("{$role}.patients.index") }}" method="GET">
                                <div>
                                    <label for="search" class="sr-only">Пошук</label>
                                    <input type="text" name="filter[search]" id="input-search"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Пошук"
                                           value="{{ request('filter') ? request('filter')['search'] : '' }}">
                                </div>
                                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="sr-only">Пошук</span>
                                </button>
                            </form>
                        </div>
                        <a href="{{ route("{$role}.patients.create") }}" id="createButton" class="font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="drawer-create-product-default" data-drawer-show="drawer-create-product-default" aria-controls="drawer-create-product-default" data-drawer-placement="right">
                            Додати
                        </a>
                    </div>
                </div>
            </div>
            <div class="rounded-b-lg shadow relative h-full overflow-y-auto bg-gray-50 dark:bg-gray-900 mx-10 mb-8">
                <div class="flex flex-col">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-blue-700 text-left text-xs font-inter-medium uppercase tracking-widest text-white">
                        <tr>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                ПІБ
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Номер телефону
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Дата народження
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                                Стать
                            </th>
                            <th scope="col" class="px-6 py-5 text-xs text-left uppercase dark:text-gray-400">
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach ($patients as $patient)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $patient->name . ' ' . $patient->surname . ' ' . $patient->patronymic }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $patient->email }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $patient->phone }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ date('d-m-Y', strtotime($patient->date_of_birth)) }}</td>
                                <td class="px-6 py-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $patient->sex === 1 ? 'Ч' : 'Ж' }}</td>
                                <td class="px-6 py-4 space-x-2 whitespace-nowrap">
                                    <a href="{{ route("{$role}.patients.edit", ['patient' => $patient->id]) }}" class="font-inter-medium inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                    </a>

                                    <form action="{{ route("{$role}.patients.destroy", $patient->id) }}" method="post" class="inline-flex ">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" id="deleteButton" class="font-inter-medium inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-full hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="p-4">
                        {{ $patients->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>
    @if (session('error'))
        <div id="toast-danger" class="opacity-100 transition-opacity ease-in duration-700 fixed top-1/4 left-1/2 flex items-center w-full max-w-sm p-4 mb-4 text-gray-500 bg-white rounded-lg border shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-m font-inter-medium">{{ session('error') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        setTimeout(() => {
            const errorMessage = document.getElementById('toast-danger');
            if (errorMessage) {
                errorMessage.style.transition = 'opacity 1s';
                errorMessage.style.opacity = '0';
                setTimeout(() => errorMessage.remove(), 1000);
            }
        }, 5000);
    });
</script>

