@extends('layouts.app')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style>
    #container {
    height: 250px;
    border-radius: 8px;
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
<div class="container p-6 bg-[#f2f2f7]">

    <div class="font-bold flex justify-center items-center text-xl">EXPENSE DETAIL</div>
    <div class="w-full flex justify-between items-center mt-4">
        <a href="{{ route('home.index') }}">
            <img class="w-4" src="{{ asset('img/back.svg') }}" alt="back">
        </a>
        <div class="flex gap-3 items-center">
            <button id="openExpenseDetailButton" class="border border-[#ffa500] flex justify-between gap-1 py-2 px-4 my-1 mx-0.2 rounded-lg"><img class="w-6" src="{{ asset('img/calender-icon.png') }}" alt="">Filter</button>
            <a href="{{ route('expense.create',['from' => 'detail']) }}" class="w-[42px] h-[42px] px-2 bg-[#ffa500] rounded-[100px] justify-center items-center gap-2.5 inline-flex">
                <div class="text-center text-white text-xl font-normal font-['Poppins']">+</div>
            </a>
        </div>
    </div>
    <div class="w-full mt-3">
        <div class="text-black text-2xl font-normal font-['Poppins']">Expense</div>
        <div class="text-black text-[32px] font-bold font-['Poppins']">IDR {{ number_format($expenseAmount , 2, ',', '.') }}</div>
    </div>
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>
    <section>
        @foreach ($transactions as $transaction)
        <a href="{{route('pages.transaction-detail', ['id' => $transaction->id, 'from' => 'detail-expense'])}}">
            <div class="w-full p-2 mb-2 bg-[#fcfcfc] flex-col rounded-xl justify-start items-start inline-flex">
                <div class="w-full h-full flex-row justify-start items-center gap-2.5 inline-flex">
                    <div class="px-3 py-1 bg-[#ffa500] rounded-xl flex-col justify-center items-center inline-flex">
                        <div class="justify-center items-center gap-3 inline-flex">
                        <div class="text-center text-black text-[12px] font-normal font-['Poppins']">{{ $transaction->category->name }}</div>
                        <img class="w-4 h-4" src="{{ asset('storage/' . $transaction->category->cover) }}" />
                        </div>
                    </div>
                    <div class="px-3 py-1 bg-[#4baae5] rounded-xl flex-col justify-center items-center inline-flex">
                        <div class="justify-center items-center gap-3 inline-flex">
                        <div class="text-center text-black text-[12px] font-normal font-['Poppins']">{{ $transaction->wallet->name }}</div>
                        <img class="w-4 h-4" src="{{ asset('storage/' . $transaction->wallet->cover) }}" />
                        </div>
                    </div>
                </div>
                <div class="flex-col justify-start items-center pt-2 pb-5">
                    <div class="flex-row justify-start items-center gap-2.5 inline-flex">
                        <div class="h-8 p-1 bg-[#5cf58a] rounded-full justify-start items-center gap-2.5 inline-flex">
                            <img class="w-6 h-6" src="{{ asset('storage/' . $transaction->transactionType->cover) }}" />
                        </div>
                        <div class="h-full justify-start items-center gap-2.5 inline-flex">
                            <div class="text-center"><span class="text-black text-base font-bold font-['Poppins']">{{ number_format($transaction->amount, 2, ',', '.') }}</span><span class="text-black text-xl font-normal font-['Poppins']"> IDR</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </section>
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
                    <form id="filterForm" action="{{ route('expense.show') }}" method="GET">
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
                    <a href="{{ route('expense.show') }}" class="w-full bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300">Reset Filter</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartData = @json($data);

        Highcharts.chart('container', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            title: {
                text: 'expense Category'
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45
                }
            },
            series: [{
                name: 'Amount',
                data: chartData.map(item => [item.category, item.amount])
            }]
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButton = document.getElementById('openExpenseDetailButton');
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