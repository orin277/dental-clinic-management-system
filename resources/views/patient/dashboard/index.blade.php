<x-app-layout>
    <div class="flex overflow-hidden dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <div class="mx-10 mt-8 grid gap-4 grid-cols-1 lg:grid-cols-2">

                <div class="border max-w-2xl w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
                        <dl>
                            <dt class="text-base font-inter-medium text-gray-500 dark:text-gray-400 pb-1">Витрати</dt>
                            <dd id="expenses" class="leading-none text-3xl font-inter-bold text-gray-900 dark:text-white"></dd>
                        </dl>
                    </div>

                    <div id="chart-expenses-for-last-ten-years"></div>
                    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                            <a
                                href="{{ route("patient.generate_pdf_expenses_for_last_ten_years", 2024) }}"
                                class="uppercase text-sm font-inter-semi-bold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                Сформувати звіт
                                <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border max-w-2xl w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
                        <dl>
                            <dt class="text-base font-inter-medium text-gray-500 dark:text-gray-400 pb-1">Кількість прийомів</dt>
                            <dd id="number-of-visits" class="leading-none text-3xl font-inter-bold text-gray-900 dark:text-white"></dd>
                        </dl>
                    </div>

                    <div id="chart-number-of-visits-in-for-last-ten-years"></div>
                    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                            <a
                                href="{{ route("patient.generate_pdf_number_of_visits_in_last_ten_years", 2024) }}"
                                class="uppercase text-sm font-inter-semi-bold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                Сформувати звіт
                                <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const options = {
            series: [
                {
                    name: "Витрати",
                    data: ["788", "810", "866", "788", "1100", "1200", "866", "788", "1100", "1200"],
                    color: "#F05252",
                }
            ],
            chart: {
                sparkline: {
                    enabled: false,
                },
                type: "bar",
                width: "100%",
                height: 400,
                toolbar: {
                    show: false,
                }
            },
            fill: {
                opacity: 1,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: "100%",
                    borderRadiusApplication: "end",
                    borderRadius: 6,
                    dataLabels: {
                        position: "top",
                    },
                },
            },
            legend: {
                show: true,
                position: "bottom",
            },
            dataLabels: {
                enabled: false,
            },
            tooltip: {
                shared: true,
                intersect: false,
                formatter: function (value) {
                    return "₴" + value
                }
            },
            xaxis: {
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    },
                    formatter: function(value) {
                        return "₴" + value
                    }
                },
                categories: getLastTenYears(),
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                type: 'category'
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    }
                }
            },
            grid: {
                show: true,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: -20
                },
            },
            fill: {
                opacity: 1,
            }
        }

        const options2 = {
            series: [
                {
                    name: "Кількість прийомів",
                    data: ["788", "810", "866", "788", "1100", "1200", "866", "788", "1100", "1200"],
                    color: "#F05252",
                }
            ],
            chart: {
                sparkline: {
                    enabled: false,
                },
                type: "bar",
                width: "100%",
                height: 400,
                toolbar: {
                    show: false,
                }
            },
            fill: {
                opacity: 1,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: "100%",
                    borderRadiusApplication: "end",
                    borderRadius: 6,
                    dataLabels: {
                        position: "top",
                    },
                },
            },
            legend: {
                show: true,
                position: "bottom",
            },
            dataLabels: {
                enabled: false,
            },
            tooltip: {
                shared: true,
                intersect: false,
                formatter: function (value) {
                    return value
                }
            },
            xaxis: {
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    },
                    formatter: function(value) {
                        return value
                    }
                },
                categories: getLastTenYears(),
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                type: 'category'
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    }
                }
            },
            grid: {
                show: true,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: -20
                },
            },
            fill: {
                opacity: 1,
            }
        }

        function getLastTenYears() {
            const currentYear = new Date().getFullYear();

            return Array.from({ length: 10 }, (_, index) => currentYear - index);
        }

        loadChartExpensesForLastTenYearsForPatient(options);
        loadChartNumberOfVisitsInLastTenYearsForPatient(options2);

        function loadChartExpensesForLastTenYearsForPatient(options) {
            let request1 = axios.get('/get-expenses-for-last-ten-years-for-patient');

            Promise.all([request1])
                .then(function (responses) {
                    let data = responses[0].data;

                    const totalExpenses = data.reduce(function(total, item) {
                        return total + parseFloat(item.total_amount);
                    }, 0);

                    data = data.map(function(item) {
                        return { x: item.year, y: parseFloat(item.total_amount) };
                    });

                    let newData = data.slice();

                    for (const year of getLastTenYears()) {
                        const existingObject = newData.find(obj => obj.x === year);

                        if (!existingObject) {
                            newData.push({ x: year, y: 0 });
                        }
                    }

                    newData = newData.map(obj => {
                        return { x: obj.x.toString(), y: obj.y };
                    });
                    document.getElementById('expenses').textContent = numberWithSpaces(totalExpenses) + " грн";

                    const chart = new ApexCharts(document.getElementById("chart-expenses-for-last-ten-years"), options);
                    chart.render();
                    chart.updateSeries([{
                        data: newData,
                        color: "#1A56DB",
                    }])
                })
                .catch(function (error) {
                    console.error(error);
                });
        }

        function loadChartNumberOfVisitsInLastTenYearsForPatient(options) {
            let request1 = axios.get('/get-number-of-visits-in-last-ten-years-for-patient');

            Promise.all([request1])
                .then(function (responses) {
                    let data = responses[0].data;

                    const totalVisitors = data.reduce(function(total, item) {
                        return total + parseFloat(item.total_appointments);
                    }, 0);

                    data = data.map(function(item) {
                        return { x: item.year, y: parseFloat(item.total_appointments) };
                    });

                    let newData = data.slice();

                    for (const year of getLastTenYears()) {
                        const existingObject = newData.find(obj => obj.x === year);

                        if (!existingObject) {
                            newData.push({ x: year, y: 0 });
                        }
                    }

                    newData = newData.map(obj => {
                        return { x: obj.x.toString(), y: obj.y };
                    });
                    document.getElementById('number-of-visits').textContent = numberWithSpaces(totalVisitors) + " прийомів";

                    const chart = new ApexCharts(document.getElementById("chart-number-of-visits-in-for-last-ten-years"), options);
                    chart.render();
                    chart.updateSeries([{
                        data: newData,
                        color: "#1A56DB",
                    }])
                })
                .catch(function (error) {
                    console.error(error);
                });
        }

        function numberWithSpaces(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }

    });



</script>
