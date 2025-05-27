<x-app-layout>
    <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full h-full overflow-y-auto dark:bg-gray-900 lg:ml-64">
            <div class="rounded-lg shadow mx-10 mt-8 px-14 py-8 bg-white border-b border-gray-200">
                <div class="flex flex-col">
                    <h2 class="mb-4 text-2xl font-inter-bold text-gray-900 dark:text-white">Запис на прийом</h2>
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div>
                            <label for="dentist_id" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Cтоматолог</label>
                            <select id="dentist" name="dentist_id" class="w-11/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($dentists as $dentist)
                                    <option value="{{ $dentist->id }}"
                                            data-cabinet="{{ $dentist->cabinet }}" {{ old('dentist_id') == $dentist->id ? 'selected' : '' }}
                                    >{{ $dentist->name . ' ' . $dentist->surname . ' ' . $dentist->patronymic . ' (' . $dentist->dentist_specializations_name . ')' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full">
                            <label for="date" class="block mb-2 text-sm font-inter-medium text-gray-900 dark:text-white">Дата</label>
                            <input type="date" name="date" id="date" value="{{ old('date',date('Y-m-d', time())) }}" class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-2 flex flex-col">
                    <h2 class="text-xl font-inter-bold text-gray-900 dark:text-white">Оберіть час</h2>
                    <div id="schedule" class="grid grid-cols-5 gap-2 lg:max-w-xl">

                    </div>
                </div>
            </div>

        </div>

    </div>
    <div id="confirmation-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-100 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Ваш запис на прийом
                    </h3>
                    <button id="close-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form class="p-8">
                    <div class="grid gap-4 mb-4 grid-cols-1">
                        <div class="relative z-0">
                            <input value="" type="text" id="modal-dentist" disabled class="block pt-4 pb-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600" />
                            <label for="modal-dentist" class="absolute sm:text-xl text-gray-500 dark:text-gray-400 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Стоматолог</label>
                        </div>
                        <div class="relative z-0">
                            <input value="" type="text" id="modal-date" disabled class="block pt-4 pb-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600" />
                            <label for="modal-date" class="absolute sm:text-xl text-gray-500 dark:text-gray-400 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Дата</label>
                        </div>
                        <div class="relative z-0">
                            <input value="" type="text" id="modal-time" disabled class="block pt-4 pb-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600" />
                            <label for="modal-time" class="absolute sm:text-xl text-gray-500 dark:text-gray-400 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Час</label>
                        </div>
                        <div class="relative z-0">
                            <input value="" type="text" id="modal-cabinet" disabled class="block pt-4 pb-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600" />
                            <label for="modal-cabinet" class="absolute sm:text-xl text-gray-500 dark:text-gray-400 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Кабінет</label>
                        </div>
                    </div>
                    <button id="confirm-button" type="submit" class="mt-1 text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-inter-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Записатись
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="toast-success" class="opacity-0 transition-opacity ease-in duration-700 fixed top-10 left-1/2 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">Запис успішно створено!</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
</x-app-layout>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentDate = new Date();

        let minDate = currentDate.toISOString().split('T')[0];
        document.getElementById("date").min = minDate;

        let maxDate = new Date(currentDate);
        maxDate.setDate(currentDate.getDate() + 30);
        maxDate = maxDate.toISOString().split('T')[0];
        document.getElementById("date").max = maxDate;

        document.getElementById('dentist').addEventListener('change', loadSchedule);
        document.getElementById('date').addEventListener('change', loadSchedule);

        loadSchedule()

        function loadSchedule() {
            let dentistId = document.getElementById('dentist').value;
            let date = document.getElementById('date').value;
            let day = new Date(date).getDay();

            if (day === 0) {
                day = 7;
            }

            if (!dentistId) return;
            let vacations, schedules, appointments;
            let scheduleDiv = document.getElementById('schedule');

            let request1 = axios.get('/get-vacations?dentist-id=' + dentistId);
            let request2 = axios.get('/get-appointments?dentist-id=' + dentistId + '&date=' + date)
            let request3 = axios.get('/get-schedules?dentist-id=' + dentistId + '&day-of-week-id=' + day)

            Promise.all([request1, request2, request3])
                .then(function (responses) {
                    vacations = responses[0].data;
                    appointments = responses[1].data;
                    schedules = responses[2].data;

                    scheduleDiv.innerHTML = "";

                    if (new Date(date) >= new Date(vacations[0]['start']) && new Date(date) <= new Date(vacations[0]['end'])) {
                        scheduleDiv.innerHTML = `<p class="w-64">Стоматолог у відпустці з ${vacations[0]['start']} до ${vacations[0]['end']}</p>`;
                        return;
                    }

                    let buttonStyles = '', disabledButton = '';
                    schedules.forEach(function(obj) {
                        if (appointments.includes(obj.start_time)) {
                            buttonStyles = 'cursor-not-allowed bg-orange-700 hover:bg-orange-800 focus:ring-orange-300 dark:focus:ring-orange-800 dark:bg-orange-600 dark:hover:bg-orange-700';
                            disabledButton = 'disabled';
                        }
                        else {
                            disabledButton = '';
                            buttonStyles = 'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:focus:ring-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700';
                        }

                        scheduleDiv.innerHTML += `<form action="{{ route('patient.appointments.store') }}" method="post" data-schedule-id= ${obj.id} >
                            @csrf
                        <input type="hidden" value="{{ $patient->id }}" name="patient_id">
                        <input type="hidden" value="${document.getElementById('dentist').value}" name="dentist_id">
                        <input type="hidden" value="${document.getElementById('date').value}" name="date">
                        <input type="hidden" value="${obj.start_time}" name="start_time">
                        <input type="hidden" value="${obj.start_time}" name="end_time">
                        <input type="hidden" value="${document.getElementById('dentist').options[document.getElementById('dentist').selectedIndex].dataset.cabinet}" name="cabinet">
                        <button type="submit" ${disabledButton} class="${buttonStyles} font-inter-medium mt-6 inline-flex items-center text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                            ${obj.start_time.slice(0, 5)}
                        </button>
                    </form>`;

                    });
                })
                .catch(function (error) {
                    console.error(error);
                });
        }

        document.getElementById('schedule').addEventListener('submit', function(event) {
            event.preventDefault();
            const form = event.target;
            showModalConfirmation(form);
        });

        function showModalConfirmation(form) {
            const dentistElement = document.getElementById('dentist');
            document.getElementById('modal-dentist').value = dentistElement.options[dentistElement.selectedIndex].textContent;
            document.getElementById('modal-date').value = document.getElementById('date').value;
            document.getElementById('modal-time').value = form.elements['start_time'].value.slice(0, 5);
            document.getElementById('modal-cabinet').value = dentistElement.options[dentistElement.selectedIndex].dataset.cabinet;
            const modal = new Modal(document.getElementById('confirmation-modal'));
            modal.show()

            document.getElementById('confirm-button').addEventListener('click', function(event) {
                event.preventDefault();
                sendForm(form);
                modal.hide();
            });
            document.getElementById('close-modal').addEventListener('click', function() {
                modal.hide()
            });
        }

        function sendForm(form) {
            axios.post(form.action, new FormData(form))
                .then(response => {
                    const toastElement = document.getElementById('toast-success');
                    setTimeout(() => {
                        toastElement.classList.remove('opacity-0');
                        toastElement.classList.add('opacity-100');
                        setTimeout(() => {
                            toastElement.classList.remove('opacity-100');
                            toastElement.classList.add('opacity-0');
                            setTimeout(() => {
                                toastElement.remove();
                            }, 2000)
                        }, 5000)
                    }, 500);

                    const submitButton = form.querySelector('button[type="submit"]');
                    submitButton.className = 'cursor-not-allowed bg-orange-700 hover:bg-orange-800 ' +
                        'focus:ring-orange-300 dark:focus:ring-orange-800 ' +
                        'dark:bg-orange-600 dark:hover:bg-orange-700 font-inter-medium mt-6 ' +
                        'inline-flex items-center text-white focus:ring-4 font-medium rounded-lg ' +
                        'text-sm px-5 py-2.5 focus:outline-none';
                    submitButton.disabled = true;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>
