<x-app-layout>
    <div class="flex overflow-hidden dark:bg-gray-900">
        <x-sidebar/>
        <div class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <div class="mx-10 mt-8 grid gap-4 grid-cols-1 lg:grid-cols-2">
                <div class="max-w-2xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between mb-5">
                        <div>
                            <h5 id="income-for-year" class="leading-none text-3xl font-inter-bold text-gray-900 dark:text-white pb-2">$12,423</h5>
                            <p class="text-base font-inter-medium text-gray-500 dark:text-gray-400">Дохід за рік</p>
                        </div>
                    </div>
                    <div id="income-chart" class=""></div>
                    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5">
                        <div class="flex justify-between items-center pt-5">
                            <select id="chart1-year-selection" class="border-transparent click:border-transparent py-2 text-sm text-gray-700 dark:text-gray-200">
                                <option class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2024</option>
                                <option class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2023</option>
                                <option class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2022</option>
                                <option class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2021</option>
                            </select>
                            <a
                                href="{{ route("admin.generate_pdf_income_for_certain_year", 2024) }}"
                                class="uppercase text-sm font-inter-semi-bold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                Сформувати звіт
                                <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="max-w-2xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between mb-5">
                        <div>
                            <h5 id="total-visitors-for-year" class="leading-none text-3xl font-inter-bold text-gray-900 dark:text-white pb-2"></h5>
                            <p class="text-base font-inter-medium text-gray-500 dark:text-gray-400">Кількість прийомів за рік</p>
                        </div>
                    </div>
                    <div id="number-of-visitors-chart" class=""></div>
                    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5">
                        <div class="flex justify-between items-center pt-5">
                            <select id="chart2-year-selection" class="border-transparent click:border-transparent py-2 text-sm text-gray-700 dark:text-gray-200">
                                <option class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2024</option>
                                <option class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2023</option>
                                <option class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2022</option>
                                <option class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2021</option>
                            </select>
                            <a
                                href="{{ route("admin.generate_pdf_number_of_visitors_for_certain_year", 2024) }}"
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
            xaxis: {
                show: true,
                categories: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    }
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: true,
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    },
                    formatter: function (value) {
                        return value;
                    }
                }
            },
            series: [
                {
                    name: "Дохід",
                    data: [150, 141, 145, 152, 135, 125, 152, 135, 125, 152, 135, 125],
                    color: "#1A56DB",
                },

            ],
            chart: {
                sparkline: {
                    enabled: false
                },
                height: "200px",
                width: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            legend: {
                show: false
            },
            grid: {
                show: false,
            },
        }

        if (document.getElementById("income-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("income-chart"), options);
            chart.render();
        }


        const options2 = {
            dataLabels: {
                enabled: true,
                //offsetX: 10,
                style: {
                    cssClass: 'text-xs text-white font-medium'
                },
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 16,
                    right: 16,
                    top: -16
                },
            },
            series: [
                {
                    name: "К-сть прийомів",
                    data: [64, 41, 76, 41, 113, 173, 64, 41, 76, 41, 113, 173],
                    color: "#7E3BF2",
                },
            ],
            chart: {
                height: "200px",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            legend: {
                show: true
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            stroke: {
                width: 6,
            },
            xaxis: {
                categories: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
                labels: {
                    show: true,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
                labels: {
                    formatter: function (value) {
                        return value;
                    }
                }
            },
        }

        if (document.getElementById("number-of-visitors-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("number-of-visitors-chart"), options2);
            chart.render();
        }

        document.getElementById('chart1-year-selection').addEventListener('change', function(event) {
            event.preventDefault();
            const yearSelectionElement = document.getElementById('chart1-year-selection');
            const year = yearSelectionElement.options[yearSelectionElement.selectedIndex].textContent;
            loadChartIncomeForCertainYear(options, year);
        });

        document.getElementById('chart2-year-selection').addEventListener('change', function(event) {
            event.preventDefault();
            const yearSelectionElement = document.getElementById('chart2-year-selection');
            const year = yearSelectionElement.options[yearSelectionElement.selectedIndex].textContent;
            loadChartNumberOfVisitorsForCertainYear(options2, year);
        });

        loadChartIncomeForCertainYear(options, document.getElementById('chart1-year-selection')
            .options[document.getElementById('chart1-year-selection').selectedIndex].textContent);

        loadChartNumberOfVisitorsForCertainYear(options2, document.getElementById('chart2-year-selection')
            .options[document.getElementById('chart2-year-selection').selectedIndex].textContent);

        function loadChartIncomeForCertainYear(options, year) {
            let request1 = axios.get('/get-income-for-certain-year?year=' + year);

            Promise.all([request1])
                .then(function (responses) {
                    let data = responses[0].data;
                    const totalAmount = data.reduce(function(total, item) {
                        return total + parseFloat(item.total_amount);
                    }, 0);

                    data = data.map(function(item) {
                        return { x: item.month, y: parseFloat(item.total_amount) };
                    });

                    document.getElementById('income-for-year').textContent = numberWithSpaces(totalAmount) + " грн";

                    const chart = new ApexCharts(document.getElementById("income-chart"), options);
                    chart.render();
                    chart.updateSeries([{
                        data: data,
                        color: "#1A56DB",
                    }])
                })
                .catch(function (error) {
                    console.error(error);
                });
        }

        function loadChartNumberOfVisitorsForCertainYear(options, year) {
            let request = axios.get('/get-number-of-visitors-for-certain-year?year=' + year);

            Promise.all([request])
                .then(function (responses) {
                    let data = responses[0].data;
                    const totalVisitors = data.reduce(function(total, item) {
                        return total + parseFloat(item.total_appointments);
                    }, 0);

                    data = data.map(function(item) {
                        return { x: item.month, y: parseFloat(item.total_appointments) };
                    });

                    document.getElementById('total-visitors-for-year').textContent = numberWithSpaces(totalVisitors);

                    const chart = new ApexCharts(document.getElementById("number-of-visitors-chart"), options);
                    chart.render();
                    chart.updateSeries([{
                        data: data,
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

    })
</script>
