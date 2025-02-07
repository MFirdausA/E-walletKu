@extends('layouts.app')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style>
        #container {
        height: 250px;
        border-top-left-radius: 0.5rem; /* 8px */
        border-top-right-radius: 0.5rem; /* 8px */
    }
        #container1 {
        height: 250px;
        border-top-left-radius: 0.5rem; /* 8px */
        border-top-right-radius: 0.5rem; /* 8px */
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 640px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }

    .highcharts-description {
        margin: 0.3rem 10px;
    }
</style>

@section('content')
<div class="container p-6 min-h-screen bg-[#f2f2f7]">

    <div class="font-bold flex justify-center items-center text-xl">REPORT</div>
    <div class="w-full flex justify-between items-center mt-4">
        <a href="{{ route('home.index') }}">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <div class="flex gap-3 items-center">
            <button id="openReportFilterButton" class="border border-[#ffa500] flex justify-between gap-1 py-2 px-4 my-1 mx-0.2 rounded-lg"><img class="w-6" src="{{ asset('img/calender-icon.png') }}" alt="img">Filter</button>
        </div>
    </div>
    <div>
        <div class="w-full flex justify-between items-center mt-3">
            <div class="text-black font-normal font-['Poppins']">Income</div>
            <div class="text-black font-bold font-['Poppins']">IDR {{ number_format($incomeAmount , 2, ',', '.') }}</div>
        </div>
        <div class="w-full flex justify-between items-center mt-1">
            <div class="text-black font-normal font-['Poppins']">Expense</div>
            <div class="text-black font-bold font-['Poppins']">IDR {{ number_format($expenseAmount , 2, ',', '.') }}</div>
        </div>
        <div class="w-full flex justify-between items-center mt-1">
            <div class="text-black font-normal font-['Poppins']">Total</div>
            <div class="text-black font-bold font-['Poppins']">IDR {{ number_format($totalAmount , 2, ',', '.') }}</div>
        </div>
    </div>
    <div class="mt-4">
        <figure class="highcharts-figure">
            <div id="incomeChart"></div>
            <div class="p-2 bg-white rounded-b-[8px] border-t">
                <a href="{{ route('income.show')}}" class="text-black hover:text-[#ffa500]">details</a>
            </div>
        </figure>
    </div>
    <div class="mt-4">
        <figure class="highcharts-figure">
            <div id="expenseChart"></div>
            <div class="p-2 bg-white rounded-b-[8px] border-t">
                <a href="{{ route('expense.show')}}" class="text-black hover:text-[#ffa500]">details</a>
            </div>
        </figure>
    </div>
     <!-- Modal Filter -->
     <div id="FilterModal" class="hidden fixed inset-0 z-50 justify-center items-center">
        <div class="w-full max-w-[640px] shadow-lg">
            <div class="fixed bg-white max-w-[640px] bottom-0 rounded-t-xl px-5 w-full left-[50%] translate-x-[-50%] gap-4 py-4 flex-row items-center justify-center">
                <div class="flex-col">
                    <button class="flex w-[32px] h-[32px] justify-center items-center rounded-full">
                        <div id="closeFilterModalButton" class="text-black hover:text-gray-700">&times;</div>
                    </button>
                    <div class="flex justify-center items-center p-2 mb-2">Filter Transactions</div>
                </div>
                <div class="flex-col">
                    <form id="filterForm" action="{{ route('report.index') }}" method="GET">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="filterType" class="block text-sm font-medium text-gray-700">Filter Type</label>
                                <select id="filterType" name="filterType" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="daily">Daily</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                    <option value="custom">Custom Date Range</option>
                                </select>
                            </div>
                            <div id="customDateRange" class="hidden">
                                <label for="startDate" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" id="startDate" name="startDate" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <label for="endDate" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" id="endDate" name="endDate" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <button type="submit" class="w-full bg-[#FFA600] text-white py-2 px-4 rounded-md hover:bg-[#D97706]">Apply Filter</button>
                        </div>
                    </form>
                </div>
                <div class="flex-col w-full justify-center">
                    <a href="{{ route('income.show') }}" class="w-full bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300">Reset Filter</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const incomeData = @json($incomeData);
        const expenseData = @json($expenseData);

        Highcharts.chart('incomeChart', {
            chart: { type: 'pie', options3d: { enabled: true, alpha: 45 } },
            title: { text: 'Income by Category' },
            plotOptions: { pie: { innerSize: 100, depth: 45 } },
            series: [{
                name: 'Amount',
                data: incomeData.map(item => [item.category, item.amount])
            }]
        });

        Highcharts.chart('expenseChart', {
            chart: { type: 'pie', options3d: { enabled: true, alpha: 45 } },
            title: { text: 'Expense by Category' },
            plotOptions: { pie: { innerSize: 100, depth: 45 } },
            series: [{
                name: 'Amount',
                data: expenseData.map(item => [item.category, item.amount])
            }]
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButton = document.getElementById('openReportFilterButton');
        const filterModal = document.getElementById('FilterModal');
        const closeFilterModalButton = document.getElementById('closeFilterModalButton');
        const filterType = document.getElementById('filterType');
        const customDateRange = document.getElementById('customDateRange');

        function openFilterModal() {
            filterModal.classList.remove('hidden');
        }

        function closeFilterModal() {
            filterModal.classList.add('hidden');
        }

        filterButton.addEventListener('click', openFilterModal);
        closeFilterModalButton.addEventListener('click', closeFilterModal);

        filterType.addEventListener('change', function() {
            if (this.value === 'custom') {
                customDateRange.classList.remove('hidden');
            } else {
                customDateRange.classList.add('hidden');
            }
        });
    });
</script>
@endsection